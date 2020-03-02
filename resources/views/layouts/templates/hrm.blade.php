@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('hrm')}}">
                <i class="fa fa-home"></i>
                <span>HRM Home</span>
            </a>
        </li>

        @can('department-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('departments.index')}}">
                    <i class="fa fa-building"></i>
                    Department
                </a>
            </li>
        @endcan

        @can('designation-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('designations.index')}}">
                    <i class="fa fa-heading"></i>
                    Designations
                </a>
            </li>
        @endcan
        
        @can('jobType-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('jobTypes.index')}}">
                    <i class="fa fa-file-signature"></i>
                    Job Types
                </a>
            </li>
        @endcan

        @can('employee-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('employee.index')}}">
                    <i class="fa fa-user"></i>
                    Employee List
                </a>
            </li>
        @endcan

        @can('jobHistory-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('jobHistories.index')}}">
                    <i class="fa fa-map"></i>
                    Job Histories
                </a>
            </li>
        @endcan
    </ul>
</nav>
<!-- end sidebar -->
@include('layouts.includes.footer')


