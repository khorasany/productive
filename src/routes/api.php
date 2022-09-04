<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\Habit\AdminController;
use App\Http\Controllers\API\Habit\HabitController;

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

Route::prefix('v1')->group(function() {
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

    Route::prefix('admin')->middleware('auth:sanctum')->group(function() {
        Route::get('users',[AdminController::class,'users']);
        Route::post('users',[AdminController::class,'create']);
        Route::get('habits',[AdminController::class,'index']);
    });

    Route::prefix('productive')->middleware('auth:sanctum')->group(function() {
//        Route::get('habits',['']);
        Route::post('habits',[HabitController::class,'store']);
    });
});
