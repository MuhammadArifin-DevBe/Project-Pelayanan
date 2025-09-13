<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class)
        ->except(['show'])
        ->names([
            'index' => 'dashboard'
        ]);

    Route::get('/dashboard/print', [DashboardController::class, 'print'])->name('dashboard.print');
    Route::post('/dashboard/reset', [DashboardController::class, 'reset'])->name('dashboard.reset');
    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');
});

Route::resource('product', ProductController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
