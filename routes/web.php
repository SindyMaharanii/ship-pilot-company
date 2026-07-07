<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShipController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactInfoController;
use Illuminate\Support\Facades\Route;
use App\Models\PilotShip;

// ===== PUBLIC ROUTES =====
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/partnerships', [PublicController::class, 'partnerships'])->name('partnerships');
Route::get('/fleet', [PublicController::class, 'fleet'])->name('fleet');
Route::get('/ship/{id}', [PublicController::class, 'shipDetail'])->name('ship.detail');

// ===== TRACKING - Redirect ke VesselFinder =====
Route::get('/tracking', function () {
    $ship = PilotShip::first();
    if ($ship && $ship->mmsi) {
        return redirect('https://www.vesselfinder.com/?mmsi=' . $ship->mmsi);
    }
    return redirect('https://www.vesselfinder.com/');
})->name('tracking');

// ===== API & CONTACT =====
Route::get('/api/ship-locations', [PublicController::class, 'getShipLocations'])->name('api.ship-locations');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

// ===== AUTH ROUTES =====
require __DIR__.'/auth.php';

// ===== ADMIN ROUTES =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('/ships', ShipController::class);
    Route::post('/ships/{ship}/update-position', [ShipController::class, 'updatePosition'])->name('ships.update-position');
    Route::get('/ships/{ship}/history', [ShipController::class, 'history'])->name('ships.history');
    Route::post('/ships/{ship}/update-status', [ShipController::class, 'updateStatus'])->name('ships.update-status');
    
    Route::resource('/company', CompanyController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/partnerships', PartnershipController::class);
    
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{id}/reply', [ContactController::class, 'markAsReplied'])->name('contacts.reply');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('/contact-info', [ContactInfoController::class, 'index'])->name('contact.index');
    Route::put('/contact-info', [ContactInfoController::class, 'update'])->name('contact.update');
});

// ===== DASHBOARD REDIRECT =====
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');