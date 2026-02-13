<?php

use App\Http\Controllers\RestFullApi\KatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\RestFullApi\LoginController::class, 'login']);
Route::get('/beranda', [App\Http\Controllers\RestFullApi\BerandaController::class, 'index'])->middleware('auth:sanctum');
Route::post('/logout', [App\Http\Controllers\RestFullApi\LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [App\Http\Controllers\RestFullApi\RegisterController::class, 'register']);

Route::get('/books', [KatalogController::class, 'index'])->middleware('auth:sanctum');
Route::get('/books/search', [KatalogController::class, 'search'])->middleware('auth:sanctum');
Route::get('/books/{id}', [KatalogController::class, 'show'])->middleware('auth:sanctum');

Route::get('/lendings', [App\Http\Controllers\RestFullApi\PeminjamanController::class, 'index'])->middleware('auth:sanctum');
Route::get('/lendings/search', [App\Http\Controllers\RestFullApi\PeminjamanController::class, 'cariPinjaman'])->middleware('auth:sanctum');
Route::post('/lendings/{id}/request', [App\Http\Controllers\RestFullApi\PeminjamanController::class, 'ajukanPinjaman'])->middleware('auth:sanctum');
Route::delete('/lendings/{id}/cancel', [App\Http\Controllers\RestFullApi\PeminjamanController::class, 'batalkanPinjaman'])->middleware('auth:sanctum');

Route::get('/profil', [App\Http\Controllers\RestFullApi\ProfilController::class, 'index'])->middleware('auth:sanctum');
Route::put('/profil', [App\Http\Controllers\RestFullApi\ProfilController::class, 'update'])->middleware('auth:sanctum');