<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\UserController;

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
        Route::group([
            'prefix' => 'admin-user'
        ], function () {
            Route::post('change-passw', [AdminController::class, 'changePassw']);
            Route::post('change-info',  [AdminController::class, 'changeInfo']);
        });
    });
});
