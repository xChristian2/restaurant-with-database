<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

// Home
Route::get('/', function () {
    return view('home');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Registration routes
Route::get('/registration', [AuthController::class, 'showRegisterForm'])->name('registration');
Route::post('/registration', [AuthController::class, 'register']);

// Reservation (requires authentication)
Route::get('/reservation', function () {
    return view('reservation');
})->middleware('auth'); 

// Profile routes (requires authentication)
Route::middleware(['auth'])->group(function () {

    // Show profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Update password
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Upload profile photo
    Route::post('/profile/upload', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload');
});

Route::get('/', [HomeController::class, 'index'])->name('home');



