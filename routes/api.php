<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/pensionnes', [ApiController::class, 'getPensionnes']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

