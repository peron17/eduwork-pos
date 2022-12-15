<a href="{{ route($route . '.edit', $model->id) }}" class="btn btn-xs btn-primary btn-edit">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route($route . '.destroy', $model->id) }}" class="btn btn-xs btn-danger btn-delete">
    <i class="fa fa-trash"></i>
</a>

@push('css')
<style>
.btn-xs {
    padding: 2px 6px;
    font-size: 12px;
    width: 28px;
    height: 24px;
}
</style>
@endpush