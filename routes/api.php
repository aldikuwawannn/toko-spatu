<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('user', UserController::class);
Route::resource('auth', AuthController::class);


Route::get('/product', [ProductController::class, 'all']);
Route::get('/categories', [ProductCategoryController::class, 'all']);
