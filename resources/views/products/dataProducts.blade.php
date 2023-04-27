@extends('layout.mainLayout')

@section('title','Kasir | Data Barang')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Data Barang
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Barang</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Data barang</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<!-- Alert -->
@if (Session::has('status')=='success')
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@elseif(Session::has('status')=='failed')
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- END Alert -->

<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Data Barang</h3>
        <div class="block-options">
            <a href="/barang/tambah"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a>
        </div>
    </div>
    <div class="block-content">
        <!-- Recent Orders Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 15%;">Kode</th>
                        <th class="text-center" style="width: 20%;">Nama</th>
                        <th class="text-center" style="width: 15%;">Supplier</th>
                        <th class="text-center" style="width: 15%;">Harga beli</th>
                        <th class="text-center" style="width: 15%;">Harga jual</th>
                        <th class="text-center" style="width: 5%;">Stok</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach ($products as $product) {
                    ?>
                    <tr>
                        <td class="font-w600 font-size-sm">{{ $no++ }}</td>
                        <td class="font-size-sm">{{ $product->product_id }}</td>
                        <td class="font-size-sm">{{ $product->product_name }}</td>
                        <td class="font-size-sm">{{ $product->suppliers->supplier_name }}</td>
                        <td class="font-size-sm">Rp {{ number_format($product->product_purchase_price) }}</td>
                        <td class="font-size-sm">Rp {{ number_format($product->product_sell_price) }}</td>
                        <td class="font-size-sm">{{ $product->product_stock }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="/barang/edit/{{ $product->product_id }}"><button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Barang">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button></a>
                                <a href="#" onclick="confirmDelete('{{ $product->product_id }}');"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Barang">
                                    <i class="fa fa-fw fa-times"></i>
                                </button></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- END Recent Orders Table -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id){
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah dihapus tidak dapat diakses kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, saya yakin'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href="barang/hapus/"+id;
            }
        })
    }
</script>
@endsection