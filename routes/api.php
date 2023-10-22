<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use App\Http\Controllers\UploadController;



Route::prefix("v1.0")->group( function () {

    Route::group([], function () {

        // this route to upload photos
        Route::post("upload",[UploadController::class,"upload"]);

        /**
         * user login and registeration apis
         */
        Route::post("login",[AuthController::class,"login"]);
        Route::post("register",[AuthController::class,"register"]);

        /**
         * user api to retreive all users and by id and store
         */
        Route::resource("users",UserController::class);
        /**
         * products api to retreive all products and by id and store
         */
        Route::resource("products",ProductController::class);
    });

});
