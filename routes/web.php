<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShipController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/partnerships', [PublicController::class, 'partnerships'])->name('partnerships');
Route::get('/fleet', [PublicController::class, 'fleet'])->name('fleet');
Route::get('/ship/{id}', [PublicController::class, 'shipDetail'])->name('ship.detail');
Route::get('/tracking', [PublicController::class, 'tracking'])->name('tracking');
Route::get('/api/ship-locations', [PublicController::class, 'getShipLocations'])->name('api.ship-locations');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Admin routes (protected with auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/ships', ShipController::class);
    Route::post('/ships/{ship}/update-position', [ShipController::class, 'updatePosition'])->name('ships.update-position');
    Route::get('/ships/{ship}/history', [ShipController::class, 'history'])->name('ships.history');
    Route::post('/ships/{ship}/update-status', [ShipController::class, 'updateStatus'])->name('ships.update-status');
});

// Dashboard redirect route (important for login redirect)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');