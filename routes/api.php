<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/transaction', [TransactionController::class, 'index']);
// Route::post('/transaction', [TransactionController::class, 'store']);
// Route::post('/transaction/{id}', [TransactionController::class, 'update']);
// Route::get('/transaction/{id}', [TransactionController::class, 'show']);
// Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);

// Route::resource('/transaction', TransactionController::class)->except(['create','edit']);

// Resource termasuk method GET, POST, PUT, DELETE
// Jadi tidak perlu menulis route untuk method GET, POST, PUT, DELETE
// Except untuk mengecualikan method yang tidak digunakan

Route::resource('/transaction', TransactionController::class);
