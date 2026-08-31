<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie['title'] }}</title>
</head>
<body>
    <h1>{{ $movie['title'] }}</h1>
    <p>Prepared by: Xavier A. Villegas</p>

    <p><strong>Title:</strong> {{ $movie['title'] }}</p>
    <p><strong>Year:</strong> {{ $movie['year'] }}</p>

    <p><a href="{{ route('movies.index') }}">Back to list</a></p>
</body>
</html>
