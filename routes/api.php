<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login',[AuthenticationController::class,'login']);
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/logout',[AuthenticationController::class,'logout']);


Route::get('/category',[CategoryController::class,'index']);
Route::post('/category',[CategoryController::class,'store']);
Route::get('/category/{category}',[CategoryController::class,'show']);
Route::put('/category/{category}',[CategoryController::class,'update']);
Route::delete('/category/{category}',[CategoryController::class,'destroy']);

Route::get('/news',[NewsController::class,'index']);
Route::post('/news',[NewsController::class,'store']);
Route::get('/news/{news}',[NewsController::class,'show']);
Route::put('/news/{news}',[NewsController::class,'update']);
Route::delete('/news/{news}',[NewsController::class,'destroy']);