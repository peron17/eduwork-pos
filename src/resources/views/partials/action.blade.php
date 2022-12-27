<a href="{{ route($route . '.update', $model->id) }}" class="btn btn-xs btn-primary btn-modal btn-edit" data-model="{{ $model }}" title="Edit Unit #{{ $model->id }}">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route($route . '.destroy', $model->id) }}" class="btn btn-xs btn-danger btn-delete" title="Delete Unit #{{ $model->id }}">
    <i class="fa fa-trash"></i>
</a>