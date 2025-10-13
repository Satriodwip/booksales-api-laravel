<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BookController,
    AuthorController,
    GenreController,
    TransactionController,
    UserController
};

Route::get('/', function () {
    return view('welcome');
});
// CRUD Routes
Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('genres', GenreController::class);
