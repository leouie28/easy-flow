<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(__DIR__ . '/auth.php');
Route::prefix('fund')->group(__DIR__ . '/fund.php');