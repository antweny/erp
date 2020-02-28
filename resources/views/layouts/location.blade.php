@include('layouts.includes.header')

        <!-- Sidebar -->
        <nav id="sidebar">
            <ul class="nav" id="accordionSidebar" >
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('location')}}">
                        <i class="fa fa-map-marked-alt"></i>
                        <span>Location</span>
                    </a>
                </li>
                @can('country-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('countries.index')}}">
                            <i class="fa fa-flag"></i>
                            <span>Countries</span>
                        </a>
                    </li>
                @endcan
                @can('city-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cities.index')}}">
                            <i class="fa fa-city"></i>
                            <span>Cities/Regions</span>
                        </a>
                    </li>
                @endcan
                @can('district-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('districts.index')}}">
                            <i class="fa fa-building"></i>
                            <span>Districts</span>
                        </a>
                    </li>
                @endcan
                @can('ward-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wards.index')}}">
                            <i class="fa fa-street-view"></i>
                            <span>Wards</span>
                        </a>
                    </li>
                @endcan
                @can('street-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('streets.index')}}">
                            <i class="fa fa-compass"></i>
                            <span>Streets</span>
                        </a>
                    </li>
                @endcan
                @can('venue-read')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('venues.index')}}">
                            <i class="fa fa-compass"></i>
                            <span>Venues</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- end sidebar -->

@include('layouts.includes.footer')


