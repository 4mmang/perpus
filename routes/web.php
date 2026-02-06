<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KatalogBukuController;
use App\Http\Controllers\Admin\KategoriBukuController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('categories',KategoriBukuController::class)->middleware('auth');
Route::resource('books', KatalogBukuController::class)->middleware('auth');
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');
Route::resource('students', SiswaController::class)->middleware('auth');