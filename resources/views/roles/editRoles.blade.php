@extends('layout.mainLayout')

@section('title','Kasir | Edit Role');

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Edit Role
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/role">Data Role</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Edit role</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<?php foreach ($role as $data) { ?>
<div class="row">
    <div class="col-md-12">
        <form action="/role/{{ $data->role_id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit role</h3>
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-sm btn-alt-primary">
                            Reset
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-sm-3 py-md-5">
                        <div class="col-sm-10 col-md-8">
                            <div class="form-group">
                                <label for="block-form1-id">Id barang</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-id" name="id" value="{{ $data->role_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="block-form1-name">Nama barang</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="{{ $data->role_name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>
@endsection