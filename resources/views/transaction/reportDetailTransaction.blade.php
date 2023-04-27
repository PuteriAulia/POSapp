@extends('layout.mainLayout')

@section('title','Kasir | Detail Transaksi')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Detail Report Transaksi
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Transaksi</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/transaksi/report">Report transaksi</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Detail Report</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<!-- Table Data Suplier -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Report Penjualan {{ \Carbon\Carbon::parse($date)->translatedFormat('F Y') }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-vcenter table table-borderless table-striped js-dataTable-full">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 15%;">Nama Barang</th>
                        <th class="text-center" style="width: 15%;">Jumlah penjualan</th>
                        <th class="text-center" style="width: 20%;">Pendapatan produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $i=1;
                        foreach ($detailReport as $data) {
                    ?>
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $data['productName'] }}</td>
                            <td class="text-center">{{ $data['sellQty'] }}</td>
                            <td class="text-center">Rp {{ number_format($data['income']) }}</td>
                        </tr>
                    <?php
                        $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Table Data Suplier -->
@endsection


