<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentalOrder;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        dd("orders here");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:rental_products,id',

            'rent_start_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::tomorrow()->toDateString(),
                'before_or_equal:' . Carbon::now()->addDays(21)->toDateString(),
            ],

            'rent_end_date' => [
                'required',
                'date',
                'after_or_equal:rent_start_date',
                'before_or_equal:' . Carbon::parse($request->input('rent_start_date'))->addDays(6)->toDateString(),
            ],
        ]);

        $user = Auth::user();

        $product = RentalProduct::findOrFail($validated['product_id']);
        if (! $product->available($validated['rent_start_date'], $validated['rent_end_date'])) {
            return redirect()->back()->with('error', 'This product is currently not available for rent.');
        }

        RentalOrder::create([
            'user_id' => $user->id,
            'rental_product_id' => $validated['product_id'],
            'rent_start_date' => $validated['rent_start_date'],
            'rent_end_date' => $validated['rent_end_date'],
        ]);

        return redirect()->back()->with('success', 'Product rented successfully!');
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:rental_products,id',
            'review_text' => 'required',
            'review_score' => [
                'required',
                'numeric',
                'between:1,5',
                function () {}
            ],
        ]);

        $user = Auth::user();

        $existingReview = RentalProductReview::where('reviewer_id', $user->id)
            ->where('rental_product_id', $validated['product_id'])
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        RentalProductReview::create([
            'reviewer_id' => $user->id,
            'rental_product_id' => $validated['product_id'],
            'review_text' => $validated['review_text'],
            'review_score' => $validated['review_score'],
        ]);

        return redirect()->back()->with('success', 'Product rented successfully!');
    }

    public function toggleFavourite(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:rental_products,id',
        ]);

        $product = RentalProduct::find($validated['product_id']);

        $user = Auth::user();
        $user->toggleFavourite($product);

        return redirect()->back()->with('success', 'Favourite status updated!');
    }
}
