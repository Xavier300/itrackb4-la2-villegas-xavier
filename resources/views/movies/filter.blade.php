<!DOCTYPE html>
<html>
<head>
    <title>Movie Filter</title>
</head>
<body>
    <h1>Movie Filter</h1>
    <p>Prepared by: Xavier A. Villegas</p>

    @if ($activeFilter)
        <p>Filtered by year: {{ $activeFilter }}</p>
    @else
        <p>All items are shown</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Year</th>
        </tr>

        @foreach ($movies as $movie)
            <tr>
                <td><a href="{{ route('movies.show', ['id' => $movie['id']]) }}">{{ $movie['title'] }}</a></td>
                <td>{{ $movie['year'] }}</td>
            </tr>
        @endforeach
    </table>

    <p><a href="{{ route('movies.index') }}">Back to list</a></p>
</body>
</html>
