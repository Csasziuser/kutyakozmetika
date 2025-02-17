<?php

use App\Http\Controllers\FoglalasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('App', [
        // 'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/api/foglalas/{datum}', [FoglalasController::class, 'getFoglalas'])->name('foglalas.getFoglalas');
Route::post('/api/foglalas/', [FoglalasController::class, 'store'])->name('foglalas.store');
Route::delete('/api/foglalas/{id}', [FoglalasController::class, 'destroy'])->name('foglalas.destroy');

require __DIR__.'/auth.php';
