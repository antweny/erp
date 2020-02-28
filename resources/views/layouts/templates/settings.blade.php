@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('settings')}}">
                <i class="fa fa-home"></i>
                <span>Settings Home</span>
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
<!-- end sidebar -->
@include('layouts.includes.footer')


