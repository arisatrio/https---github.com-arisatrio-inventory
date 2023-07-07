<li class="nav-item">
    <a href="#" class="nav-link {{ request()->is('po/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            Purchase Order
            <i class="right fas fa-angle-left"></i>
        </p>

        @php
            $countPo = \App\Models\Order::when(Auth::user()->hasRole('Admin Logistik'), function ($q) {
                    $q->where('status', 'INPUT');
                })
                ->when(Auth::user()->hasRole('Admin Gudang'), function ($q) {
                    $q->where('status', 'DITERIMA ADMIN GUDANG');
                })
                ->when(Auth::user()->hasRole('Customer'), function ($q) {
                    $q->where('user_id', Auth::user()->id);
                })
                ->where('is_selesai', 0)
                ->whereHas('orderProducts')
                ->count();
        @endphp
        @if ($countPo > 0)
            <span class="badge badge-danger ml-2">{{ $countPo }}</span>
        @endif
    </a>
    <ul class="nav nav-treeview {{ request()->is('po/*') ? 'd-block' : '' }}">
        @hasrole('Admin|Customer')
        <li class="nav-item">
            <a href="{{ route('po.order.create') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Buat PO</p>
            </a>
        </li>
        @endhasrole
        <li class="nav-item">
            <a href="{{ route('po.order.index') }}"
                class="nav-link {{ request()->is('po/order*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List PO</p>
            </a>
        </li>
    </ul>
</li>
