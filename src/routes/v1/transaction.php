<?php

use App\Http\Controllers\v1\TransactionController;
use Illuminate\Support\Facades\Route;

Route::resource('src', TransactionController::class);