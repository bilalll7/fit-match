<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OutfitController;
use App\Http\Controllers\FindOutfitController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StyleController;


Route::get('/', [DashboardController::class, 'index'])
    ->name('home');

Route::get('/explore-style', function () {
    return view('dashboard.explore');
});

Route::get('/recommendation', function () {
    return view('dashboard.recommendation');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.') 
    ->group(function () {

        Route::get('/', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('styles', StyleController::class);
        Route::resource('trends', StyleController::class);
        Route::resource('categories', CategoryController::class);
    });


Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    Route::resource('outfits', OutfitController::class);

    Route::get('/match-your-outfit', function () {
        return view('outfits.match');
    })->name('outfits.match');

    Route::get('/find-your-outfit', [FindOutfitController::class, 'index'])
        ->name('outfits.find');

});


Route::patch(
    'styles/{style}/toggle',
    [StyleController::class, 'toggle']
)->name('admin.styles.toggle');
