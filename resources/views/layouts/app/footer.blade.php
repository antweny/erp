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
