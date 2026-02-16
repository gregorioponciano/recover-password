<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// cadastro
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// dashboard
Route::get('/dashboard', function () {
    return "Dashboard";
})->middleware('auth');

// forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgot']);
Route::post('/forgot-password', [AuthController::class, 'sendLink'])->name('password.email');

// reset password
Route::get('/reset-password/{token}', function ($token) {
    return view('reset', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
