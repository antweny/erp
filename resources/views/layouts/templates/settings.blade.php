@include('layouts.partials.header')
@include('layouts.partials.topBar')


<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('settings')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('activityLogs.index')}}">
                <i class="fa fa-list-alt"></i>
                <span>Activity Logs</span>
            </a>
        </li>
    </ul>
</nav>


    @include('layouts.partials.toggle')


    <!-- Page Title -->

    <div class="pagetitle-icon">
        <i class="fa fa-cog"></i>
    </div>
    <div class="pagetitle-title">
        <h2>System Settings</h2>
    </div>

    <!-- end pagetitle-left-title -->


    @include('layouts.partials.footer')



