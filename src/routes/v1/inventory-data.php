<?php

use App\Http\Controllers\v1\InventoryDataController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::middleware('auth:api')->group(function() {
        Route::get('{id}', [InventoryDataController::class, 'index']);
        Route::post('{id}', [InventoryDataController::class, 'store']);
    });
});