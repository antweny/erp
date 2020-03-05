@include('layouts.includes.header')
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
<!-- end sidebar -->
@include('layouts.includes.footer')


