


                    </div>
                    <!-- pagetitle-left -->
                </div>

                <!-- Main Content Section -->
                <div class="mainContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </main><!-- Scripts -->
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

    //Digital Clock
    function currentTime (){
        var date = new Date();
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        //Display time in two digits
        hour = updateTime(hour);
        min = updateTime(min);
        sec = updateTime(sec);
        //Now lets display it in the div
        document.getElementById('clock').innerText =hour + ':' + min + ':' + sec; /* adding time to the div */
        //Setting timer
       var t = setTimeout(function () {
           currentTime()
       },1000);
    }

    //Display time in two digits
    function updateTime(k) {
        if(k < 10) {
            return '0'+k;
        }
        else {
            return k;
        }
    }

    //Call the current function to i
    currentTime();



</script>

</body>
</html>
