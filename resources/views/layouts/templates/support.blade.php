@include('layouts.partials.header')
@include('layouts.partials.topBar')


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

    @include('layouts.partials.toggle')


    <!-- Page Title -->

    <div class="pagetitle-icon">
        <i class="fa fa-headset"></i>
    </div>
    <div class="pagetitle-title">
        <h2>Support Assistant</h2>
    </div>

    <!-- end pagetitle-left-title -->


@include('layouts.partials.footer')
