<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
