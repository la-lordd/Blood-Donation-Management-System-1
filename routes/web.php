<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;

// Public home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Breeze auth routes
require __DIR__.'/auth.php';

// All routes below require login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ IMPORTANT: 'create' must come BEFORE '{donor}' so Laravel doesn't
    // mistake the word "create" as a donor ID
    Route::middleware(['admin'])->group(function () {
        Route::get('/donors/create', [DonorController::class, 'create'])->name('donors.create');
        Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');
        Route::get('/donors/{donor}/edit', [DonorController::class, 'edit'])->name('donors.edit');
        Route::put('/donors/{donor}', [DonorController::class, 'update'])->name('donors.update');
        Route::delete('/donors/{donor}', [DonorController::class, 'destroy'])->name('donors.destroy');
    });

    // These come AFTER /donors/create
    Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
    Route::get('/donors/{donor}', [DonorController::class, 'show'])->name('donors.show');

});