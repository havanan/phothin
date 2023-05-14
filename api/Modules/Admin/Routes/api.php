<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\UserController;

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

Route::group([
    'prefix' => 'admin'
], function () {
    // Chưa đăng nhập
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login',        [LoginController::class, 'login']);
    });
    // Đã đăng nhập
    Route::group([
        'middleware' => 'auth.admin'
    ], function () {

        Route::group([
            'prefix' => 'auth'
        ], function () {
            Route::get('user',       [UserController::class, 'user']);
            Route::get('token',      [LoginController::class, 'refresh']);
            Route::post('logout',    [LoginController::class, 'logout']);
        });
        Route::group([
            'prefix' => 'user'
        ], function () {
            Route::post('change-passw', [UserController::class, 'changePassw']);
        });
    });
});
