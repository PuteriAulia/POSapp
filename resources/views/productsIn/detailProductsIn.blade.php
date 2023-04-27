@extends('layout/mainLayout')

@section('title','Kasir | Detail Barang Masuk')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Detail Barang Masuk
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Barang masuk</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="/barangMasuk">Data barang masuk</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Detail data</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
@foreach ($productIn as $data)
<div class="row justify-content-center">
    <div class="col-sm-8">
        <!-- Detail barang masuk -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                
            </div>
            <div class="block-content">
                <h3 class="mb-1 text-gray-dark">{{ $data->products->product_name }}</h3>
                <hr>
                <table class="mb-3 text-gray-dark">
                    <tr>
                        <td>Tanggal</td>
                        <td>: {{ $data->productIn_date }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah barang masuk</td>
                        <td>: {{ $data->productIn_qty }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>: {{ $data->productIn_info }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- END Detail barang masuk -->
    </div>
</div>
@endforeach
@endsection