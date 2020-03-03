@include('layouts.partials.header')

<header class="bg-blue fixed-top">
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
        <a class="navbar-brand" href="#">Main Dashboard</a>
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
                        <a class="dropdown-item logout" href="{{ route('employee.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;"> @csrf</form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->
</header>

<!-- Main Content-->
<main>
    <div class="wrapper">

        <!-- Start Sidebar Section -->
        <nav id="sidebar">
            <ul class="nav" id="accordionSidebar" >
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee.dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee.itemRequests.index')}}">
                        <i class="fas fa-store"></i>
                        Store Request
                    </a>
                </li>

                <!-- Events Management -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#eventManage" aria-expanded="true" aria-controls="eventManage">
                        <i class="fa fa-calendar"></i>
                        <span>Events</span>
                    </a>
                    <div id="eventManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <a class="collapse-item" href="{{route('employee.eventCategories.index')}}">
                            Event Categories
                        </a>
                        <a class="collapse-item" href="{{route('employee.events.index')}}">
                            Events
                        </a>
                    </div>
                </li>


            </ul>
        </nav>
        <!-- end sidebar section -->



        <!-- Page Content -->
        <div id="content">
            <!-- Sidebar Toggle button -->
            <nav class="navbar navbar-expand-lg">
                <button type="button" id="sidebarCollapse" class="btn btn-info text-white btn-sm">
                    <i class="fas fa-times"></i>
                </button>
            </nav>

            <!-- Main Content Section -->
            <div class="mainContent">
                @yield('content')
            </div>
        </div>
        <!-- end page content -->

    </div>
</main>
<!-- end main content -->
@include('layouts.partials.footer')
