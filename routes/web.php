<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/edit-profile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('edit-profile');
Route::patch('/update-profile',[\App\Http\Controllers\HomeController::class,'updateProfile'])->name('update-profile');
Route::patch('/update-password',[\App\Http\Controllers\HomeController::class,'updatePassword'])->name('update-password');