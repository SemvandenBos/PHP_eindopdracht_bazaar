<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalProductController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/register-advertiser', function(){
    return view('register-advertiser.edit');
})->middleware('auth')->name('register-advertiser');

Route::resource('rentalProduct', RentalProductController::class)->names([
    'index' => 'rentalProduct.index',
    'create' => 'rentalProduct.create',
    'store' => 'rentalProduct.store',
    'show' => 'rentalProduct.show',
]);

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::patch('/profile.update-advertiser', [ProfileController::class, 'updateAdvertiser'])->middleware('auth')->name('profile.update-advertiser');

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view(view: 'dashboard');
    // })->name('dashboard');

    // Route::get('/personal-advertiser', function () {
    //     return "Personal Advertiser Dashboard";
    // })->middleware(RoleMiddleware::class . ':personal_advertiser');
    // })->name('dashboard');

    Route::get('/', function () {
        return "welcome";
    })->middleware(RoleMiddleware::class . ':personal_advertiser');
});

require __DIR__.'/auth.php';
