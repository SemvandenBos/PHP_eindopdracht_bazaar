<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuctionProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\RentalProduct;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid login credentials.'
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function rentalProducts(Request $request)
    {
        $userId = $request->user()->id;

        $products = RentalProduct::where('owner_id', $userId)
            ->get();

        if (!$products) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($products);
    }

    public function rentalProduct(Request $request, $product_id)
    {
        $userId = $request->user()->id;

        $product = RentalProduct::where('id', $product_id)
            ->where('owner_id', $userId)
            ->first();

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($product);
    }

    public function auctionProducts(Request $request)
    {
        $userId = $request->user()->id;

        $product = AuctionProduct::where('owner_id', $userId)
            ->first();

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($product);
    }

    public function auctionProduct(Request $request, $product_id)
    {
        $userId = $request->user()->id;

        $product = AuctionProduct::where('id', $product_id)
            ->where('owner_id', $userId)
            ->first();

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($product);
    }
}
