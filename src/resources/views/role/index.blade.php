@extends('layouts.sbadmin.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Role</h1>
</div>

<div class="row">
    <!-- Card -->
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                <a href="{{ route('role.store') }}" class="btn btn-sm btn-primary btn-modal" title="Tambah Role">
                    <span class="fa fa-plus"></span> Tambah Role
                </a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
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
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div id="permission"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-cancel" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-modal-submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function () {
    
    var datatable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('role.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

// load permission
$('body').on('click', '.btn-modal', function(e) {
    if ($(this).hasClass('btn-edit')) {
        var data = $(this).data('model');
        var url = "/api/role/permission/" + data.id;
    } else {
        var url = "/api/role/permission";
    }
    
    $.ajax({
        url: url,
        method: 'get',
        success: function(data) {
            var permissions = '';
            $.each(JSON.parse(data), function (key, value) {
                permissions += '<div class="form-check">'
                                +'<input type="checkbox" class="form-check-input" id="check-'+ key +'" name="permission[]" value="'+ key +'"' + (value.checked ? ' checked' : '') + '>'
                                +'<label class="form-check-label" for="check-'+ key +'">' + value.name + '</label>'
                            +'</div>'
            });
            $('#permission').html(permissions);
        },
        error: function(err) {
            Swal.fire(
                'Error',
                err.responseJSON.errors,
                'error'
            )
        }
    })
});

</script>
@endpush