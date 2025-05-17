<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum',\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/items', [\App\Http\Controllers\Api\ItemController::class, 'index']);
    Route::get('/item/{id}', [\App\Http\Controllers\Api\ItemController::class, 'show']);
    Route::post('/item', [\App\Http\Controllers\Api\ItemController::class, 'store']);
    Route::put('/item/{id}', [\App\Http\Controllers\Api\ItemController::class, 'update']);
    Route::delete('/item/{id}', [\App\Http\Controllers\Api\ItemController::class, 'destroy']);
});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
