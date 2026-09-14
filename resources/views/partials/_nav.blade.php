<nav class="navbar navbar-expand-lg navbar-light text-bg-light p-2">
    <a class="nav-link p-3" href="{{ route('movies.index') }}">Movies</a>
    <a class="nav-link p-3" href="{{ route('movies.filter') }}">Filter</a>
    <a class="nav-link p-3" href="{{ route('movies.show', ['movie' => 1]) }}">Show</a>
</nav>
