@extends('layout.mainLayout')

@section('title','Kasir | Detail Transaksi')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Report Transaksi
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Transaksi</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Report Transaksi</a>
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
        <h3 class="block-title">Periode Penjualan</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-vcenter table table-borderless table-striped js-dataTable-full">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 15%;">Periode</th>
                        <th class="text-center" style="width: 15%;">Pemasukkan</th>
                        <th class="text-center" style="width: 15%;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        foreach ($sellPeriode as $data):
                    ?>
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data['date'])->translatedFormat('F Y') }}</td>
                        <td class="text-center">Rp {{ number_format($data['income']) }}</td>
                        <td class="text-center">
                            <a href="/transaksi/report/{{ $data['date'] }}">
                                <button type="button" class="btn btn-sm btn-info">Detail</button>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Table Data Suplier -->
@endsection


