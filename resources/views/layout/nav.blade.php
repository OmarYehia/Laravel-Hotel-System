<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('admin-lte-resources/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('admin-lte-resources/dist/img/AdminLTELogo.png') }}" alt="Hotel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Hotel</b> Transylvania</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if(Auth::guard('client')->check())
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::guard('client')->user()->avatar_image)
                <img src="{{Auth::guard('client')->user()->avatar_image}}" class="img-circle elevation-2" alt="User Image">
                @elseif(Auth::guard('client')->user()->gender === "male")
                <img src="{{ asset('img/male-default.png') }}" class="img-circle elevation-2" alt="User Image">
                @elseif(Auth::guard('client')->user()->gender === "female")
                <img src="{{ asset('img/female-default.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::guard('client')->user()->name}}</a>

            </div>
            <div class="info ml-auto">
                @if(Auth::guard('client')->check())
                <a href="{{ route ('logout.client') }}" class="d-block">Logout</a>
                @elseif(Auth::guard('user')->check())

                <a href="{{route ('logout') }}" class="d-block">Logout</a>
                @endif
            </div>
        </div>
        @endif

        @if(Auth::guard('user')->check())
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::guard('user')->user()->avatar_image)
                <img src="{{Auth::guard('user')->user()->avatar_image}}" class="img-circle elevation-2" alt="User Image">
                @else(Auth::guard('client')->user()->gender === "male")
                <img src="{{ asset('img/male-default.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::guard('user')->user()->name}}</a>

            </div>
            <div class="info ml-auto">
                <a href="{{route ('logout') }}" class="d-block">Logout</a>
            </div>
        </div>
        @endif

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::guard('user')->check())
                @if(Auth::guard('user')->user()->can('manage managers'))
                <li class="nav-item mb-2">
                    <a href="/" class="nav-link"><i class="nav-icon far fa-newspaper"></i> Manage managers</a>
                </li>

                @endif
                @if(Auth::guard('user')->user()->can('manage receptionists'))
                <li class="nav-item mb-2">
                    <a href="/" class="nav-link"><i class="nav-icon fas fa-glasses"></i> Manage receptionists</a>
                </li>
                @endif

                @if(Auth::guard('user')->user()->can('manage floors'))
                <li class="nav-item mb-2">
                    <a href="{{ route('manage.floors') }}" class="nav-link"><i class="nav-icon far fa-building"></i> Manage floors</a>
                </li>
                @endif

                @if(Auth::guard('user')->user()->can('manage rooms'))
                <li class="nav-item mb-2">
                    <a href="{{ route('manage.rooms') }}" class="nav-link"><i class="nav-icon fas fa-person-booth"></i> Manage rooms</a>
                </li>
                @endif

                @if(Auth::guard('user')->user()->can('approve clients'))
                <li class="nav-item mb-2">
                    <a href="/" class="nav-link"><i class="nav-icon fas fa-user-friends"></i> Approve clients</a>
                </li>
                @endif

                @if(Auth::guard('user')->user()->can('manage managers') or Auth::guard('user')->user()->can('manage receptionists'))
                <li class="nav-item mb-2">
                    <a href="/admin/register" class="nav-link"><i class="nav-icon fas fa-edit"></i> Register Staff
                        Members</a>
                </li>
                @endif
                @elseif(Auth::guard('client')->check())
                <!-- Show Client nav -->
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>