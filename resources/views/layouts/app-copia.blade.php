<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- WebSite: info -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="A Vue API SPA Scool Programming App.">

    <!-- WebSite: favicon -->

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>
<body>
    <!-- Content -->
    <main id="app">
        @yield('content')
    </main><!-- /.container -->

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>