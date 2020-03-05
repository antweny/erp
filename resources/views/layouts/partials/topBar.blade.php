<header class="bg-blue fixed-top">
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
        <a class="navbar-brand" href="{{route('admin.dashboard')}}">Main Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{auth()->user()->name}}</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                        <a class="dropdown-item logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> @csrf</form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->
</header>

<!-- Start Main Content Style -->
<main>
    <div class="wrapper">
