@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('supports')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('ticketCategories.index')}}">
                    <i class="fa fa-vector-square"></i>
                    <span>Ticket Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('tickets.index')}}">
                    <i class="fa fa-ticket-alt"></i>
                    <span>Tickets</span>
                </a>
            </li>

    </ul>
</nav>
<!-- end sidebar -->
@include('layouts.includes.footer')


