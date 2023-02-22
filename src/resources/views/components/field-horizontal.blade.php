<div class="mb-3 row">
    <label for="{{ $label }}" class="col-sm-3 col-form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-{{ $size }}">
        {{ $slot }}
    </div>
</div>