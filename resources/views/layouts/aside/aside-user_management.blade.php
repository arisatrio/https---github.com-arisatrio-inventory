<li class="nav-item">
    <a href="#" class="nav-link  {{ request()->is('user-management/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-cog"></i>
        <p>
            User Management
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{ request()->is('user-management/*') ? 'd-block' : '' }}">
        <li class="nav-item">
            <a href="{{ route('user-management.role.index') }}" class="nav-link {{ Route::is('user-management.role.index') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user-management.department.index') }}"
                class="nav-link {{ Route::is('user-management.department.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user-management.users.index') }}"
                class="nav-link {{ Route::is('user-management.users.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
            </a>
        </li>
    </ul>
</li>
