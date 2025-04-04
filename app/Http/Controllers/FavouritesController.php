<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\RentalProduct;
use Illuminate\Http\Request;


class FavouritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $rentalFavourites = $user->favourites()->paginate(2);
        return view('favourites', compact(['rentalFavourites']));
    }
}
