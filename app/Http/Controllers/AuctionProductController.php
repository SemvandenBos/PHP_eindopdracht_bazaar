<?php

namespace App\Http\Controllers;

use App\Models\AuctionProduct;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuctionProductController extends Controller
{
    public function index()
    {
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
        dd("history page");
    }

    public function create()
    {
        return view('auctionProduct.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
