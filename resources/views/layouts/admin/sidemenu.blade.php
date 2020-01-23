<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
        <ul id="menu-content" class="list-group menu-content collapse out">

            <a class="list-group-item" href="{{route('admin.dashboard')}}">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>

            <li class="menu-title list-group-item">User Management</li>
            <a class="list-group-item" href="{{route('admin.index')}}">
                <i class="fa fa-user-secret"></i> Administrators
            </a>
            <a class="list-group-item" href="{{route('users.index')}}">
                <i class="fa fa-users"></i> Users
            </a>


        </ul>
    </div>
</div>
