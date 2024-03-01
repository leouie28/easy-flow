<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(__DIR__ . '/auth.php');
Route::prefix('budgets')->group(__DIR__ . '/budget.php');
Route::prefix('budget-transactions')->group(__DIR__ . '/budget-transaction.php');
// Route::prefix('fund')->group(__DIR__ . '/fund.php');
// Route::prefix('transaction')->group(__DIR__ . '/transaction.php');

Route::prefix('inventories')->group(__DIR__ . '/inventory.php');
Route::prefix('inventory-data')->group(__DIR__ . '/inventory-data.php');