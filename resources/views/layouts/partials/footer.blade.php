<!-- Scripts -->
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
        // Material Multi Select Initialization
        $('.multiple-select-id').select2();

        // Material Single Select Initialization
        $('.single-select').select2();
    });
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

    $('#date').datepicker({
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
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });

</script>

</body>
</html>
