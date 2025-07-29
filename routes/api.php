<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/cart/place-order', [CartController::class, 'placeOrder']);
Route::middleware('auth:sanctum')->put('/user', [AuthController::class, 'update']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/meals', [MealController::class, 'index']);
Route::get('/roles', [RoleController::class, 'index']);