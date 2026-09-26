Q1: I did not need a new route because Laravel's router matches the request method and URL path, not the query string. `/movies`, `/movies?genre=Drama`, and `/movies?year=1994&genre=Drama` all use the same GET `/movies` route. The `index` method reads the query values and applies the filters.

Q2: If I made both filters required path parameters, a year-only URL could look like `/movies/4/all`. The second path segment would still be required, so `all` would mean no genre filter. Query parameters are simpler because I can leave the other filter out or preserve its current value.

Q3: The detail link needs to check the `movies.show` route so it is active on a movie details page. I do not need a different pattern for filtered results because adding query values does not change the route name from `movies.index`. That index navigation state therefore stays active when either filter is applied.

Q4: I removed the old `filter` method because the index now handles the year and genre filters from the query string. The empty `store` and `update` methods are resource-controller actions, but the resource route only registers `index` and `show`, so no URL reaches those methods. The old filter action had its own explicit GET route before I removed it.
