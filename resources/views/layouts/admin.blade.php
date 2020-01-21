@include('layouts.admin.header')

    @include('layouts.admin.topnav')

    <div class="container-fluid">
        <div class="content row" >
            <aside class="col-md-2 pr-0 pl-0 pt-2">
                <div id="sidebar">
                    @include('layouts.admin.sidemenu')
                </div>
            </aside>

            <!-- Content Area -->
            <main class="pt-3 col-md-10">
                <div class="col">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>



@include('layouts.admin.footer')
