<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Route untuk proses update data users dan update password
 */
Route::get('/edit-profile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('edit-profile');
Route::patch('/update-profile',[\App\Http\Controllers\HomeController::class,'updateProfile'])->name('update-profile');
Route::patch('/update-password',[\App\Http\Controllers\HomeController::class,'updatePassword'])->name('update-password');