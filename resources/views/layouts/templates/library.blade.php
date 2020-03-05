@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('library')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

    </ul>
</nav>
<!-- end sidebar -->
@include('layouts.includes.footer')


