<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('inventory.index');
    }
    return redirect()->route('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('inventory.index');
})->name('dashboard');

// In routes/web.php - add rate limiting
Route::middleware(['auth', 'throttle:60,1'])->group(function () {
     // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    
    // Stock management routes
    Route::get('/inventory/add-stock', [InventoryController::class, 'addStock'])->name('inventory.add-stock');
    Route::post('/inventory/add-stock', [InventoryController::class, 'storeAddStock'])->name('inventory.store-add-stock');
    Route::get('/inventory/deduct-stock', [InventoryController::class, 'deductStock'])->name('inventory.deduct-stock');
    Route::post('/inventory/deduct-stock', [InventoryController::class, 'storeDeductStock'])->name('inventory.store-deduct-stock');
    
    // Transaction routes
    Route::get('/transactions/{item}', [TransactionController::class, 'show'])->name('transactions.show');
    
    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';