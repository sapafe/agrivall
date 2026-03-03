<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;

Route::view('/', 'home');

Route::get('/blog', [PostController::class , 'index'])->name('posts.index');
Route::get('/blog/{post}', [PostController::class , 'show'])->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/la-casella', [ReservationController::class , 'create'])->name('casella.create');
    Route::post('/la-casella/reservar', [ReservationController::class , 'store'])->name('casella.store');
});
Route::get('/login', [AuthController::class , 'show'])->name('login');
Route::post('/login', [AuthController::class , 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');