<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('sign-up', [AuthController::class, 'signUp']);
    Route::post('sign-in', [AuthController::class, 'signIn']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('auth')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
    });

    Route::prefix('product')->group(function () {
        Route::post('', [ProductController::class, 'create']);
        Route::post('list', [ProductController::class, 'dataTable']);
        Route::get('{id}', [ProductController::class, 'find']);
        Route::post('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'delete']);
    });
});
