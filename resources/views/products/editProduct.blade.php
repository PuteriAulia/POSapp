@extends('layout.mainLayout')

@section('title','Kasir | Edit Barang');

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Edit Barang
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Barang</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/barang">Data barang</a>
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
<?php foreach ($product as $data) { ?>
<div class="row">
    <div class="col-md-12">
        <form action="/barang/{{ $data->product_id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit barang</h3>
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
                                        <input type="text" class="form-control form-control-alt" id="block-form1-id" name="id" value="{{ $data->product_id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-name">Nama barang</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="{{ $data->product_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-supplier">Supplier</label>
                                <select class="form-control form-control-alt" id="example-select" name="supplier" required>
                                    <?php foreach ($suppliers as $supplier) {
                                    ?>
                                        <option value="<?= $supplier->supplier_id ?>" <?= $data->supplier_id==$supplier->supplier_id ? 'selected' : null ?>>
                                            <?= $supplier->supplier_name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-purchase">Harga beli</label>
                                        <input type="number" class="form-control form-control-alt" id="block-form1-purchase" name="purchasePrice" value="{{ $data->product_purchase_price }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="block-form1-sell">Harga jual</label>
                                        <input type="number" class="form-control form-control-alt" id="block-form1-sell" name="sellPrice" value="{{ $data->product_sell_price }}">
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
<?php } ?>
@endsection