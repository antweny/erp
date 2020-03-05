@include('layouts.partials.header')
@include('layouts.partials.topBar')


<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('individual')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @can('educationLevel-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('educationLevels.index')}}">
                    <i class="fa fa-signal"></i>
                    Education Level
                </a>
            </li>
        @endcan

        @can('individual-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('individuals.index')}}">
                    <i class="fa fa-users"></i>
                    Individuals
                </a>
            </li>
        @endcan

        @can('title-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('titles.index')}}">
                    <i class="fa fa-heading"></i>
                    Position Titles
                </a>
            </li>
        @endcan

        @can('position-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('positions.index')}}">
                    <i class="fa fa-briefcase"></i>
                    Positions
                </a>
            </li>
        @endcan

        @can('group-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('groups.index')}}">
                    <i class="fa fa-user-tag"></i>
                    Groups
                </a>
            </li>
        @endcan


    </ul>
</nav>

    @include('layouts.partials.toggle')


    <!-- Page Title -->

    <div class="pagetitle-icon">
        <i class="fa fa-users"></i>
    </div>
    <div class="pagetitle-title">
        <h2>Individuals Management</h2>
    </div>

    <!-- end pagetitle-left-title -->


    @include('layouts.partials.footer')





