@extends('layout.mainLayout')

@section('title','Kasir | Edit User');

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Edit User
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/user">Data user</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Edit data</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<?php foreach ($user as $data) { ?>
<div class="row">
    <div class="col-md-12">
        <form action="/user/{{ $data->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit user</h3>
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
                                <label for="block-form1-name">Nama user</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="{{ $data->name }}">
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-email">Email</label>
                                        <input type="email" class="form-control form-control-alt" id="block-form1-email" name="email" value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-phone">No telepon</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-phone" name="phone" value="{{ $data->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-level">Level</label>
                                <select class="form-control form-control-alt" id="block-form1-level" name="level" required>
                                    <option value="{{ $idSelected }}" selected>{{ ucwords($nameSelected) }}</option>
                                    @foreach ($arrLvlNotSelected as $data)
                                        <option value="{{ $data->role_id }}">{{ ucwords($data->role_name) }}</option>
                                    @endforeach
                                </select> 
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