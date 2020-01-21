<!--nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top">
    <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
        <a class="navbar-brand" href="#">
            Navbar 7
        </a>
        <div class="w-100 text-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar7">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar7">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Link</a>
            </li>
            @auth
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="username">{{auth()->user()->name}}</span><b class="caret"></b></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="icon_profile"></i> My Profile</a>
                        <a class="dropdown-item" href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                        <a class="dropdown-item" href="#"><i class="icon_clock_alt"></i> Timeline</a>
                        <a class="dropdown-item" href="#"><i class="icon_chat_alt"></i> Chats</a>
                        <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon_key_alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf</form>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>
