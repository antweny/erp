@include('layouts.includes.header')

<main>
    <div class="container-fluid">
        <div class="row sub-menu">
            <div class="col-sm-4 col-md-2">
                <a href="{{route('location')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-map-marked-alt"></i>
                        <span>Location</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('countries.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-flag"></i>
                        <span>Countries</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('cities.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-city"></i>
                        <span>Cities/Regions</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('districts.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-building"></i>
                        <span>Districts</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('wards.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-street-view"></i>
                        <span>Wards</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('streets.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-compass"></i>
                        <span>Streets</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-2">
                <a href="{{route('venues.index')}}" class="sub-menu-link  pt-4">
                    <div>
                        <i class="fa fa-compass"></i>
                        <span>Venues</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="content" >
            @yield('content')
        </div>
    </div>
</main>

@include('layouts.includes.footer')


