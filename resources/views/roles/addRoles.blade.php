@extends('layout/mainLayout')

@section('title','Kasir | Tambah role')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Tambah Role
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/role">Data role</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Tambah role</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="/role" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tambah role</h3>
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
                                <label for="block-form1-id">Id role</label>
                                <input type="text" class="form-control form-control-alt" id="id" name="id" value="{{ $roleId }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="block-form1-name">Nama role</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" placeholder="Masukkan nama role.." required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection