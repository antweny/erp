<ul class="navbar-nav sidebar bg-black accordion text-white" id="accordionSidebar" >
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @role('superAdmin')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#empManage" aria-expanded="true" aria-controls="empManage">
            <i class="fa fa-user-cog"></i>
            <span>HR Management</span>
        </a>
        <div id="empManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" py-2 collapse-inner ">
                <a class="collapse-item" href="{{route('departments.index')}}">
                    <i class="fa fa-building"></i>
                    Department
                </a>
                <a class="collapse-item" href="{{route('designations.index')}}">
                    <i class="fa fa-map"></i>
                    Designations
                </a>
                @if(checkPermission('employmentType-read'))
                    <a class="collapse-item" href="{{route('employmentTypes.index')}}">
                        <i class="fa fa-map"></i>
                        Employment Types
                    </a>
                @endif
                @if(checkPermission('employee-read'))
                    <a class="collapse-item" href="{{route('employee.index')}}">
                        <i class="fa fa-user"></i>
                        Employee
                    </a>
                @endif
                @if(checkPermission('employee-read'))
                    <a class="collapse-item" href="{{route('employmentHistories.index')}}">
                        <i class="fa fa-map"></i>
                        Employment Histories
                    </a>
                @endif
            </div>
        </div>
    </li>
    @endrole


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


    @hasanyrole('Store Manager|superAdmin')
        <!-- Store Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#storMan" aria-expanded="true" aria-controls="storMan">
                <i class="fa fa-store"></i>
                <span>Store</span>
            </a>
            <div id="storMan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    @can('itemCategory-read')
                        <a class="collapse-item" href="{{route('itemCategories.index')}}">
                            <i class="fa fa-list-alt"></i>
                            Item Categories
                        </a>
                    @endcan
                    @can('itemUnit-read')
                        <a class="collapse-item" href="{{route('itemUnits.index')}}">
                            <i class="fab fa-untappd"></i>
                            Item Units
                        </a>
                    @endcan
                    @can('item-read')
                        <a class="collapse-item" href="{{route('items.index')}}">
                            <i class="fab fa-product-hunt"></i>
                            Items
                        </a>
                    @endcan
                    @can('itemReceived-read')
                        <a class="collapse-item" href="{{route('itemReceived.index')}}">
                            <i class="fa fa-download"></i>
                            Received Items
                        </a>
                    @endcan
                    @can('itemRequest-read')
                        <a class="collapse-item" href="{{route('itemRequests.index')}}">
                            <i class="fab fa-invision"></i>
                            Item Requests
                        </a>
                    @endcan
                    @can('itemRequest-read')
                        <a class="collapse-item" href="{{route('itemRequests.issued')}}">
                            <i class="fa fa-upload"></i>
                            Item Issued
                        </a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @role('data-entry')
        <!-- Location Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#locManage" aria-expanded="true" aria-controls="locManage">
                <i class="fa fa-map-marker"></i>
                <span>Location</span>
            </a>
            <div id="locManage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" py-2 collapse-inner ">
                    @can('country-read')
                        <a class="collapse-item" href="{{route('countries.index')}}">
                            <i class="fa fa-flag"></i>
                            Countries
                        </a>
                    @endcan
                    @can('city-read')
                        <a class="collapse-item" href="{{route('cities.index')}}">
                            <i class="fa fa-city"></i>
                            Regions/Cities
                        </a>
                    @endcan
                    @can('district-read')
                        <a class="collapse-item" href="{{route('districts.index')}}">
                            <i class="fa fa-building"></i>
                            Districts
                        </a>
                    @endcan
                    @can('ward-read')
                        <a class="collapse-item" href="{{route('wards.index')}}">
                            <i class="fa fa-street-view"></i>
                            Wards
                        </a>
                    @endcan
                    @can('street-read')
                        <a class="collapse-item" href="{{route('streets.index')}}">
                            <i class="fa fa-compass"></i>
                            Streets/Villages
                        </a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @role('data-entry')
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
    @endcan


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
