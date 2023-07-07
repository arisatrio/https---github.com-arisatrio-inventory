<aside class="main-sidebar sidebar-light-warning elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link text-light text-center bg-warning">
        <span class="brand-text font-weight-light"><b>Sistem Inventory</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar bg-white">
        <div class="row">
            <div class="col-md-12">
                <div class="image text-center mt-3">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/user/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                            width="50px" alt="User Image">
                    @else
                        <img src="{{ asset('asset_template/dist/img/avatar.png') }}" class="img-circle elevation-2"
                            width="50px" alt="User Image">
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="info text-center text-uppercase text-bold">
                    <a href="{{ route('profile.edit') }}" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="info text-center font-weight-light font-italic">
                    <p> {{ auth()->user()->roles->pluck('name')->implode(', ') }} </p>
                </div>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @include('layouts.aside.aside-laporan')
                @include('layouts.aside.aside-po')
                @hasrole('Admin|Admin Gudang')
                @include('layouts.aside.aside-gudang')
                @endhasrole
                @hasrole('Admin')
                @include('layouts.aside.aside-user_management')
                @endhasrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
