<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Provider\ProviderController;
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
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{category}', [CategoryController::class, 'show']);
Route::put('/category/{category}', [CategoryController::class, 'update']);
Route::delete('/category/{category}', [CategoryController::class, 'destroy']);

// Providers
Route::get('/provider', [ProviderController::class, 'index']);
Route::post('/provider', [ProviderController::class, 'store']);
Route::get('/provider/{provider}', [ProviderController::class, 'show']);
Route::post('/provider/{provider}', [ProviderController::class, 'update']);
Route::delete('/provider/{provider}', [ProviderController::class, 'destroy']);
//End Providers

Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signUp']);
// mover hacia el login
// category

// end category
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
