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
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:2099'],
            'rating' => ['required', 'numeric', 'min:0', 'max:10'],
            'is_visible' => ['required', 'boolean'],
        ], [
            'title.max' => 'The title must not be greater than 255 characters.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year must not be greater than 2099.',
        ]);

        $movies = $this->Movies();
        $nextId = collect($movies)->max('id') + 1;

        $movies[$nextId] = [
            'id' => $nextId,
            'title' => $validated['title'],
            'year' => (int) $validated['year'],
            'genre' => $validated['genre'],
            'rating' => (float) $validated['rating'],
            'is_visible' => (bool) $validated['is_visible'],
        ];

        $this->saveMovies($movies);
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
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

    private function Movies()
    {
        $path = storage_path('app/Movies.json');

        return json_decode(file_get_contents($path), true) ?? [];
    }

    private function saveMovies($movies): void
    {
        file_put_contents(
            storage_path('app/Movies.json'),
            json_encode($movies, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
