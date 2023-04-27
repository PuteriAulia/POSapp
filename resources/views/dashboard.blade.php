@extends('layout.mainLayout')

@section('title', 'Kasir | Dashboard')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Halaman Dashboard
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Selamat datang {{ ucwords(Auth::user()->name) }}, semoga harimu menyenangkan.
                </h2>
            </div>
        </div>
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

<div class="row row-deck">
    <!-- Total pendapatan -->
    <div class="col-sm-4 col-xl-4">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    @foreach ($income as $data)
                    <dt class="font-size-h2 font-w700">Rp {{ number_format($data->sellIncome) }}</dt>
                    @endforeach
                    <dd class="text-muted mb-0">Jumlah barang</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-money-bill-wave font-size-h3 text-primary"></i>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                <a class="font-w500 d-flex align-items-center" href="/transaksi">
                    Transaksi
                    <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END Total pendapatan -->

    <!-- Jumlah barang -->
    <div class="col-sm-4 col-xl-4">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $products }}</dt>
                    <dd class="text-muted mb-0">Jumlah barang</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-shopping-bag font-size-h3 text-primary"></i>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                <a class="font-w500 d-flex align-items-center" href="/barang">
                    Daftar barang
                    <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END Jumlah barang -->
    
    <!-- Jumlah supplier -->
    <div class="col-sm-4 col-xl-4">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $suppliers }}</dt>
                    <dd class="text-muted mb-0">Jumlah suplier</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-user font-size-h3 text-primary"></i>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                <a class="font-w500 d-flex align-items-center" href="/suplier">
                    Daftar suplier
                    <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END Jumlah supplier -->
</div>

<!-- Transaksi -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Data Transaksi</h3>
        <div class="block-options">
            <a href="/kasir"><button type="button" class="btn btn-sm btn-primary">Kasir</button></a>
        </div>
    </div>
    <div class="block-content">
        <!-- Recent Orders Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 30%;">Invoice</th>
                        <th class="text-center" style="width: 30%;">Tanggal</th>
                        <th class="text-center" style="width: 30%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        foreach ($transaction as $data) {
                    ?>
                            <tr>
                                <td class="font-w600 font-size-sm">{{ $no++ }}</td>
                                <td class="font-size-sm text-center">{{ $data->transaction_id }}</td>
                                <td class="font-size-sm text-center">{{ $data->transaction_date }}</td>
                                <td class="font-size-sm text-center">{{ $data->transaction_grand_total }}</td>
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
<!-- End Transaksi -->
@endsection