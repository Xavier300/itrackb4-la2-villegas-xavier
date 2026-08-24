<!DOCTYPE html>
<html>
<head>
    <title>My Movies List</title>
</head>
<body>
    <h1>My Movies List</h1>
    <p>Prepared by: Xavier A. Villegas</p>
 
    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Year</th>
        </tr>
 
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie['title'] }}</td>
                <td>{{ $movie['year'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
