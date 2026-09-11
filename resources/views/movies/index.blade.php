@extends('layouts.app')

@section('title', 'Movies')

@section('content')
    <table class="table table-striped mt-4" border="1" cellpadding="8">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('movies.show', ['id' => $movie['id']]) }}">{{ $movie['title'] }}</a></td>
                    <td>
                        {{ $movie['year'] }}
                        @if ($movie['year'] >= 2000)
                            <span class="badge bg-success">Recent</span>
                        @else
                            <span class="badge bg-secondary">Classic</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No movies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
