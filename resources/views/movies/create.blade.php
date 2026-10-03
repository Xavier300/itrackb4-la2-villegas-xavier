@extends('layouts.app')

@section('title', 'Create Movie')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Create a New Movie</h2>
        </div>
    </div>

    <form method="POST" action="{{ route('movies.store') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select class="form-select" id="genre" name="genre" required>
                <option value="">Select a genre</option>
                <option value="Action" @selected(old('genre') === 'Action')>Action</option>
                <option value="Comedy" @selected(old('genre') === 'Comedy')>Comedy</option>
                <option value="Drama" @selected(old('genre') === 'Drama')>Drama</option>
                <option value="Horror" @selected(old('genre') === 'Horror')>Horror</option>
                <option value="Romance" @selected(old('genre') === 'Romance')>Romance</option>
                <option value="Sci-Fi" @selected(old('genre') === 'Sci-Fi')>Sci-Fi</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control" id="year" name="year" min="1900" max="2099" value="{{ old('year') }}" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" step="0.1" value="{{ old('rating') }}" required>
        </div>
        <div class="mb-3">
            <label for="is_visible" class="form-label">Visible</label>
            <select class="form-select" id="is_visible" name="is_visible" required>
                <option value="1" @selected(old('is_visible', '1') === '1')>Yes</option>
                <option value="0" @selected(old('is_visible', '1') === '0')>No</option>
            </select>
        </div>
        <a class="btn btn-secondary" href="{{ route('movies.index') }}">Back</a>
        <button type="submit" class="btn btn-primary">Create Movie</button>
    </form>
@endsection
