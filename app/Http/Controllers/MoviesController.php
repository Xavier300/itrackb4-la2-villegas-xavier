<?php

namespace App\Http\Controllers;

class MoviesController extends Controller
{
    public function index()
    {
        return view('movies.index', ['movies' => $this->movies()]);
    }

    public function featured()
    {
        $movies = $this->movies();

        return view('movies.show', ['movie' => $movies[3]]);
    }

    public function show($id)
    {
        $movies = $this->movies();

        if (!isset($movies[$id])) {
            abort(404);
        }

        return view('movies.show', ['movie' => $movies[$id]]);
    }

    public function filter($value = null)
    {
        $movies = $this->movies();
        $activeFilter = null;

        if ($value !== null && $value !== '') {
            $activeFilter = (string) $value;
            $filtered = [];

            foreach ($movies as $movie) {
                if ((string) $movie['year'] === $activeFilter) {
                    $filtered[$movie['id']] = $movie;
                }
            }

            $movies = $filtered;
        }

        return view('movies.filter', [
            'movies' => $movies,
            'activeFilter' => $activeFilter,
        ]);
    }

    private function movies(): array
    {
        return [
            1 => ['id' => 1, 'title' => 'The Shawshank Redemption', 'year' => 1994],
            2 => ['id' => 2, 'title' => 'The Godfather', 'year' => 1972],
            3 => ['id' => 3, 'title' => 'The Dark Knight', 'year' => 2008],
            4 => ['id' => 4, 'title' => 'Pulp Fiction', 'year' => 1994],
            5 => ['id' => 5, 'title' => 'Forrest Gump', 'year' => 1994],
        ];
    }
}
