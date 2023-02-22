@php
    $small = isset($sm) ? "col-sm-$sm" : "";
    $middle = isset($md) ? "col-md-$md" : "col";
    $large = isset($lg) ? "col-lg-$lg" : "";
@endphp


<div class="row justify-content-center">
    <div class="{{ $small }} {{ $middle }} {{ $large }}">
        {{ $slot }}
    </div>
</div>