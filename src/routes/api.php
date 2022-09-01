<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
const VERSION_1 = 'v1';

Route::prefix(VERSION_1)->group(function() {
    Route::prefix('auth')->group(function() {
        // Public auth routes
        Route::post('register',[AuthController::class,'register']);
        Route::post('register/social',[AuthController::class,'social_register']);
        Route::post('login',[AuthController::class,'login']);
        Route::post('login/social',[AuthController::class,'social_login']);

        // Protected auth routes
        Route::middleware('auth:sanctum')->group(function() {
            Route::post('logout',[AuthController::class,'logout']);
        });
    });
});
