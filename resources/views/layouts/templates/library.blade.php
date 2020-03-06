@include('layouts.partials.header')
@include('layouts.partials.topBar')


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

        @can('author-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('authors.index')}}">
                    <i class="fa fa-pen"></i>
                    <span>Authors</span>
                </a>
            </li>
        @endcan

        @can('publisher-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('publishers.index')}}">
                    <i class="fa fa-print"></i>
                    <span>Publisher</span>
                </a>
            </li>
        @endcan

        @can('publicationCategory-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('publicationCategories.index')}}">
                    <i class="fa fa-th-large"></i>
                    <span>Publication Categories</span>
                </a>
            </li>
        @endcan

        @can('shelf-read')
            <li class="nav-item">
                <a class="nav-link" href="{{route('shelves.index')}}">
                    <i class="fa fa-cabinet-filing"></i>
                    <span>Library Shelves</span>
                </a>
            </li>
        @endcan

    </ul>
</nav>


    @include('layouts.partials.toggle')


        <!-- Page Title -->

        <div class="pagetitle-icon">
            <i class="fa fa-book-reader"></i>
        </div>
        <div class="pagetitle-title">
            <h2>Library Management</h2>
        </div>

        <!-- end pagetitle-left-title -->


    @include('layouts.partials.footer')



