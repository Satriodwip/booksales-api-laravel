<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

// AUTH ROUTES 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// PUBLIC ROUTES (tanpa login)
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('transactions', TransactionController::class)->only(['index', 'show']);

// CUSTOMER ROUTES (login wajib)
Route::middleware(['auth:api', 'checkrole:customer'])->group(function () {
    Route::post('transactions', [TransactionController::class, 'store']);
});

// ADMIN ROUTES (login + role admin)
Route::middleware(['auth:api', 'checkrole:admin'])->group(function () {
    Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('transactions', TransactionController::class)->only(['update', 'destroy']);
});
