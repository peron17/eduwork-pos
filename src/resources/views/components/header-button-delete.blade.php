@props(['href', 'icon', 'title', 'redirect'])

<a href="{{ $href }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm btn-delete directed" data-redirect="{{ $redirect }}">
    <i class="fas {{ $icon }} fa-sm text-white-50"></i> {{ $title }}
</a>