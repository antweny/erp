<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- fontawesome icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom Style -->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.topBar')

    <div class="container-fluid pt-5" style="margin-top: 50px;">
        <!-- Main Content Section -->
            @yield('content')
    </div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

