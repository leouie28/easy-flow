<?php

use App\Http\Controllers\v1\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function() {
    Route::resource('src', TransactionController::class)->except(['create', 'edit']);
});