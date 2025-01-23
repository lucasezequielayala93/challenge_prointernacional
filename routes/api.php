<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
        Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
    });
    Route::put('/articles/{id}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/users', fn() => response()->json(\App\Models\User::all()));
