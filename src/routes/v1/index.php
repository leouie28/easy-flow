<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(__DIR__ . '/auth.php');
Route::prefix('transact')->group(__DIR__ . '/transaction.php');