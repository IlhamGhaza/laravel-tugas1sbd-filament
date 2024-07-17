<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\FlowerArrangementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlowerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

//flower api
Route::resource('flower-arrangements', FlowerArrangementController::class)
// ->except(['create', 'edit'])
->middleware('auth:sanctum');



