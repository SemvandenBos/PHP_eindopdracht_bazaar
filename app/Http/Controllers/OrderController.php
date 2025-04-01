<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RentalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:rental_products,id',
        ]);

        $user = Auth::user();

        $product = RentalProduct::findOrFail($validated['product_id']);
        if (! $product->available()) {
            return redirect()->back()->with('error', 'This product is currently not available for rent.');
        }

        Order::create([
            'user_id' => $user->id,
            'rental_product_id' => $validated['product_id'],
            'rented_at' => now()->toDateString(),
            // 'return_due_at' => now()->addWeek()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Product rented successfully!');
    }
}
