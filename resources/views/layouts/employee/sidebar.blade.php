<ul class="navbar-nav sidebar bg-black accordion text-white" id="accordionSidebar" >
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('employee.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Store Request -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('employee.itemRequests.index')}}">
            <i class="fas fa-store"></i>
            Store Request
        </a>
    </li>


    <!-- Events Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#eventManage" aria-expanded="true" aria-controls="eventManage">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
        </a>
        <div id="eventManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('employee.eventCategories.index')}}">
                    <i class="fa fa-list-alt"></i>
                    Event Categories
                </a>
                <a class="collapse-item" href="{{route('employee.events.index')}}">
                    <i class="fa fa-calendar"></i>
                    Events
                </a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
