<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AllResourcesController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// User auth routes
Route::post('/user/login', [UserAuthController::class, 'login']);

Route::middleware('auth:user')->group(function () {
    Route::post('/user/logout', [UserAuthController::class, 'logout']);
    Route::get('/user/me', [UserAuthController::class, 'me']);
});

// Admin auth routes
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);
    Route::get('/admin/me', [AdminAuthController::class, 'me']);
});

// Protected routes with authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('events', AllResourcesController::class);
    Route::resource('users', AllResourcesController::class);
    Route::resource('vendors', AllResourcesController::class);
    Route::resource('participations', AllResourcesController::class);
    Route::resource('admins', AllResourcesController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
