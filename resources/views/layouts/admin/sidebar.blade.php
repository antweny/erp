<ul class="navbar-nav sidebar bg-black accordion text-white" id="accordionSidebar" >
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>



    @role('data-entry')
        <!-- Individual Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#people" aria-expanded="true" aria-controls="people">
                <i class="fa fa-users"></i>
                <span>People</span>
            </a>
            <div id="people" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    @if(checkPermission('educationLevel-read'))
                        <a class="collapse-item" href="{{route('educationLevels.index')}}">
                            <i class="fa fa-signal"></i>
                            Education Level
                        </a>
                    @endif
                    @if(checkPermission('individual-read'))
                        <a class="collapse-item" href="{{route('individuals.index')}}">
                            <i class="fa fa-users"></i>
                            Individuals
                        </a>
                    @endif
                    @if(checkPermission('title-read'))
                        <a class="collapse-item" href="{{route('titles.index')}}">
                            <i class="fa fa-heading"></i>
                            Position Titles
                        </a>
                    @endif
                    @if(checkPermission('position-read'))
                        <a class="collapse-item" href="{{route('positions.index')}}">
                            <i class="fa fa-briefcase"></i>
                            Positions
                        </a>
                    @endif
                    @if(checkPermission('group-read'))
                        <a class="collapse-item" href="{{route('groups.index')}}">
                            <i class="fa fa-user-tag"></i>
                            Groups
                        </a>
                    @endif
                </div>
            </div>
        </li>
    @endcan


    @role('data-entry')
        <!-- Individual Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#organization" aria-expanded="true" aria-controls="organization">
                <i class="fa fa-building"></i>
                <span>Organizations</span>
            </a>
            <div id="organization" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    @can('organizationCategory-read')
                        <a class="collapse-item" href="{{route('categories.index')}}">
                            <i class="fa fa-flag"></i>
                            Categories
                        </a>
                    @endcan
                    @can('organization-read')
                        <a class="collapse-item" href="{{route('organizations.index')}}">
                            <i class="fa fa-city"></i>
                            Organisation
                        </a>
                    @endcan
                    @can('sector-read')
                        <a class="collapse-item" href="{{route('sectors.index')}}">
                            <i class="fa fa-industry"></i>
                            Sectors
                        </a>
                    @endcan
                    @can('field-read')
                        <a class="collapse-item" href="{{route('fields.index')}}">
                            <i class="fa fa-bars"></i>
                            Sector Fields
                        </a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
