<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->controller(ApiController::class)->group(function () {
    // Rental product routes
    Route::get('/rentalProducts', 'rentalProducts');
    Route::get('/rentalProducts/{product_id}', 'rentalProduct');

    // Auction product routes
    Route::get('/auctionProducts', 'auctionProducts');
    Route::get('/auctionProducts/{product_id}', 'auctionProduct');
});