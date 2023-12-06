<?php

use App\Http\Controllers\v1\FundController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::post('/add-member/{fundId}', [FundController::class, 'addUser']);
});
Route::resource('src', FundController::class);