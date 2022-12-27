@extends('layouts.sbadmin.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Metode Pembayaran</h1>
</div>

<div class="row">
    <!-- Card -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                <a href="{{ route('payment-method.store') }}" class="btn btn-sm btn-primary btn-modal" title="Tambah Metode Pembayaran">
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
                                <th>No. Rekening</th>
                                <th>Rekening a.n</th>
                                <th>Status</th>
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
                        <label for="account_number">No. Rekening</label>
                        <input type="text" name="account_number" class="form-control" id="account_number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="account_name">Rekening a.n</label>
                        <input type="text" name="account_name" class="form-control" id="account_name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="is_active">Apakah Aktif?</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
        ajax: "{{ route('payment-method.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'account_number', name: 'account_number'},
            {data: 'account_name', name: 'account_name'},
            {data: 'is_active', name: 'is_active', searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

});
</script>
@endpush