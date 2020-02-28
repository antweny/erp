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
    <header class="bg-blue fixed-top">
        <nav class="navbar navbar-expand-lg">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa fa-users"></i>
                            <span>Main Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="text-white h4"><span class="text-warning">Date</span> @php echo date('d M, Y'); @endphp</span>
                        <span class="text-white h4"><span class="text-danger">Time </span>@php echo date('h:i a'); @endphp</span>
                    </li>
                </ul>
            </div>
            <!-- Right Links-->
            <div class="navbar-collapse collapse order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto right-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> {{auth()->user()->name}}
                        </a>
                        <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><i class="icon_profile"></i> My Profile</a>
                            <a class="dropdown-item logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon_key_alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> @csrf</form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="wrapper">
