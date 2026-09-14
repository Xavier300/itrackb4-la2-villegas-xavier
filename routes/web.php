<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies/filter/{year?}', [MoviesController::class, 'filter'])->name('movies.filter');

Route::resource('movies', MoviesController::class)->only(['index', 'show']);
