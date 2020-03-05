@include('layouts.includes.header')
    <!-- Sidebar -->
    <nav id="sidebar">
        <ul class="nav" id="accordionSidebar" >
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('store')}}">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('itemCategory-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('itemCategories.index')}}">
                        <i class="fa fa-list-alt"></i>
                        <span>Item Categories</span>
                    </a>
                </li>
            @endcan
            @can('itemUnit-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('itemUnits.index')}}">
                        <i class="fab fa-untappd"></i>
                        <span>Item Units</span>
                    </a>
                </li>
            @endcan
            @can('item-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('items.index')}}">
                        <i class="fab fa-product-hunt"></i>
                        <span>Items List</span>
                    </a>
                </li>
            @endcan
            @can('itemReceived-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('itemReceived.index')}}">
                        <i class="fa fa-download"></i>
                        <span>Received Items</span>
                    </a>
                </li>
            @endcan
            @can('itemRequest-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('itemRequests.index')}}">
                        <i class="fab fa-invision"></i>
                        <span>Item Requests</span>
                    </a>
                </li>
            @endcan
            @can('itemRequest-read')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('itemRequests.issued')}}">
                        <i class="fa fa-upload"></i>
                        <span>Issued Item</span>
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
    <!-- end sidebar -->
@include('layouts.includes.footer')


