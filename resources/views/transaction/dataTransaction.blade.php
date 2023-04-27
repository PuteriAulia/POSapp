@extends('layout.mainLayout')

@section('title','Kasir | Data Transaksi')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Data Transaksi
        </h1> 
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Transaksi</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Data transaksi</a>
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
        <h3 class="block-title">Data Transaksi</h3>
    </div>
    <div class="block-content">
        <!-- Recent Orders Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center" style="width: 20%;">Invoice</th>
                        <th class="text-center" style="width: 20%;">Tanggal</th>
                        <th class="text-center" style="width: 20%;">Diskon</th>
                        <th class="text-center" style="width: 20%;">Total</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach ($trans as $data) {
                    ?>
                    <tr>
                        <td class="font-w600 font-size-sm">{{ $no++ }}</td>
                        <td class="font-size-sm text-center">{{ $data->transaction_id }}</td>
                        <td class="font-size-sm text-center">{{ \Carbon\Carbon::parse($data->transaction_date)->translatedFormat('d F Y') }}</td>
                        <td class="font-size-sm text-center">Rp {{ number_format($data->transaction_disc) }}</td>
                        <td class="font-size-sm text-center">Rp {{ number_format($data->transaction_grand_total) }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="/transaksi/detail/{{ $data->transaction_id }}"><button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail transaksi">
                                    <i class="fa fa-fw fa-eye"></i>
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
@endsection