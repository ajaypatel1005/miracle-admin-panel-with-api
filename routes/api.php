<?php

use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'auth:admin-api', 'prefix' => 'admin'], function () {
//     Route::get('users',[AdminController::class,'getUsers']);
// });

// Route::group(['middleware' => 'auth:api', 'prefix' => 'user'], function () {
//     Route::get('profile',[UserController::class,'getProfile']);
// });

Route::group(['prefix' => 'user'], function () {
    Route::post('login', [UserApiController::class,'login']);
    Route::middleware('jwt.verify')->group(function () {
        Route::get('profile',[UserApiController::class,'getProfile']);
    });
});

 Route::group(['prefix' => 'admin'], function () { 
    Route::post('login', [AdminApiController::class,'login']);
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('users',[AdminApiController::class,'getUsersList']);
    });
});

// Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin-api'], function () {
//     Route::get('users', [AdminApiController::class, 'getUsersList']);
// });