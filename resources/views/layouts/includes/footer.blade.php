            <!-- Page Content -->
            <div id="content">
                <!-- Sidebar Toggle -->
                <nav class="navbar navbar-expand-lg">
                    <button type="button" id="sidebarCollapse" class="btn btn-danger text-white btn-sm">
                        <i class="fas fa-times"></i>
                    </button>
                </nav>

                <!-- Main Content Section -->
                <div class="mainContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

@include('layouts.partials.footer')
