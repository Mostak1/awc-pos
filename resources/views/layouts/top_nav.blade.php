<nav class="sb-topnav  bg-body navbar navbar-expand navbar  text-dark">
    @php
        $user = Auth::user();
    @endphp
    <!-- Sidebar Toggle-->
    <button class="btn clr btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <div class="mx-auto clr fs-4">Dashboard <br>
      
    </div>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{--  --}} 
                @if (Auth::check())
                    {{ Auth::user()->name }}
                @else
                <i class="fas fa-user fa-fw"></i>
                @endif
                
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @if (Auth::check())
                    {{-- Authentication --}}
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    @include('components.logout')
                @else
                    <a class="dropdown-item nav-link" href="login">Login</a>
                @endif


            </ul>
        </li>
    </ul>
</nav>
