@include('layouts.app.header')

    @include('layouts.app.topnav')

    <div class="container-fluid">
        <div class="content row" >
            <aside class="col-md-2 pr-0 pl-0 pt-2 ">
                <div id="sidebar " class="position-fixed">
                    @include('layouts.app.sidemenu')
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

@include('layouts.app.footer')
