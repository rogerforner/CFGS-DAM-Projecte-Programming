<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Informació del lloc web -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="A Vue API SPA Scool Programming App.">
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="app">
        <router-view></router-view>
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  </body>
</html>