<?php

use App\Http\Controllers\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function() {
    Route::get('refresh-token', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'profile'])->name('profile');
});