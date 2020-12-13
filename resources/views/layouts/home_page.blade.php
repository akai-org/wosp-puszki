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
    <link href="{{ asset('css/home_page.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('content')

    <footer>
        @yield('footer')
    </footer>

    <script src="{{ asset('js/home_page.js') }}"></script>
    @stack('scripts')
</body>
</html>

