<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/whoami', function () {
    return 'Xavier A. Villegas | 2023-70749 | Block 4C | ITRACKB4 Laravel 12';
});

Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');

Route::get('/movies/featured', [MoviesController::class, 'featured'])->name('movies.featured');

Route::get('/movies/filter/{value?}', [MoviesController::class, 'filter'])->name('movies.filter');

Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.show');
