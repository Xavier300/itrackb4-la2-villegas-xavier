<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('movies', MoviesController::class)->only(['index', 'show', 'create', 'store']);
