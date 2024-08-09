<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;

Route::get('/login/{id}', [UserController::class, 'show']);
Route::post('/registration', [UserController::class, 'store']);
Route::get('/all', [UserController::class, 'index']);


use App\Http\Controllers\TestController;
Route::get('/test/{id}', [TestController::class, 'show']);
Route::post('/test', [TestController::class, 'store']);
Route::get('/tests', [TestController::class, 'index']);

// Store routes
use App\Http\Controllers\StoreController;
Route::get('/store/{id}', [StoreController::class, 'show']);
Route::post('/store', [StoreController::class, 'store']);
Route::get('/stores', [StoreController::class, 'index']);

// Publication routes
use App\Http\Controllers\PublicationController;
Route::get('/publication/{id}', [PublicationController::class, 'show']);
Route::post('/publication', [PublicationController::class, 'store']);
Route::get('/publications', [PublicationController::class, 'index']);

// Psychological routes
use App\Http\Controllers\PsychologicalController;
Route::get('/psychological/{id}', [PsychologicalController::class, 'show']);
Route::post('/psychological', [PsychologicalController::class, 'store']);
Route::get('/psychologicals', [PsychologicalController::class, 'index']);

// Notification routes
use App\Http\Controllers\NotificationController;
Route::get('/notification/{id}', [NotificationController::class, 'show']);
Route::post('/notification', [NotificationController::class, 'store']);
Route::get('/notifications', [NotificationController::class, 'index']);

// Comment routes
use App\Http\Controllers\CommentController;
Route::get('/comment/{id}', [CommentController::class, 'show']);
Route::post('/comment', [CommentController::class, 'store']);
Route::get('/comments', [CommentController::class, 'index']);

// Analysistest routes
use App\Http\Controllers\AnalysistestController;
Route::get('/analysistest/{id}', [AnalysistestController::class, 'show']);
Route::post('/analysistest', [AnalysistestController::class, 'store']);
Route::get('/analysistests', [AnalysistestController::class, 'index']);