<?php

use App\Http\Controllers\v1\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::middleware('auth:api')->group(function() {
        Route::get('active', [WorkspaceController::class, 'activeWorksapce']);
        Route::get('members', [WorkspaceController::class, 'members']);
        Route::resource('src', WorkspaceController::class);
    });
});
