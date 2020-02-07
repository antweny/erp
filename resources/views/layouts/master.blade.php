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
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- font awesome icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >

    <!-- -->
    <link href="{{ asset('vendor/gijgo/gijgo.min.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('vendor/DataTables/dataTables.min.css') }}" rel="stylesheet">

    <!-- Select Dropdown -->
    <link href="{{ asset('vendor/select/select.min.css') }}" rel="stylesheet">







    <!-- custom style -->
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">

    @include('layouts.admin.topnav')

    <div  class="container-fluid">
        <div class="content">
            @yield('body')
        </div>
    </div>


</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/gijgo/gijgo.min.js') }}" ></script>
<script src="{{ asset('vendor/DataTables/dataTables.min.js') }}" ></script>
<script src="{{ asset('vendor/select/select.min.js') }}" ></script>

<script>

    $(document).ready( function () {
        $('#table').DataTable({
            "iDisplayLength": 25
        });
        $('#activityTable').DataTable({
            "iDisplayLength": 25
        });
        // Material Multi Select Initialization
        $('.multiple-select-id').select2({

        });
        $('b[role="presentation"]').hide()

        // Material Multi Select Initialization
        $('.single-select').select2();
        //Count number of words in event textarea
    } );


    $('#start_date').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        //format: 'yyyy-dd-mm'
    });

    $('#end_date').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        //format: 'yyyy-dd-mm'
    });

    $('#dob').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        //format: 'yyyy-dd-mm'
    });

    $(document).ready(function () {
        $("#editor").editor();
    });

</script>


</body>
</html>

