<?php

use Illuminate\Support\Facades\Route;

/* =======================
|  USER CONTROLLERS
======================= */
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OutfitController;
use App\Http\Controllers\User\FindOutfitController;
use App\Http\Controllers\User\TrendController as UserTrendController;

/* =======================
|  AUTH CONTROLLERS
======================= */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/* =======================
|  ADMIN CONTROLLERS
======================= */
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StyleController;
use App\Http\Controllers\Admin\TrendController;


/* =======================
|  PUBLIC
======================= */
Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::view('/explore-style', 'dashboard.explore');
Route::view('/recommendation', 'dashboard.recommendation');


/* =======================
|  AUTH
======================= */
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/* =======================
|  USER (AUTH)
======================= */
Route::middleware('auth')->group(function () {

    // MATCH YOUR OUTFIT
    Route::resource('outfits', OutfitController::class);

    Route::view('/match-your-outfit', 'outfits.match')
        ->name('outfits.match');

    // FIND YOUR OUTFIT
    Route::prefix('find-outfit')
        ->name('find-outfit.')
        ->group(function () {

            Route::get('/', [FindOutfitController::class, 'index'])
                ->name('index');

            Route::post('/generate', [FindOutfitController::class, 'generate'])
                ->name('generate');

            // EVENT
            Route::get('/event', [FindOutfitController::class, 'event'])
                ->name('event');

            Route::post('/event/generate', [FindOutfitController::class, 'generateEvent'])
                ->name('event.generate');

            // TREND (USER VIEW)
            Route::get('/trend', [UserTrendController::class, 'index'])
                ->name('trend');
        });
});


/* =======================
|  ADMIN
======================= */
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('styles', StyleController::class);
        Route::resource('categories', CategoryController::class);

        // TREND ADMIN (UPLOAD TREND + TIKTOK)
        Route::resource('trends', TrendController::class);

        Route::patch(
            'styles/{style}/toggle',
            [StyleController::class, 'toggle']
        )->name('styles.toggle');

            // Tambahkan route toggle
    Route::patch('trends/{trend}/toggle', [TrendController::class, 'toggle'])
         ->name('trends.toggle');
    });
