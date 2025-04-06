<?php

use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalProductController;
use App\Http\Controllers\AuctionProductController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

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
        });

    //Rental products customers
    Route::resource('rentalProduct', RentalProductController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'rentalProduct.index',
            'show' => 'rentalProduct.show',
        ]);
    Route::get('rentedOverview', [RentalProductController::class, 'rentedOverview'])->name('rentalProduct/rentedOverview');
    Route::get('/favourites', [FavouritesController::class, 'index'])->name('favourites');

        

    //Auction products customers
    Route::resource('auctionProduct', AuctionProductController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'auctionProduct.index',
            'show' => 'auctionProduct.show',
        ]);

    //Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/orderReview', [OrderController::class, 'storeReview'])->name('order.storeReview');
    Route::post('/toggleFavourite', [OrderController::class, 'toggleFavourite'])->name('order.toggleFavourite');
});


require __DIR__ . '/auth.php';
