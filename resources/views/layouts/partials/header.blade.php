<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- fontawesome icons-->
    <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- Date Style -->
    <link href="{{ asset('vendor/gijgo/gijgo.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('vendor/DataTables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/DataTables/dataTables.min.css') }}" rel="stylesheet">


    <!-- Select Dropdown -->
    <link href="{{ asset('vendor/select/select.min.css') }}" rel="stylesheet">


    <!-- Custom Style -->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
