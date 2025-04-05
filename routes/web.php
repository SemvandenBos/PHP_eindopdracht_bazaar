<?php

use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalProductController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'nl'])) {
        App::setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.setting');

Route::get('/register-advertiser', function () {
    return view('register-advertiser.edit');
})->middleware('auth')->name('register-advertiser');

Route::get('/favourites', [FavouritesController::class, 'index'])->name('favourites');

Route::patch('/profile.update-advertiser', [ProfileController::class, 'updateAdvertiser'])->middleware('auth')->name('profile.update-advertiser');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view(view: 'dashboard');
    })->name('dashboard');

    Route::get('/personal-advertiser', function () {
        return "Personal Advertiser Dashboard";
    })->middleware(RoleMiddleware::class . ':personal_advertiser')->name('personal-advertiser');

    //Rental products
    Route::resource('rentalProduct', RentalProductController::class)->names([
        'index' => 'rentalProduct.index',
        'create' => 'rentalProduct.create',
        'store' => 'rentalProduct.store',
        'show' => 'rentalProduct.show',
    ]);
    Route::get('activeRentalsOverview', [RentalProductController::class, 'activeRentalsOverview'])->name('rentalProduct/activeRentalsOverview');

    //Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/orderReview', [OrderController::class, 'storeReview'])->name('order.storeReview');
    Route::post('/toggleFavourite', [OrderController::class, 'toggleFavourite'])->name('order.toggleFavourite');
});

Route::middleware('auth', RoleMiddleware::class . ':personal_advertiser')->group(function () {
    Route::get('rentalProduct.create', [RentalProductController::class, 'create'])->name('rentalProduct.create');
    Route::post('rentalProduct.store', [RentalProductController::class, 'store'])->name('rentalProduct.store');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view(view: 'dashboard');
    // })->name('dashboard');

    // Route::get('/personal-advertiser', function () {
    //     return "Personal Advertiser Dashboard";
    // })->middleware(RoleMiddleware::class . ':personal_advertiser')->name('personal-advertiser');

    Route::resource('rentalProduct', RentalProductController::class)->names([
        'index' => 'rentalProduct.index',
        'show' => 'rentalProduct.show',
    ]);

    Route::get('/order', [OrderController::class, 'index'])->name('order.index'); //TODO
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/orderReview', [OrderController::class, 'storeReview'])->name('order.storeReview');
    Route::post('/toggleFavourite', [OrderController::class, 'toggleFavourite'])->name('order.toggleFavourite');
});



require __DIR__ . '/auth.php';
