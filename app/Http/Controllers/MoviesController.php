<?php

namespace App\Http\Controllers;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = [
            ['title' => 'The Shawshank Redemption', 'year' => 1994],
            ['title' => 'The Godfather', 'year' => 1972],
            ['title' => 'The Dark Knight', 'year' => 2008],
            ['title' => 'Pulp Fiction', 'year' => 1994],
            ['title' => 'Forrest Gump', 'year' => 1994],
        ];

        return view('movies.index', ['movies' => $movies]);
    }
}
