@include('layouts.admin.header')

    @include('layouts.admin.topnav')

        <div  class="container-fluid">
            <div class="content row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>



@include('layouts.admin.footer')
