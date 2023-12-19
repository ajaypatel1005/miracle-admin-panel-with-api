<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
        
        //Begin::Users
        Route::get('users',[UserController::class,'index']);
        Route::get('users-create',[UserController::class,'create']);
        Route::post('users-store',[UserController::class,'store'])->name('users-store');
        Route::get('users-edit/{id}',[UserController::class,'edit']);
        Route::get('users-delete/{id}',[UserController::class,'destroy']);
        Route::post('users-update', [UserController::class, 'update'])->name('users-update');
        //End::Users

    });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
