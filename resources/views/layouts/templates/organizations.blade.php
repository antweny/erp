@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('organization')}}">
                <i class="fa fa-home"></i>
                <span>Organization Home</span>
            </a>
        </li>
        
        @can('organizationCategory-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.index')}}">
                    <i class="fa fa-flag"></i>
                    Categories
                </a>
            </li>
        @endcan
        
        @can('organization-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('organizations.index')}}">
                    <i class="fa fa-city"></i>
                    Organisation
                </a>
            </li>
        @endcan
        
        @can('sector-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('sectors.index')}}">
                    <i class="fa fa-industry"></i>
                    Sectors
                </a>
            </li>
        @endcan
        
        
        @can('field-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('fields.index')}}">
                    <i class="fa fa-bars"></i>
                    Sector Fields
                </a>
            </li>
        @endcan

    </ul>
</nav>
<!-- end sidebar -->
@include('layouts.includes.footer')


