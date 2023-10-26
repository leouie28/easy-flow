<?php

use App\Models\User;
use App\Notifications\VerificationEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/test-email', function() {
    $user = User::whereEmail('leouietabique@gmail.com')->first();

    $user->notify(new VerificationEmailNotification());

    return 'verification mail sent';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
