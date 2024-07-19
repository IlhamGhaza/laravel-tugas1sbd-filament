<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FlowerArrangementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlowerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function() {
    //auth
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

    //flower
    Orion::resource('flower-arrangements', FlowerArrangementController::class)->withSoftDeletes()->middleware('auth:sanctum');
    //customer
    Orion::resource('customers', CustomerController::class)->withSoftDeletes()->middleware('auth:sanctum');
    //courier
    Orion::resource('couriers', CourierController::class)->withSoftDeletes()->middleware('auth:sanctum');

});
