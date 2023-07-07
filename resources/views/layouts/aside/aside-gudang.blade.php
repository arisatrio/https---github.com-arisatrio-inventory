<li class="nav-item">
    <a href="#" class="nav-link {{ request()->is('gudang/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-database"></i>
        <p>
            Gudang
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{ request()->is('gudang/*') ? 'd-block' : '' }}">
        <li class="nav-item">
            <a href="{{ route('gudang.produk.index') }}" class="nav-link {{ Route::is('gudang.produk.index') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Produk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('gudang.tipe-produk.index') }}" class="nav-link {{ Route::is('gudang.tipe-produk.index') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipe Produk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('gudang.stok-produk.index') }}"
                class="nav-link {{ Route::is('gudang.stok-produk.index') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Barang</p>
            </a>
        </li>
    </ul>
</li>
