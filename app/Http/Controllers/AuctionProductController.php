<?php

namespace App\Http\Controllers;

use App\Models\AuctionProduct;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AuctionProductController extends Controller
{
    public function index()
    {
        $sort = request()->query('sort', 'newest');
        $filter = request()->query('filter', 'noFilter');

        $query = AuctionProduct::with('owner');

        $auctionProducts = AuctionProduct::with('owner')->paginate(5);
        return view('auctionProduct.index', compact('auctionProducts'));
    }

    public function show($id)
    {
        $product = AuctionProduct::with('bids')->findOrFail($id);

        $qrcode = QrCode::generate(url('auctionProduct/show/' . $id));

        return view('auctionProduct.show', compact('product', 'qrcode'));
    }

    public function history()
    {
        $user = Auth::user();
        $page = request('page', 1);
        $perPage = 10;

        $filtered = AuctionProduct::with('bids')
            ->where('deadline', '<', Carbon::now())
            ->get()
            ->filter(function ($product) use ($user) {
                $highestBid = $product->bids->last(); // Last = most recent = highest
                return $highestBid && $highestBid->user_id === $user->id;
            });

        $items = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // dd($pastBoughtProducts);
        return view('auctionProduct.history', ['pastBoughtProducts' => $items]);
    }

    public function create()
    {
        return view('auctionProduct.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'deadline' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->addDay()->format('Y-m-d H:i:s'),
            ],
        ]);

        $user = Auth::user();

        AuctionProduct::create([
            'owner_id' => $user->id,
            'name' => $validated['name'],
            'deadline' => $validated['deadline'],
        ]);

        return redirect()->route('auctionProduct.create')->with('success', __('auctionProduct.succesCreate'));
    }
}
