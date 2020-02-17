<ul class="navbar-nav sidebar bg-black accordion text-white" id="accordionSidebar" >
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#empManage" aria-expanded="true" aria-controls="empManage">
            <i class="fa fa-user-cog"></i>
            <span>HR Management</span>
        </a>
        <div id="empManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('employee.index')}}">
                    <i class="fa fa-user"></i>
                    Employee
                </a>
                <a class="collapse-item" href="{{route('departments.index')}}">
                    <i class="fa fa-building"></i>
                    Department
                </a>
                <a class="collapse-item" href="{{route('departments.index')}}">
                    Desigantions
                </a>
            </div>
        </div>
    </li>


    <!-- Individual Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#people" aria-expanded="true" aria-controls="people">
            <i class="fa fa-users"></i>
            <span>People</span>
        </a>
        <div id="people" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('individuals.index')}}">
                    <i class="fa fa-signal"></i>
                    Education Level
                </a>
                <a class="collapse-item" href="{{route('individuals.index')}}">
                    <i class="fa fa-users"></i>
                    Individuals
                </a>
                <a class="collapse-item" href="{{route('titles.index')}}">
                    <i class="fa fa-heading"></i>
                    Position Titles
                </a>
                <a class="collapse-item" href="{{route('positions.index')}}">
                    <i class="fa fa-briefcase"></i>
                    Positions
                </a>
                <a class="collapse-item" href="{{route('groups.index')}}">
                    <i class="fa fa-user-tag"></i>
                    Groups
                </a>
            </div>
        </div>
    </li>


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


    <!-- Store Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#storMan" aria-expanded="true" aria-controls="storMan">
            <i class="fa fa-store"></i>
            <span>Store</span>
        </a>
        <div id="storMan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('itemCategories.index')}}">
                    <i class="fa fa-list-alt"></i>
                    Item Categories
                </a>
                <a class="collapse-item" href="{{route('itemUnits.index')}}">
                    <i class="fab fa-untappd"></i>
                    Item Units
                </a>
                <a class="collapse-item" href="{{route('items.index')}}">
                    <i class="fab fa-product-hunt"></i>
                    Items
                </a>
                <a class="collapse-item" href="{{route('itemReceived.index')}}">
                    <i class="fa fa-download"></i>
                    Received Items
                </a>
                <a class="collapse-item" href="{{route('itemIssued.index')}}">
                    <i class="fa fa-upload"></i>
                    Issued Items
                </a>
            </div>
        </div>
    </li>


    <!-- Location Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#locManage" aria-expanded="true" aria-controls="locManage">
            <i class="fa fa-map-marker"></i>
            <span>Location</span>
        </a>
        <div id="locManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('countries.index')}}">
                    <i class="fa fa-flag"></i>
                    Countries
                </a>
                <a class="collapse-item" href="{{route('cities.index')}}">
                    <i class="fa fa-city"></i>
                    Regions/Cities
                </a>
                <a class="collapse-item" href="{{route('districts.index')}}">
                    <i class="fa fa-building"></i>
                    Districts
                </a>
                <a class="collapse-item" href="{{route('wards.index')}}">
                    <i class="fa fa-street-view"></i>
                    Wards
                </a>
                <a class="collapse-item" href="{{route('streets.index')}}">
                    <i class="fa fa-compass"></i>
                    Streets/Villages
                </a>
            </div>
        </div>
    </li>


    <!-- Events Management -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#eventManage" aria-expanded="true" aria-controls="eventManage">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
        </a>
        <div id="eventManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                @can('eventCategory-read')
                    <a class="collapse-item" href="{{route('eventCategories.index')}}">
                        <i class="fa fa-list-alt"></i>
                        Event Categories
                    </a>
                @endcan
                @can('event-read')
                    <a class="collapse-item" href="{{route('events.index')}}">
                        <i class="fa fa-calendar"></i>
                        Events
                    </a>
                @endcan

                @can('genderSeries-read')
                    <a class="collapse-item" href="{{route('genderSeries.index')}}">
                        <i class="fa fa-street-view"></i>
                        Gender Series (GDSS)
                    </a>
                @endcan

                @can('participantRole-read')
                    <a class="collapse-item" href="{{route('participantRoles.index')}}">
                        <i class="fa fa-user-circle"></i>
                        Participant Roles
                    </a>
                @endcan

                @can('genderSeriesParticipant-read')
                    <a class="collapse-item" href="{{route('genderSeriesParticipants.index')}}">
                        <i class="fa fa-user-circle"></i>
                        GDSS Participants
                    </a>
                @endcan

                @can('participant-read')
                    <a class="collapse-item" href="{{route('participants.index')}}">
                        <i class="fa fa-user-circle"></i>
                        Participants
                    </a>
                @endcan
            </div>
        </div>
    </li>


    @role('superAdmin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userAdmin" aria-expanded="true" aria-controls="userAdmin">
                <i class="fa fa-lock"></i>
                <span>Users</span>
            </a>
            <div id="userAdmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    <a class="collapse-item" href="{{route('admin.index')}}">
                        <i class="fa fa-user-shield"></i>
                        Administrators
                    </a>
                    <a class="collapse-item" href="{{route('users.index')}}">
                        <i class="fa fa-user-lock"></i>
                        Users
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rolePermission" aria-expanded="true" aria-controls="rolePermission">
                <i class="fa fa-lock"></i>
                <span>Roles & Permissions</span>
            </a>
            <div id="rolePermission" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    <a class="collapse-item" href="{{route('roles.index')}}">Roles</a>
                    <a class="collapse-item" href="{{route('permissions.index')}}">Permissions</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting" aria-expanded="true" aria-controls="setting">
                <i class="fa fa-cog"></i>
                <span>Settings</span>
            </a>
            <div id="setting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    <a class="collapse-item" href="{{route('activityLogs.index')}}">Activity Logs</a>
                </div>
            </div>
        </li>
    @endrole




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
