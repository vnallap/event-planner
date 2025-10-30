<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// 🌐 Public Routes
Route::get('events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('dashboard/stats', [DashboardController::class, 'stats']);

// 🔒 Protected API Routes (Requires Authentication)
Route::middleware('auth:sanctum')->group(function () {

    // 🗓️ Events
    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);
    Route::post('events/{event}/register', [EventController::class, 'register']);
    Route::get('events/{event}/check-registration', [EventController::class, 'checkRegistration']);

    // 🏷️ Categories
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    // 🧾 Registrations
    Route::get('registrations', [RegistrationController::class, 'index']);
    Route::post('registrations/{event}', [RegistrationController::class, 'store']);
    Route::put('registrations/{registration}', [RegistrationController::class, 'update']);
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy']);
    Route::get('registrations/check/{event}', [RegistrationController::class, 'checkRegistration']);

    // 👤 Authenticated User Info
    Route::get('me', [AuthController::class, 'me']);
});
