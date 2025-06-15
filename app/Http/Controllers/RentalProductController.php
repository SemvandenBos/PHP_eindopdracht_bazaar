<?php

namespace App\Http\Controllers;

use App\Models\RentalOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RentalProductController extends Controller
{
    public function index()
    {
        $sort = request()->query('sort', 'newest');
        $filter = request()->query('filter', 'noFilter');

        $query = RentalProduct::with('owner');

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'highest_rating') {
            $query->withAvg('reviews', 'review_score')->orderBy('reviews_avg_review_score', 'desc');
        } elseif ($sort === 'lowest_rating') {
            $query->withAvg('reviews', 'review_score')->orderBy('reviews_avg_review_score', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->get(); // no pagination yet (still need to filter)

        if ($filter === 'available') {
            $products = $products->filter(fn($product) => $product->availableTomorrow());
        } elseif ($filter === 'unavailable') {
            $products = $products->filter(fn($product) => !$product->availableTomorrow());
        }

        $perPage = 5;
        $page = request()->get('page', 1);
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('rentalProduct.index', ['rentalProducts' => $paginated]);
    }

    //Overview for both customers and advertisers, having both active and history
    public function rentedOverview()
    {
        $user = Auth::user();

        $activeRentOrders = RentalOrder::with('rentalProduct')
            ->where('user_id', '=', $user->id)
            ->where('rent_end_date', '>=', now())
            ->paginate(5, ['*'], 'rentedPage');

        $pastRentOrders = RentalOrder::with('rentalProduct')
            ->where('user_id', '=', $user->id)
            ->where('rent_end_date', '<', now())
            ->paginate(5, ['*'], 'pastPage');

        // if (Gate::denies('advertise', $user)) {
        //     return view('rentalProduct.rentalsOverview', compact('activeRentOrders', 'pastRentOrders'));
        // }

        $activeOwnedRentOrders = RentalOrder::with('rentalProduct')
            ->whereHas('rentalProduct', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })
            ->where('rent_end_date', '>=', now())
            ->paginate(5, ['*'], 'ownedPage');

        return view('rentalProduct.rentalsOverview', compact('activeRentOrders', 'pastRentOrders', 'activeOwnedRentOrders'));
    }

    public function show($id)
    {
        $product = RentalProduct::with([
            'orders' => function ($query) {
                $query->where('rent_start_date', '>=', Carbon::now());
            }
        ])->findOrFail($id);

        $sort = request()->query('sort', 'newest');
        $filter = request()->query('filter', 'all');

        $query = RentalProductReview::where('rental_product_id', $product->id);

        if ($filter === 'past_week') {
            $query->where('created_at', '>=', Carbon::now()->subWeek());
        } elseif ($filter === 'past_month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'highest_rating') {
            $query->orderBy('review_score', 'desc');
        } elseif ($sort === 'lowest_rating') {
            $query->orderBy('review_score', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $reviews = $query->paginate(3)->appends([
            'sort' => $sort,
            'filter' => $filter,
        ]);

        $qrcode = QrCode::generate(url('rentalProduct/show/' . $id));

        return view('rentalProduct.show', compact('product', 'reviews', 'qrcode'));
    }

    public function create()
    {
        return view('rentalProduct.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        RentalProduct::create([
            'owner_id' => $user->id,
            'name' => $validated['name'],
            'price_per_day' => $validated['price_per_day'],
        ]);

        return redirect()->route('rentalProduct.create')->with('success', __('rentalProduct.succesCreate'));
    }

    public function storeBulk(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            RentalProduct::create([
                'owner_id' => $data[0],
                'name' => $data[1],
                'price_per_day' => $data[2],
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully');
    }

    public function export()
    {
        $fileName = 'rental_products.csv';

        $rentalProducts = RentalProduct::select('owner_id', 'name', 'price_per_day')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($rentalProducts) {
            $handle = fopen('php://output', 'w');
            // fputcsv($handle, ['Owner ID', 'Name', 'Price per Day']);

            foreach ($rentalProducts as $product) {
                fputcsv($handle, [
                    $product->owner_id,
                    $product->name,
                    $product->price_per_day,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
