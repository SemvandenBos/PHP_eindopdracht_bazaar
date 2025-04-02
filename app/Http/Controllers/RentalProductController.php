<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;


class RentalProductController extends Controller
{
    public function index()
    {
        $rentalProducts = RentalProduct::with('owner')->paginate(5);
        return view('rentalProduct.index', ['rentalProducts' => $rentalProducts]);
    }

    public function show($id)
    {
        $product = RentalProduct::with('orders')->findOrFail($id);
        $reviews = RentalProductReview::where('rental_product_id', $product->id)
            ->latest()
            ->paginate(1);

        return view('rentalProduct.show', compact('product', 'reviews'));
    }

    public function create()
    {
        return view('rentalProduct.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        RentalProduct::create($request->all());

        return redirect()->route('rentalProduct.create')->with('success', __('rentalProduct.succesCreate'));
    }
}
