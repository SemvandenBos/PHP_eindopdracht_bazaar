<?php

use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalProductController;
use App\Http\Controllers\AuctionProductController;
use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Models\RentalProduct;

Route::get('/', function () {
    return view('welcome');
});

Route::get('set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'nl'])) {
        App::setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.setting');

Route::patch('/profile.update-advertiser', [ProfileController::class, 'updateAdvertiser'])->middleware('auth')->name('profile.update-advertiser');

Route::middleware(['auth'])->group(function () {
    //Account
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view('/register-advertiser', 'register-advertiser.edit')->name('register-advertiser');

    Route::get('/dashboard', function () {
        return view(view: 'dashboard');
    })->name('dashboard');

    Route::get('/personal-advertiser', function () {
        return "Personal Advertiser Dashboard";
    })->name('personal-advertiser');

    //Advertisers routes:
    Route::middleware(RoleMiddleware::class . ':personal_advertiser')
        ->group(function () {
            Route::prefix('/rentalProduct')->name('rentalProduct.')
                ->controller(RentalProductController::class)
                ->group(function () {
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/storeBulk', 'storeBulk')->name('storeBulk');
                    Route::get('/export', 'export')->name('export');
                });

            Route::prefix('/auctionProduct')->name('auctionProduct.')
                ->controller(AuctionProductController::class)
                ->group(function () {
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/storeBulk', 'storeBulk')->name('storeBulk');
                    Route::get('/export', 'export')->name('export');
                });
        });

    //Rental products customers
    Route::resource('rentalProduct', RentalProductController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'rentalProduct.index',
            'show' => 'rentalProduct.show',
        ]);
    Route::get('/api/rentalProduct/show/{id}', [RentalProductController::class, 'apiShow']); //TODO JSON
    Route::get('rentedOverview', [RentalProductController::class, 'rentedOverview'])->name('rentalProduct.rentedOverview');

    Route::get('/favourites', [FavouritesController::class, 'index'])->name('favourites');

    //Order
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/orderReview', [OrderController::class, 'storeReview'])->name('order.storeReview');
    Route::post('/toggleFavourite', [OrderController::class, 'toggleFavourite'])->name('order.toggleFavourite');

    //Auction products customers
    Route::get('auctionProduct/history', [AuctionProductController::class, 'history'])->name('auctionProduct.history');
    Route::resource('auctionProduct', AuctionProductController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'auctionProduct.index',
            'show' => 'auctionProduct.show',
        ]);


    //Bids
    Route::post('/bid', [BidController::class, 'store'])->name('bid.store');
});


require __DIR__ . '/auth.php';
