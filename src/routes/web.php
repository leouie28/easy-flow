<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/auth/google', function() {
    return Socialite::driver('google')->stateless()->redirect();
});

Route::get('/auth/google/call-back', function() {
    $user = Socialite::driver('google')->stateless()->user();
    return [
        'name' => $user->name,
        'email' => $user->email,
        'token' => $user->token,
        'refresh_token' => $user->token
    ];
});

Route::get('/', function () {
    return view('welcome');
});
