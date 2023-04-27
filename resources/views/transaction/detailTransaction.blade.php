@extends('layout.mainLayout')

@section('title','Kasir | Detail Transaksi')

@section('hero')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-xl-7">
        <div class="block block-rounded block-themed">
            <div class="block-header bg-modern">
                <h3 class="block-title">Detail Transaksi</h3>
                <?php foreach($transaction as $data): ?>
                <a href="/transaksi/printDetail/{{ $data->transaction_id }}">
                    <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-print"></i> Print</button>
                </a> 
                <?php endforeach; ?>
            </div>
            <div class="block-content">
                <?php foreach($transaction as $data): ?>
                <p class="text-muted">{{ ucwords($data->user->name) }} | {{ $data->transaction_id }}</p>
                <h3>TOTAL : Rp {{ number_format($data->transaction_grand_total) }}</h3>
                <hr>
                <?php endforeach; ?>

                <p class="text-muted">Detail Pembelian</p>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted">Nama barang</th>
                            <th class="text-muted">Harga</th>
                            <th class="text-muted">Qty</th>
                            <th class="text-muted">Sub total</th>
                        </tr>
                        <?php 
                            $tanggal = date("Y-m-d");
                            foreach ($transactionDetail as $data) {
                        ?> 
                        <tr>
                            <td class="text-muted" style="width: 50%;">{{ $data->products->product_name }}</td>
                            <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->detail_price) }}</td>
                            <td class="text-muted" style="width: 10%;">{{ $data->detail_qty }}</td>
                            <td class="text-muted text-right" style="width: 20%;">{{ number_format($data->detail_subtotal) }}</td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <hr>

                <?php foreach ($transaction as $data) { ?>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;"><h4 class="text-muted">Total transaksi</h4></td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->transaction_total) }}</td>
                    </tr>
                </table>

                <hr>
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;" class="text-muted">Diskon</td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->transaction_disc) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted"><b>Grand total</b></td>
                        <td class="text-muted text-right" style="width: 20%;"><b>Rp {{ number_format($data->transaction_grand_total) }}</b></td>
                    </tr>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
@endsection