<?php

use App\Http\Controllers\RestFullApi\KatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\RestFullApi\LoginController::class, 'login']);
Route::get('/beranda', [App\Http\Controllers\RestFullApi\BerandaController::class, 'index'])->middleware('auth:sanctum');
// Route::get('/beranda', [App\Http\Controllers\RestFullApi\BerandaController::class, 'index']);
Route::post('/logout', [App\Http\Controllers\RestFullApi\LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [App\Http\Controllers\RestFullApi\RegisterController::class, 'register']);

Route::get('/books', [KatalogController::class, 'index'])->middleware('auth:sanctum');