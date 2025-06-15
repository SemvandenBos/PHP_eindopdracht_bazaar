<?php

namespace App\Http\Controllers;

use App\Models\PurchasableProduct;
use App\Models\RentalProduct;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'new_to_old');
        
        // Handle products filtering
        $productsQuery = PurchasableProduct::query();
        $rentalProductsQuery = RentalProduct::query();
        
        switch ($filter) {
            case 'old_to_new':
                $productsQuery->orderBy('created_at', 'asc');
                $rentalProductsQuery->orderBy('created_at', 'asc');
                break;
            case 'seller_a_z':
                $productsQuery->with(['seller' => function($query) {
                    $query->orderBy('name', 'asc');
                }]);
                $rentalProductsQuery->with(['owner' => function($query) {
                    $query->orderBy('name', 'asc');
                }]);
                break;
            case 'product_a_z':
                $productsQuery->orderBy('name', 'asc');
                $rentalProductsQuery->orderBy('name', 'asc');
                break;
            default: // new_to_old
                $productsQuery->orderBy('created_at', 'desc');
                $rentalProductsQuery->orderBy('created_at', 'desc');
                break;
        }

        $products = $productsQuery->paginate(10);
        $rentalProducts = $rentalProductsQuery->paginate(10);

        return view('dashboard', [
            'products' => $products,
            'rentalProducts' => $rentalProducts,
            'currentFilter' => $filter
        ]);
    }
}