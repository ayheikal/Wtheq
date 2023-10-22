<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\Product\ProductController;



Route::prefix("v1.0")->group( function () {

    Route::group([], function () {

        Route::post("login",[AuthController::class,"login"]);
        Route::post("register",[AuthController::class,"register"]);
        Route::resource("users",UserController::class);
        Route::resource("products",ProductController::class);
    });

});
