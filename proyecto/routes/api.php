<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;

Route::get('/login/{id}', [UserController::class, 'show']);
Route::post('/registration', [UserController::class, 'store']);
Route::get('/all', [UserController::class, 'index']);