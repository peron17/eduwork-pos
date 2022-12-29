@php
    $currentRoute = \Request::route()->getName();
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Penjualan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Transaksi Masuk</a>
                <a class="collapse-item" href="">Transaksi Keluar</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Produk</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Kategori</a>
                <a class="collapse-item" href="">Produk</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span></a>
    </li>

    @if (auth()->user()->can('manage-supplier'))
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-truck"></i>
            <span>Supplier</span></a>
    </li>
    @endif

    @php
        $pengaturan = [
            'unit.index',
            'payment-method.index',
            'user.index',
            'permission.index',
            'role.index',
        ];
    @endphp
    <li class="nav-item">
        <a class="nav-link <?= in_array($currentRoute, $pengaturan) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseSetting"
            aria-expanded="true" aria-controls="collapseSetting">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseSetting" class="collapse <?= in_array($currentRoute, $pengaturan) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (auth()->user()->can('manage-permission'))
                    <a href="{{ route('role.index') }}" class="collapse-item <?= $currentRoute == 'role.index' ? 'active' : '' ?>">Role</a>
                @endif
                @if (auth()->user()->can('manage-permission'))
                    <a href="{{ route('permission.index') }}" class="collapse-item <?= $currentRoute == 'permission.index' ? 'active' : '' ?>">Permission</a>
                @endif
                @if (auth()->user()->can('manage-user'))
                    <a class="collapse-item <?= $currentRoute == 'user.index' ? 'active' : '' ?>" href="{{ route('user.index') }}">User</a>
                @endif
                @if (auth()->user()->can('manage-payment-method'))
                    <a class="collapse-item <?= $currentRoute == 'payment-method.index' ? 'active' : '' ?>" href="{{ route('payment-method.index') }}">Metode Pembayaran</a>
                @endif
                @if (auth()->user()->can('manage-unit'))
                    <a class="collapse-item <?= $currentRoute == 'unit.index' ? 'active' : '' ?>" href="{{ route('unit.index') }}">Unit</a>
                @endif
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>