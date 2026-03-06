<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class,'login']);
Route::post('/auth/register', [RegisterController::class,'register']);


Route::middleware('auth:api')->prefix('auth')->group(function(){
    Route::get('/me',[AuthController::class,'me']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::post('/refresh',[AuthController::class, 'refresh']);
});

Route::middleware(['auth:api','tenant'])->group(function(){

Route::apiResource('products', ProductController::class);
Route::post('/products/{product}/image',[ProductController::class, 'uploadImage']);

});


