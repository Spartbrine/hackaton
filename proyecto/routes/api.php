<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PsychologicalController;
use App\Http\Controllers\AnalysistestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;

// Rutas para UserController
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{email}', [UserController::class, 'show']);
    Route::put('/{email}', [UserController::class, 'update']);
    Route::patch('/{email}', [UserController::class, 'updatePartial']);
});

// Rutas para PsychologicalController
Route::prefix('psychological')->group(function () {
    Route::get('/', [PsychologicalController::class, 'index']);
    Route::post('/', [PsychologicalController::class, 'store']);
    Route::get('/{id}', [PsychologicalController::class, 'show']);
    Route::put('/{id}', [PsychologicalController::class, 'update']);
    Route::patch('/{id}', [PsychologicalController::class, 'updatePartial']);
});

// Rutas para AnalysistestController
Route::prefix('analysistests')->group(function () {
    Route::get('/', [AnalysistestController::class, 'index']);
    Route::post('/', [AnalysistestController::class, 'store']);
    Route::get('/{idtest}', [AnalysistestController::class, 'show']);
    Route::put('/{idtest}', [AnalysistestController::class, 'update']);
    Route::patch('/{idtest}', [AnalysistestController::class, 'updatePartial']);
});

// Rutas para CommentController
Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{id}', [CommentController::class, 'show']);
    Route::put('/{id}', [CommentController::class, 'update']);
    Route::patch('/{id}', [CommentController::class, 'updatePartial']);
});

// Rutas para PublicationController
Route::prefix('publications')->group(function () {
    Route::get('/', [PublicationController::class, 'index']);
    Route::post('/', [PublicationController::class, 'store']);
    Route::get('/{id}', [PublicationController::class, 'show']);
    Route::put('/{id}', [PublicationController::class, 'update']);
    Route::patch('/{id}', [PublicationController::class, 'updatePartial']);
});

// Rutas para StoreController
Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'index']);
    Route::post('/', [StoreController::class, 'store']);
    Route::get('/{id}', [StoreController::class, 'show']);
    Route::put('/{id}', [StoreController::class, 'update']);
    Route::patch('/{id}', [StoreController::class, 'updatePartial']);
});

// Rutas para ReviewController
Route::prefix('reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/', [ReviewController::class, 'store']);
    Route::get('/{id}', [ReviewController::class, 'show']);
    Route::put('/{id}', [ReviewController::class, 'update']);
    Route::patch('/{id}', [ReviewController::class, 'updatePartial']);
});

// Rutas para NotificationController
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/', [NotificationController::class, 'store']);
    Route::get('/{id}', [NotificationController::class, 'show']);
    Route::put('/{id}', [NotificationController::class, 'update']);
    Route::patch('/{id}', [NotificationController::class, 'updatePartial']);
});
