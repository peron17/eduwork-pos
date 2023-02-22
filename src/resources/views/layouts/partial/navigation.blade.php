<?php 
$setting = \App\Helpers\Menu::MENU['setting'];
$stock = \App\Helpers\Menu::MENU['stock'];
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Peron POS') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-menu :active="request()->routeIs('dashboard.index')">
        <x-nav-link :route="route('dashboard.index')" icon="fa-tachometer-alt" :title="__('navigation.dashboard')" />
    </x-menu>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Penjualan -->
    <x-menu :active="request()->routeIs('sales.index')">
        <x-nav-link :route="route('sales.index')" icon="fa-shopping-bag" :title="__('navigation.sales')" />
    </x-menu>

    <x-menu :active="request()->routeIs('purchase.index')">
        <x-nav-link :route="route('purchase.index')" icon="fa-folder" :title="__('navigation.purchase')" />
    </x-menu>

    <x-menu :active="request()->routeIs('product.index')">
        <x-nav-link :route="route('product.index')" icon="fa-cube" :title="__('navigation.product')" />
    </x-menu>

    <x-menu-parent :routes="$stock" id="collapseOne" :title="__('navigation.stock')" icon="fa-cubes">
        <x-menu-child :active="request()->routeIs('stock.*')" :route="route('stock.index')" :title="__('navigation.stock')" />
        <x-menu-child :active="request()->routeIs('adjustment.*')" :route="route('adjustment.index')" :title="__('navigation.adjustment_stock')" />
    </x-menu-parent>

    <!-- Nav Item - Supplier -->
    <x-menu :active="request()->routeIs('supplier.index')">
        <x-nav-link :route="route('supplier.index')" icon="fa-truck" :title="__('navigation.supplier')" />
    </x-menu>

    <x-menu-parent :routes="$setting" id="collapseTwo" :title="__('navigation.setting')" icon="fa-cog">
        <x-menu-child :active="request()->routeIs('payment-method.*')" :route="route('payment-method.index')" :title="__('navigation.payment-method')" />
        <x-menu-child :active="request()->routeIs('unit.*')" :route="route('unit.index')" :title="__('navigation.unit')" />
        <x-menu-child :active="request()->routeIs('user.*')" :route="route('user.index')" :title="__('navigation.user')" />
    </x-menu-parent>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('sb-admin-2/img/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2">
            {{ __('general.contact_me') }}
        </p>
        <a class="btn btn-success btn-sm" href="mailto:tommypriambodo@gmail.com">{{ __('button.contact us') }}</a>
    </div>

</ul>