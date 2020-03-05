@include('layouts.partials.header')
@include('layouts.partials.topBar')


<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('security')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fa fa-user-secret"></i>
                <span>Administrators</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fa fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('employeeLogin')}}">
                <i class="fa fa-user-friends"></i>
                <span>Employee Login</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('roles.index')}}">
                <i class="fa fa-key"></i>
                <span>Roles</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('permissions.index')}}">
                <i class="fa fa-user-shield"></i>
                <span>Permissions</span>
            </a>
        </li>
    </ul>
</nav>

    @include('layouts.partials.toggle')


    <!-- Page Title -->

    <div class="pagetitle-icon">
        <i class="fa fa-lock"></i>
    </div>
    <div class="pagetitle-title">
        <h2>System Security & Authentication</h2>
    </div>

    <!-- end pagetitle-left-title -->


    @include('layouts.partials.footer')



