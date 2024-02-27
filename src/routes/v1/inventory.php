<?php

use App\Http\Controllers\v1\InventoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::middleware('auth:api')->group(function() {
        Route::resource('src', InventoryController::class);
    });
});
