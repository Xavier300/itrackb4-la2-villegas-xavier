<nav class="nav nav-tabs mb-3" aria-label="Main navigation">
    <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}"
        href="{{ route('movies.index') }}" aria-current="{{ request()->routeIs('movies.index') ? 'page' : 'false' }}">All Movies</a>
    <a class="nav-link {{ request()->routeIs('movies.show') ? 'active' : '' }}"
        href="{{ route('movies.show', ['movie' => 1]) }}" aria-current="{{ request()->routeIs('movies.show') ? 'page' : 'false' }}">Movie Details</a>
</nav>
