@extends('layout/mainLayout')

@section('title','Kasir | Tambah barang')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Tambah Barang
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Barang</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/barang">Data barang</a>
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
        <form action="/barang" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tambah barang</h3>
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
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-id">Id barang</label>
                                        <input type="text" class="form-control form-control-alt" id="id" name="id" value="{{ $productId }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-name">Nama barang</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" placeholder="Masukkan nama barang.." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-supplier">Supplier</label>
                                <select class="form-control form-control-alt" id="example-select" name="supplier" required>
                                    <?php foreach ($suppliers as $supplier) {
                                    ?>
                                        <option value="<?= $supplier->supplier_id ?>"><?= $supplier->supplier_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-purchase">Harga beli</label>
                                        <input type="number" class="form-control form-control-alt" id="block-form1-purchase" name="purchasePrice" placeholder="Masukkan harga beli.." required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-sell">Harga jual</label>
                                        <input type="number" class="form-control form-control-alt" id="block-form1-sell" name="sellPrice" placeholder="Masukkan harga jual.." required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection