<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav sidebar text-success-emphasis   bg-white" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-2 side-nav">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3 fs-1 text-warning" target="" href="{{ url('/') }}"><img width="150px"
                        src="{{ asset(config('app.logo_path')) }}" alt="Logo">
                </a>
                <div class="sb-sidenav-menu-heading wc">Core</div>
                <a class="nav-link" href="{{ url('/') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading wc">Interface</div>
                
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Manage Tables
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested  nav">
                            <a href="{{ url('category') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>
                                Category
                            </a>
                            <a href="{{ url('subcategory') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>
                                Sub
                                Category
                            </a>
                            <a href="{{ url('tab') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>
                                Table
                                Set
                            </a>

                        </nav>
                    </div>

                <a class="nav-link" href="{{ url('menus') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                    Food Menu
                </a>
                <a class="nav-link" href="{{ url('card') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                   Customer Prepaid Card
                </a>
                <a class="nav-link" href="{{ url('customer') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                   Customer Card
                </a>
                <a class="nav-link" href="{{ url('order') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                    Place Order
                </a>
           
                    <a class="nav-link" href="{{ url('material') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Food Material
                    </a>
                    <a class="nav-link" href="{{ url('supplier') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                        Supplier
                    </a>
                    <a class="nav-link" href="{{ url('purchase') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                        Purchase Material
                    </a>

                    <div class="sb-sidenav-menu-heading wc">Report</div>
                    {{-- @dd($roles) --}}

                    <a class="nav-link" href="{{ url('user') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Users
                    </a>



                    <a class="nav-link" href="{{ url('role') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Role Set
                    </a>
                    <a class="nav-link" href="{{ url('setting') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Settings
                    </a>



                    {{-- report --}}
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Report Manage
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested  nav">

                            <a href="{{ url('offorder') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>Order
                                History Report
                            </a>
                            <a href="{{ url('offorderlog') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>Order Log
                                History Report
                            </a>
                            <a href="{{ url('menulog') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>Menu Log
                                History Report
                            </a>
                            <a href="{{ url('offorderdaily') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                Daily Sale Report of Order
                            </a>
                            <a href="{{ url('offorderdetails') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>Order
                                Details Table
                            </a>
                            <a href="{{ url('dailyreport') }}" class="nav-link" rel="noopener noreferrer">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-flag"></i></div>
                                Daily Sale Report Order Details
                            </a>

                        </nav>
                    </div>
                
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>

            @if (Auth::check())
                {{ Auth::user()->name }}
            @endif
        </div>
        <div class="text-muted">Copyright &copy; Green Kitchen 2023</div>
    </nav>
</div>
