@extends('layouts.app')

@section('title', 'Movies')
@section('heading', 'My Movie Site')

@section('content')
    @if ($genre === 'all' && $year === 'all')
        <p>Showing all movies</p>
    @elseif ($genre !== 'all' && $year === 'all')
        <p>Showing movies with genre: {{ $genre }}</p>
    @elseif ($genre === 'all' && $year !== 'all')
        <p>Showing movies from year: {{ $year }}</p>
    @else
        <p>Showing movies with genre: {{ $genre }} and year: {{ $year }}</p>
    @endif

    <nav aria-label="Filter by genre">
        Genre:
        <a href="{{ route('movies.index', ['year' => $year, 'genre' => 'all']) }}">All</a>
        @foreach ($genres as $availableGenre)
            <a href="{{ route('movies.index', ['year' => $year, 'genre' => $availableGenre]) }}">{{ $availableGenre }}</a>
        @endforeach
    </nav>

    <nav aria-label="Filter by year">
        Year:
        <a href="{{ route('movies.index', ['year' => 'all', 'genre' => $genre]) }}">All</a>
        @foreach ($years as $availableYear)
            <a href="{{ route('movies.index', ['year' => $availableYear, 'genre' => $genre]) }}">{{ $availableYear }}</a>
        @endforeach
    </nav>

    <p class="small mb-2">
        <a href="{{ route('movies.index') }}">Clear Filters</a>
    </p>

    <table class="table table-striped table-bordered table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Visible</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('movies.show', ['movie' => $movie['id']]) }}">
                            {{ $movie['title'] }}
                        </a>
                    </td>
                    <td>
                        {{ $movie['year'] }}
                        @if ($movie['year'] >= 2000)
                            <span class="badge bg-success">Recent</span>
                        @else
                            <span class="badge bg-secondary">Classic</span>
                        @endif
                    </td>
                    <td>{{ $movie['genre'] }}</td>
                    <td>{{ number_format($movie['rating'], 1) }}/10</td>
                    <td>
                        @if (($movie['is_visible'] ?? false))
                            <span class="badge bg-success">Visible</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No movies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
