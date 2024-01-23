<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wosp') }}</title>

    <script type="text/javascript" src="{{ asset('js\jquery-3.2.1.min.js') }}"></script>
    <!-- Styles -->
    @vite('resources/sass/home_page.scss')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('content')

    <footer>
        @yield('footer')
    </footer>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
