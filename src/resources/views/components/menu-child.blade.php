@props(['active', 'route', 'title'])

@php
    $class = $active ? 'active' : '';
@endphp
<a class="collapse-item {{ $class }}" href="{{ $route }}">{{ $title }}</a>