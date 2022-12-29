<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/{id}/edit', [AdminController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/{id}', [AdminController::class, 'update'])->name('dashboard.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('packages', PackageController::class);
});

require __DIR__.'/auth.php';
