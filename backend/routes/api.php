<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        
        Route::get('/{projectId}/tasks', [TaskController::class, 'indexByProject']);
        Route::post('/{projectId}/tasks', [TaskController::class, 'store']);
    });

    Route::prefix('tasks')->group(function () {
        Route::patch('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
    });
});