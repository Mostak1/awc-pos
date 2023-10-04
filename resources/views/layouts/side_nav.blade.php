<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav sidebar text-success-emphasis shadow" id="sidenavAccordion">
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
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
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
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>Sub
                            Category
                        </a>
                        <a href="{{ url('tab') }}" class="nav-link" rel="noopener noreferrer">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>Table
                            Set
                        </a>
                        <a href="{{ url('offorder') }}" class="nav-link" rel="noopener noreferrer">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>Order
                            Table
                        </a>
                        <a href="{{ url('offorderdetails') }}" class="nav-link" rel="noopener noreferrer">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-mendeley fa-beat-fade"></i></div>Order
                            Details Table
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                {{-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                            aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> --}}

                <a class="nav-link" href="{{ url('menus') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                    Menu
                </a>
                <a class="nav-link" href="{{ url('order') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-martini-glass-citrus"></i></div>
                    Order
                </a>
                <a class="nav-link" href="{{ url('material') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Material
                </a>
                <a class="nav-link" href="{{ url('supplier') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                    Supplier
                </a>
                <a class="nav-link" href="{{ url('purchase') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                    Purchase
                </a>

                <div class="sb-sidenav-menu-heading wc">Addons</div>
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




            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>

            @if (Auth::check())
                {{ Auth::user()->name }}
            @endif
        </div>
        <div class="text-muted">Copyright &copy; Test BD 2023</div>
    </nav>
</div>
