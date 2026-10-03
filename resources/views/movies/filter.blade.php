@extends('layouts.app')

@section('title', 'Filter Movies')

@section('heading', 'Filter Movie')

@section('content')
    @if ($activeFilter === 'all')
        <h4 class="mt-4">All items are shown</h4>
    @else
        <h4 class="mt-4">Filtered by year: {{ $activeFilter }}</h4>
    @endif

    <table class="table table-striped mt-4" border="1" cellpadding="8">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('movies.show', ['movie' => $movie['id']]) }}">{{ $movie['title'] }}</a></td>
                    <td>{{ $movie['year'] }}</td>
                    <td>{{ $movie['genre'] }}</td>
                    <td>{{ number_format($movie['rating'], 1) }}/10</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No movies found for this year.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a class="btn btn-secondary" href="{{ route('movies.index') }}">Back</a>
@endsection
