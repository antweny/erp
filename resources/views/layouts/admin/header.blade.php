<nav class="navbar navbar-expand-lg bg-blue">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="text-white h4">@php echo date('h:i a'); @endphp</span>
            </li>
        </ul>

    </div>


    <!-- Right Links-->
    <div class="navbar-collapse collapse order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto right-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> {{auth()->user()->name}}
                </a>
                <div class="dropdown-menu b-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="icon_profile"></i> My Profile</a>
                    <a class="dropdown-item logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon_key_alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> @csrf</form>
                </div>
            </li>



        </ul>
    </div>

</nav>
