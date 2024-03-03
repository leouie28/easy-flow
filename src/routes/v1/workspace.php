<?php

use App\Http\Controllers\v1\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::middleware('auth:api')->group(function() {
        Route::resource('src', WorkspaceController::class);
        Route::get('active', [WorkspaceController::class, 'activeWorksapce']);
    });
});
