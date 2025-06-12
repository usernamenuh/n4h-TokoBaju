<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('baju', App\Http\Controllers\BajuController::class);
Route::resource('beli', App\Http\Controllers\BeliController::class);
Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
