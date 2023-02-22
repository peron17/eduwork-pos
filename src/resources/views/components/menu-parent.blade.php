@props(['routes', 'id', 'title', 'icon'])

@php
    $itemStatus = "nav-link collapsed";
    $ariaStatus = "false";
    $collapseStatus = "collapse";
    
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            $itemStatus = "nav-link";
            $ariaStatus = "true";
            $collapseStatus = "collapse show";
        }
    }
@endphp

<li class="nav-item">
    <a class="{{ $itemStatus }}" href="#" data-toggle="collapse" data-target="#{{ $id }}" aria-expanded="{{ $ariaStatus }}" aria-controls="{{ $id }}">
        <i class="fas fa-fw {{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="{{ $id }}" class="{{ $collapseStatus }}" aria-labelledby="heading{{ $id }}" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            {{ $slot }}
        </div>
    </div>
</li>