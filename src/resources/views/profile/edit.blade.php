@extends('layouts.sbadmin.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
</div>

<div class="row">
    <!-- Card -->
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body" style="padding-top: 2rem;">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama">
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection