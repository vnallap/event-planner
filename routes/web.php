<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Home page (Dashboard)
Route::get('/', [DashboardController::class, 'home'])->name('home');

// Old welcome page (redirects to home)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Login routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Register routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/options', [DashboardController::class, 'admin'])->name('admin.options');
        Route::get('/calendar', [DashboardController::class, 'admin'])->name('admin.calendar');
        Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::post('/events', [\App\Http\Controllers\EventController::class, 'store'])->name('admin.events.store');
        Route::delete('/events/{event}', [\App\Http\Controllers\EventController::class, 'destroy'])->name('admin.events.destroy');
    });

// Event registration web route (requires auth but not admin)
Route::middleware(['auth'])->group(function () {
    Route::post('/events/{event}/register', [\App\Http\Controllers\EventController::class, 'register'])->name('events.register');
});

// Fallback route — redirects unknown routes to home page
Route::fallback(function () {
    return redirect()->route('home');
});

