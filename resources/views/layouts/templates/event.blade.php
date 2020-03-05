@include('layouts.includes.header')
<!-- Sidebar -->
<nav id="sidebar">
    <ul class="nav" id="accordionSidebar" >
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('event')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @can('eventCategory-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('eventCategories.index')}}">
                    <i class="fa fa-list-alt"></i>
                    Event Categories
                </a>
            </li>
        @endcan
        @can('event-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('events.index')}}">
                    <i class="fa fa-calendar"></i>
                    Events
                </a>
            </li>
        @endcan
        @can('genderSeries-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('genderSeries.index')}}">
                    <i class="fa fa-street-view"></i>
                    Gender Series (GDSS)
                </a>
            </li>
        @endcan
        @can('participantRole-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('participantRoles.index')}}">
                    <i class="fa fa-user-tag"></i>
                    Participant Roles
                </a>
            </li>
        @endcan
        @can('genderSeriesParticipant-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('genderSeriesParticipants.index')}}">
                    <i class="fa fa-user-check"></i>
                    GDSS Participants
                </a>
            </li>
        @endcan
        @can('participant-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('participants.index')}}">
                    <i class="fa fa-user-friends"></i>
                    Participants
                </a>
            </li>
        @endcan
    </ul>
</nav>
<!-- end sidebar -->
@include('layouts.includes.footer')


