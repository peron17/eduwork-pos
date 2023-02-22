@props(['route', 'edit'])

<div class="card shadow mb-4">
    <form action="{{ $route }}" method="post">
        @csrf
        @if ($edit)
            <input type="hidden" name="_method" value="put">
        @endif

        <div class="card-body pt-4">
            {{ $slot }}
       </div>
       <div class="card-footer text-right">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> {{ __('button.create') }}
            </button>
       </div>
    </form>
</div>