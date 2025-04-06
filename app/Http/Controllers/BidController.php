<?php

namespace App\Http\Controllers;

use App\Models\AuctionProduct;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:auction_products,id',
            'price' => 'required'
        ]);

        $user = Auth::user();
        $product = AuctionProduct::findOrFail($validated['product_id']);

        if (!$product->available()) {
            return redirect()->back()->with('error', 'This product is currently not available.');
        }
        //TODO checken of je niet jezelf overbied
        if ($validated['price'] < $product->highestBid()) {
            return redirect()->back()->with('error', 'Your bid is not the highest!');
        }

        Bid::create([
            'user_id' => $user->id,
            'auction_product_id' => $validated['product_id'],
            'price' => $validated['price'],
        ]);

        return redirect()->back()->with('success', 'Bid placed successfully!');
    }
}
