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
    <!-- DataTables -->
    <link href="{{ asset('vendor/DataTables/dataTables.min.css') }}" rel="stylesheet">
    <!-- custom style -->
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="content" >
            @yield('content')
        </div>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Affix Js-->
<script src="{{ asset('vendor/DataTables/dataTables.min.js') }}" ></script>
<script>
    $(document).ready( function () {
        $('#table').DataTable({
            "iDisplayLength": 25
        });
    });
</script>
@yield('scripts')
</body>
</html>


