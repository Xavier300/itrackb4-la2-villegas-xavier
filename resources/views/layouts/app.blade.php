<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body class="container-fluid px-4 px-lg-5 py-2 bg-white text-body">
    <h1 class="h2 text-center fw-normal mb-4">@yield('heading', 'My Movie Site')</h1>
    <p class="small text-secondary mb-2">Prepared by: Xavier A. Villegas</p>
    @include('partials._nav')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>