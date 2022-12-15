@extends('layouts.sbadmin.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Unit</h1>
</div>

<div class="row">
    <!-- Card -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                <a href="{{ route('unit.create') }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-plus"></span> Tambah Data
                </a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('unit.index') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
</script>
@endpush