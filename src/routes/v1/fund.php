<?php

use App\Http\Controllers\v1\FundController;
use Illuminate\Support\Facades\Route;

Route::resource('src', FundController::class);