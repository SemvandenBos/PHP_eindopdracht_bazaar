<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $product = RentalProduct::with([
            'orders' => function ($query) {
                $query->where('rent_start_date', '>', Carbon::now());
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
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        RentalProduct::create($request->all());

        return redirect()->route('rentalProduct.create')->with('success', __('rentalProduct.succesCreate'));
    }
}
