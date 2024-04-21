<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
