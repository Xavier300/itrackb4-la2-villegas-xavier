@extends('layouts.app')

@section('title', 'Show Movie')

@section('heading', 'Show Movie')

@section('content')
    <h1>{{ $movie['title'] }}</h1>

    <p><strong>Title:</strong> {{ $movie['title'] }}</p>
    <p><strong>Year:</strong> {{ $movie['year'] }}</p>

    <p><a href="{{ route('movies.index') }}">Back to list</a></p>
@endsection
