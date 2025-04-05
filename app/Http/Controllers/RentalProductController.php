<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RentalProductController extends Controller
{
    public function index()
    {
        $rentalProducts = RentalProduct::with('owner')->paginate(5);
        return view('rentalProduct.index', ['rentalProducts' => $rentalProducts]);
    }

    //Overview for both customers and advertisers.
    public function activeRentalsOverview()
    {
        $user = Auth::user();

        $activeRentOrders = Order::with('rentalProduct')
            ->where('user_id', '=', $user->id)
            ->where('rent_start_date', '>=', now())
            ->get();

        if (Gate::denies('advertise', $user)) {
            return view('rentalProduct.advertiserOverview', compact('activeRentOrders'));
        }

        $activeOwnedRentOrders = Order::with('rentalProduct')
            ->whereHas('rentalProduct', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })
            ->where('rent_end_date', '>=', now())
            ->get();

        return view('rentalProduct.advertiserOverview', compact('activeRentOrders', 'activeOwnedRentOrders'));
    }

    public function show($id)
    {
        $product = RentalProduct::with([
            'orders' => function ($query) {
                $query->where('rent_start_date', '>=', Carbon::now());
            }
        ])->findOrFail($id);

        $sort = request()->query('sort', 'newest');

        $query = RentalProductReview::where('rental_product_id', $product->id);

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'highest_rating') {
            $query->orderBy('review_score', 'desc');
        } elseif ($sort === 'lowest_rating') {
            $query->orderBy('review_score', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $reviews = $query->paginate(3)->appends(['sort' => $sort]);

        return view('rentalProduct.show', compact('product', 'reviews'));
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
}
