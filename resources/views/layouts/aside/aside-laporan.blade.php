<li class="nav-item">
    <a href="#" class="nav-link  {{ request()->is('laporan/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{ request()->is('laporan/*') ? 'd-block' : '' }}">
        <li class="nav-item">
            <a href="{{ route('laporan.order') }}" class="nav-link {{ Route::is('laporan.order') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan PO</p>
            </a>
        </li>
        @unlessrole('Customer')
        <li class="nav-item">
            <a href="{{ route('laporan.stok') }}"
                class="nav-link {{ Route::is('laporan.stok') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Stok</p>
            </a>
        </li>
        @endunlessrole
    </ul>
</li>
