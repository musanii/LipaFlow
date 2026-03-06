<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function(){

    Route::post('/register',[RegisterController::class,'register' ]);
    Route::post('/login',[AuthController::class,'login']);

});

Route::middleware(['auth:api','tenant'])->prefix('auth')->group(function(){

    Route::get('/me',[AuthController::class,'me']);
    Route::post('/refresh',[AuthController::class, 'refresh']);
    Route::post('/logout',[AuthController::class,'logout']);

}); 

Route::middleware(['auth:api','tenant'])->group(function(){

Route::apiResource('products', ProductController::class);
Route::post('/products/{product}/image',[ProductController::class, 'uploadImage']);

});


