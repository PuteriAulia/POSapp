@extends('layout.mainLayout')

@section('title','Kasir | Kasir');

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Kasir
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Transaksi</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Kasir</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <!-- Pemilihan barang -->
        <div class="block block-rounded">
            <div class="block-content p-3">
                <div class="font-size-sm font-w600 text-uppercase text-muted">ID Transaksi</div>
                <div class="font-size-h2 text-dark">{{ $inv; }}</div>
            </div>
        </div>
        <!-- End pemilihan barang -->
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <!-- Total pembayaran -->
        <div class="block block-rounded">
            <div class="block-content p-3">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total</div>
                <div class="font-size-h2 font-w400 text-dark">Rp {{ number_format($total) }}</div>
            </div>
        </div>
        <!-- End total pembayaran -->
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2">
        <!-- Total pembayaran -->
        <div class="block block-rounded">
            <div class="block-content p-3">
                <div class="font-size-sm font-w600 text-uppercase text-muted mb-2">Pembayaran</div>
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#pembayaran">
                    Bayar
                </button>
            </div>
        </div>
        <!-- End total pembayaran -->
    </div>
</div>

<!-- Start tambah barang & jumlah -->
<div class="block block-rounded">
    <div class="block-content">
        <h5>Pilih barang</h5>

        <!-- Start form pilih barang -->
        <form action="kasir/tambah" method="POST">
            @csrf
            <div class="form-group">
                <div class="row">
                    <input type="hidden" class="form-control form-control-alt" name="id" value="{{ $inv }}">
                    <div class="col-7 col-md-7 col-lg-7 col-xl-7">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="barang" placeholder="Masukkan nama barang.." name="productId" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cari-barang">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                        <input type="number" class="form-control form-control-alt" name="qty" placeholder="Jumlah barang.." required>
                    </div>

                    <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                        <button type="submit" class="btn btn-primary" name="transasksi_tambah_barang">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <!-- End form pilih barang -->
    </div>
</div>
<!-- End tambah barang & jumlah -->

<!-- Daftar barang -->
<div class="block block-rounded">
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-vcenter">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 20%;">Nama</th>
                        <th class="text-center" style="width: 10%;">Jumlah</th>
                        <th class="text-center" style="width: 10%;">Harga</th>
                        <th class="text-center" style="width: 10%;">Sub total</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($cartItems as $item)
                    <tr>
                        <th class="text-center" scope="row">{{ $no++; }}</th>
                        <td><p>{{ $item->products->product_name }}</p></td>
                        <td><p>{{ $item->product_qty }}</p></td>
                        <td><p>Rp {{ number_format($item->products->product_sell_price) }}</p></td>
                        <td><p>Rp {{ number_format($item->product_subtotal) }}</p></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="/kasir/hapus/{{ $item->id }}/{{ $item->product_id }}/{{ $item->product_qty }}">
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus data">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </a>
                            </div>
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End daftar barang -->
</div>
<!-- END Page Content -->

<!-- Start modal pilih barang-->
<div class="modal fade" id="cari-barang" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pencarian Barang</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <!-- Start table -->
                <div class="table-responsive">
                    <table class="table table-vcenter table table-bordered js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">No</th>
                                <th class="text-center" style="width: 20%;">Kode</th>
                                <th class="text-center" style="width: 20%;">Nama</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ $no=1; }}
                            @foreach ($products as $product)
                            <tr>
                                <th class="text-center" scope="row">{{ $no++; }}</th>
                                <td><p>{{ $product->product_id }}</p></td>
                                <td><p>{{ $product->product_name }}</p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" onclick="pilihBarang('{{ $product->product_id }}')">Pilih</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End tabel -->
            </div>
            <div class="block-content block-content-full text-right border-top">
                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End modal pilih barang-->

<!-- Start modal pembayaran -->
<div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Proses pembayaran</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <label class="text-mute">Total belanja</label>
                <h1 class="text-mute">Rp {{ $total }}</h1>
                <hr>

                <form action="/kasir/pembayaran" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $total }}" name='total'>
                    <input type="hidden" value="{{ $inv }}" name='inv'>

                    <div class="form-group">
                        <label>Jumlah pembayaran</label>
                        <input type="number" class="form-control form-control-alt" name="payment" placeholder="Jumlah uang pembayaran.." required>
                    </div>

                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="number" class="form-control form-control-alt" name="disc" value="0" placeholder="Jumlah diskon..">
                    </div>

                    <div class="block-content block-content-full text-right border-top">
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>             
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- End modal pembayaran -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function pilihBarang(idBarang){
        $('#barang').val(idBarang);
        $('#cari-barang').modal('hide');
    }
</script>
@endsection