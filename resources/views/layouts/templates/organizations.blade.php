@include('layouts.partials.header')
@include('layouts.partials.topBar')


<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('organization')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
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


    @include('layouts.partials.toggle')


    <!-- Page Title -->

    <div class="pagetitle-icon">
        <i class="fa fa-city"></i>
    </div>
    <div class="pagetitle-title">
        <h2>Organizations Management</h2>
    </div>

    <!-- end pagetitle-left-title -->


    @include('layouts.partials.footer')



