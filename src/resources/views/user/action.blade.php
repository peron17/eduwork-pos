<a href="{{ route($route . '.edit', $model->id) }}" class="btn btn-xs btn-primary" title="Edit #{{ $model->id }}">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route($route . '.destroy', $model->id) }}" class="btn btn-xs btn-danger btn-delete" title="Delete #{{ $model->id }}">
    <i class="fa fa-trash"></i>
</a>