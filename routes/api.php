<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'api.version:v1'])->group( function () {
    Route::apiResource('tasks', TaskController::class);
});

Route::middleware(['auth:sanctum', 'api.version:v2'])->group( function () {
    Route::apiResource('v2/task', TaskController::class);
});
