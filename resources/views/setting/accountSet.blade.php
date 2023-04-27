@extends('layout.mainLayout')

@section('title','Kasir | Ubah Data Akun')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Pengaturan Akun
        </h1>
    </div>
</div>
@endsection

@section('content')
@foreach ($accountData as $data)
<div class="row">
    <div class="col-md-12">
        <form action="/pengaturan/akun" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Ubah data akun</h3>
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
                            <input type="hidden" class="form-control form-control-alt" id="id" name="id" value="{{ $data->id }}">

                            <div class="form-group">
                                <label for="block-form1-name">Nama user</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="{{ $data->name }}">
                            </div>

                            <div class="form-group">
                                <label for="block-form1-email">Alamat email</label>
                                <input type="email" class="form-control form-control-alt" id="block-form1-email" name="email" value="{{ $data->email }}">
                            </div>

                            <div class="form-group">
                                <label for="block-form1-phone">Nomr telepon</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-phone" name="phone" value="{{ $data->phone }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection