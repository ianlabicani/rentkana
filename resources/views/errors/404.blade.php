<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <p class="fs-3"><span class="text-danger">Oops!</span> Page not found.</p>
        <p class="lead">The page you are looking for might have been removed or is temporarily unavailable.</p>
        @include('_ui.back-button')
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</body>

</html>