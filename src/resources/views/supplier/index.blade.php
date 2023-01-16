@extends('layouts.sbadmin.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
</div>

<div class="row">
    <!-- Card -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                <a href="{{ route('supplier.store') }}" class="btn btn-sm btn-primary btn-modal" title="Tambah Supplier">
                    <span class="fa fa-plus"></span> Tambah Data
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
                                <th>Nomor Telepon</th>
                                <th>Email</th>
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
                    <div class="form-group mb-3">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" id="phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
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
        ajax: "{{ route('supplier.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

});
    
$('body').on('click', '.btn-modal', function(e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        success: function(data){
            $.each(data, function(key, value){
                if ($('#'+key).is('input:text')) {
                    $('#'+key).val(value);
                }
            });
        },
        error: function(err){
            var errors = e.responseJSON.errors;
            console.log(errors);
        }
    });
});

</script>
@endpush