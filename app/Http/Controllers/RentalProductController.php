<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalProduct;

class RentalProductController extends Controller
{
    public function index()
    {
        $rentalProducts = RentalProduct::all();
        return view('rentalProduct.index', ['rentalProducts' => $rentalProducts]);
    }

    public function show($id)
    {
        $product = RentalProduct::findOrFail($id);
        return view('rentalProduct.show', ['product' => $product]);
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
