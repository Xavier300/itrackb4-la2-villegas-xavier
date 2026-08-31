Q1: I put the featured route before the detail route because Laravel matches routes from top to bottom and stops at the first match. If I swapped them, visiting /movies/featured would be treated as the detail route with id set to featured, so the featured page would never load.

Q2: If someone visits an id that does not exist, the app shows a 404 page instead of a PHP error screen. I used firstWhere to find the movie, and then I called abort(404) when there was no match.

Q3: I use route names in links because it keeps the app flexible if the URL changes later. For example, if the list route changed from /movies to /library, the back link would still work without me editing the Blade file by hand.
