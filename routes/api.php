<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlowerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//flower api
Route::get('/flower', [FlowerController::class, 'index'])->middleware('auth:sanctum');
Route::post('/flower/{id}', [FlowerController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/flower/{id}', [FlowerController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/flower/{id}', [FlowerController::class, 'update'])->middleware('auth:sanctum');
Route::apiResource('flower', FlowerController::class)->middleware('auth:sanctum');


