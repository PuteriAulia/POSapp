@extends('layout/mainLayout')

@section('title','Kasir | Tambah Barang Retur')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Tambah Barang Retur
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Barang retur</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/barangRetur">Data barang retur</a>
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
        <form action="/barangRetur" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tambah barang retur</h3>
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
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="block-form1-id">Id barang retur</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-id" name="id" value="{{ $productOutId }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <label for="block-form1-product">Barang</label>
                                        <select class="form-control form-control-alt" id="block-form1-product" name="product" required>
                                            <?php foreach ($products as $product) {
                                            ?>
                                                <option value="<?= $product->product_id ?>"><?= $product->product_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-qty">Jumlah</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-qty" name="qty" placeholder="Masukkan jumlah barang retur.." required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-date">Tanggal</label>
                                <input type="date" class="form-control form-control-alt" id="block-form1-date" name="date" placeholder="Masukkan tanggal barang retur.." required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-info">Keterangan</label>
                                <textarea name="info" id="block-form1-info" class="form-control form-control-alt" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection