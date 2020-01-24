<nav class="navbar navbar-expand-lg bg-blue fixed-top">
    <a class="navbar-brand logo" href="{{url('/')}}">TGNP <span>MIS</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                    <span class="icon"></span><i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <!-- Organization and associated details management -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-store"></i> Store Management
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('itemCategories.index')}}"><i class="fa fa-list-alt"></i>Items Categories</a>
                    <a class="dropdown-item" href="#"><i class="fab fa-product-hunt"></i>Items</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-download"></i>Stock In</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-upload"></i>Stock Out</a>
                </div>
            </li>

            <!-- Organization and associated details management -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fab fa-houzz"></i> Human Resource
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-building"></i>Department</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-user-tag"></i>Employee</a>
                </div>
            </li>



        </ul>

    </div>


    <!-- Right Links-->
    <div class="navbar-collapse collapse order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto right-nav">
            @role('superAdmin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> Settings
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('activityLogs.index')}}"><i class="fa fa-list-alt"></i> Activity Logs</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shield-alt"></i> Security
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('permissions.index')}}"><i class="fa fa-lock"></i> Permissions</a>
                    <a class="dropdown-item" href="{{route('roles.index')}}"><i class="fa fa-shield-alt"></i> Roles</a>
                    <a class="dropdown-item" href="{{route('admin.index')}}"><i class="fa fa-user-shield"></i> Administrators</a>
                    <a class="dropdown-item" href="{{route('users.index')}}"><i class="fa fa-user-lock"></i> Users</a>
                </div>
            </li>
            @endrole
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> {{auth()->user()->name}}
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="icon_profile"></i> My Profile</a>
                    <a class="dropdown-item" href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                    <a class="dropdown-item" href="#"><i class="icon_clock_alt"></i> Timeline</a>
                    <a class="dropdown-item" href="#"><i class="icon_chat_alt"></i> Chats</a>
                    <a class="dropdown-item logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon_key_alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> @csrf</form>
                </div>
            </li>



        </ul>
    </div>

</nav>
