<?php

use App\Http\Controllers\ErrorsController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth.rapidapi')->group(function () {
    Route::get('/news', [NewsController::class, 'index']);
});

Route::middleware('auth.parser')->group(function () {
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/links', [NewsController::class, 'update_url_validity']);
    Route::post('/parse_error', [ErrorsController::class, 'store_parse_errors']);
});
