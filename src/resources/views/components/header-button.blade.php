@props(['modal', 'href', 'icon', 'title'])

<a href="{{ $href }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm {{ $modal ? 'btn-modal' : '' }}">
    <i class="fas {{ $icon }} fa-sm text-white-50"></i> {{ $title }}
</a>