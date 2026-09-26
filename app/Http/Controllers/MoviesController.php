<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $year = $request->query('year', 'all');
        $genre = $request->query('genre', 'all');
        $allMovies = $this->Movies();
        $movies = $allMovies;
        $years = array_values(array_unique(array_column($allMovies, 'year')));
        $genres = array_values(array_unique(array_column($allMovies, 'genre')));

        if ($year !== 'all' || $genre !== 'all') {
            $movies = array_values(array_filter($movies, function ($movie) use ($year, $genre) {
                return ($year === 'all' || (string) $movie['year'] === (string) $year)
                    && ($genre === 'all' || $movie['genre'] === $genre);
            }));
        }

        return view('movies.index', [
            'movies' => $movies,
            'year' => $year,
            'genre' => $genre,
            'years' => $years,
            'genres' => $genres,
        ]);
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
        $movie = collect($this->Movies())->firstWhere('id', (int) $id);

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
        $movies = $this->Movies();

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

    private function Movies(): array
    {
        return [
            ['id' => 1, 'title' => 'The Shawshank Redemption', 'year' => 1994, 'genre' => 'Drama', 'rating' => 9.3],
            ['id' => 2, 'title' => 'The Godfather', 'year' => 1972, 'genre' => 'Crime', 'rating' => 9.2],
            ['id' => 3, 'title' => 'The Dark Knight', 'year' => 2008, 'genre' => 'Action', 'rating' => 9.0],
            ['id' => 4, 'title' => 'Pulp Fiction', 'year' => 1994, 'genre' => 'Crime', 'rating' => 8.9],
            ['id' => 5, 'title' => 'Forrest Gump', 'year' => 1994, 'genre' => 'Drama', 'rating' => 8.8],
        ];
    }
}
