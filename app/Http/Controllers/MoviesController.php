<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.index', ['movies' => $this->getMovieData()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = collect($this->getMovieData())->firstWhere('id', (int) $id);

        if ($movie === null) {
            abort(404, 'Movie not found.');
        }

        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filter(?string $year = null)
    {
        $movies = $this->getMovieData();

        if ($year === null || $year === '') {
            return view('movies.filter', [
                'movies' => $movies,
                'activeFilter' => null,
            ]);
        }

        $filteredMovies = array_values(array_filter($movies, fn ($movie) => (string) $movie['year'] === (string) $year));

        return view('movies.filter', [
            'movies' => $filteredMovies,
            'activeFilter' => $year,
        ]);
    }

    private function getMovieData(): array
    {
        return [
            ['id' => 1, 'title' => 'The Shawshank Redemption', 'year' => 1994],
            ['id' => 2, 'title' => 'The Godfather', 'year' => 1972],
            ['id' => 3, 'title' => 'The Dark Knight', 'year' => 2008],
            ['id' => 4, 'title' => 'Pulp Fiction', 'year' => 1994],
            ['id' => 5, 'title' => 'Forrest Gump', 'year' => 1994],
        ];
    }
}
