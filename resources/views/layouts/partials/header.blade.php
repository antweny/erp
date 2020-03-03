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
    <!-- Date Style -->
    <link href="{{ asset('vendor/gijgo/gijgo.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('vendor/DataTables/dataTables.min.css') }}" rel="stylesheet">
    <!-- Select Dropdown -->
    <link href="{{ asset('vendor/select/select.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom Style -->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
