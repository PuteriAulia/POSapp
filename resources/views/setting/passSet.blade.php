@extends('layout.mainLayout')

@section('title','Kasir | Ubah Password')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Pengaturan Password
        </h1>
    </div>
</div>
@endsection

@section('content')
<!-- Alert -->
@if (Session::has('status'))
<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- END Alert -->

<div class="row">
    <div class="col-md-12">
        <form action="/pengaturan/password" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Ubah data password</h3>
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
                            <input type="hidden" class="form-control form-control-alt" id="id" name="id" value="{{ $userId }}">

                            <div class="form-group">
                                <label for="block-form1-password">Password</label>
                                <input type="password" class="form-control form-control-alt" id="block-form1-password" name="password" placeholder="Masukkan password baru...">
                            </div>

                            <div class="form-group">
                                <label for="block-form1-confPass">Konfirmasi password</label>
                                <input type="password" class="form-control form-control-alt" id="block-form1-confPass" name="confPass" placeholder="Masukkan konfirmasi password baru...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection