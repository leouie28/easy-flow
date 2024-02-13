<?php

use App\Http\Controllers\v1\BudgetController;
use Illuminate\Support\Facades\Route;

// Route::prefix('')->group(function () {
//     Route::post('/add-member/{fundId}', [FundController::class, 'addUser']);
//     Route::post('/remove-member/{fundId}', [FundController::class, 'removeUser']);
// });
Route::middleware('auth:api')->group(function() {
    Route::resource('src', BudgetController::class);
});
