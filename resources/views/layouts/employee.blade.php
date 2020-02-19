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

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- font awesome icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <!-- Date Picker -->
    <link href="{{ asset('vendor/gijgo/gijgo.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('vendor/DataTables/dataTables.min.css') }}" rel="stylesheet">
    <!-- Select Dropdown -->
    <link href="{{ asset('vendor/select/select.min.css') }}" rel="stylesheet">

    <!-- custom style -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/employee.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
    @include('layouts.employee.sidebar')
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        @include('layouts.employee.header')
        <!-- Main Content -->
            <div id="content" class="pt-3">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/gijgo/gijgo.min.js') }}" ></script>
<script src="{{ asset('vendor/DataTables/dataTables.min.js') }}" ></script>
<script src="{{ asset('vendor/select/select.min.js') }}" ></script>
<script src="{{ asset('js/sb-admin.min.js') }}" ></script>
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

        $('#date').datepicker({
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

        $('#doj').datepicker({
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

