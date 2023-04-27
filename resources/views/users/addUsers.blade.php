@extends('layout/mainLayout')

@section('title','Kasir | Tambah user')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Tambah User
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/user">Data user</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Tambah data</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="/user" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tambah user</h3>
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
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                            <div class="form-group">
                                <label for="block-form1-name">Nama user</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" placeholder="Masukkan nama user.." required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-email">Email</label>
                                        <input type="email" class="form-control form-control-alt" id="block-form1-email" name="email" placeholder="Masukkan email user.." required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-phone">No telepon</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-phone" name="phone" placeholder="Masukkan nomor telepon user.." required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-username">Username</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="username" placeholder="Masukkan username.." required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-password">Password</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-password" name="password" placeholder="Masukkan password.." required>
                                    </div>
                                </div>
                            </div>                        

                            <div class="form-group">
                                <label for="block-form1-level">Level</label>
                                <select class="form-control form-control-alt" id="example-select" name="level" required>
                                    @foreach ($roles as $data)
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
@endsection