<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ShowController;
use App\Http\Controllers\Admin\PassController;
use App\Http\Controllers\Admin\RiwayatBookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\ShowController as AdminShowController;
use App\Http\Controllers\User\ShowController as UserShowController;
use App\Http\Controllers\User\BookingController;

use Illuminate\Support\Facades\Route;

// user dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');

// show
Route::get('/shows/{show}', [UserShowController::class, 'show'])->name('shows.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // routes untuk user booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');


    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // routes untuk genre
        Route::resource('genres', GenreController::class);

        // routes untuk show
        Route::resource('shows', ShowController::class);

        // routes untuk pass
        Route::resource('passes', PassController::class)
            ->only(['store', 'update', 'destroy']);

        // routes untuk riwayat
        Route::get('/riwayats', [RiwayatBookingController::class, 'index'])->name('riwayats.index');
        Route::get('/riwayats/{booking}', [RiwayatBookingController::class, 'show'])->name('riwayats.show');
    });
});

require __DIR__ . '/auth.php';
