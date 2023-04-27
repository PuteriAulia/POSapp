@extends('layout.mainLayout')

@section('title','Kasir | Pembayaran')

@section('hero')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-xl-7">
        <div class="block block-rounded block-themed">
            <div class="block-header bg-modern">
                <h3 class="block-title">PEMBAYARAN</h3>
            </div>
            <div class="block-content">
                <p class="text-muted">{{ $inv }}</p>
                <h3>TOTAL : Rp {{ number_format($total) }}</h3>
                <hr>

                <p class="text-muted">Detail Pembelian</p>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted">Nama barang</th>
                            <th class="text-muted">Qty</th>
                            <th class="text-muted">Sub total</th>
                        </tr>
                        <?php 
                            $date = date("Y-m-d");
                            foreach($cartItems as $data) : 
                        ?>
                        <tr>
                            <td class="text-muted" style="width: 70%;">{{ $data->products->product_name }}</td>
                            <td class="text-muted" style="width: 10%;">{{ $data->product_qty }}</td>
                            <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->product_subtotal) }}</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;"><h4 class="text-muted">Total transaksi</h4></td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($total) }}</td>
                    </tr>
                </table>

                <hr>
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;" class="text-muted">Diskon</td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($disc) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted">Bayar</td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($payment) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted"><b>Grand total</b></td>
                        <td class="text-muted text-right" style="width: 20%;"><b>Rp {{ number_format($grandTotal) }}</b></td>
                    </tr>
                    <td style="width: 80%;" class="text-muted">Kembalian</td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($moneyRet) }}</td>
                    </tr>
                </table>
                
                <?php $date = date("Y-m-d"); ?>
                <form action="/kasir/simpan" method="POST">
                    @csrf
                    <input type="hidden" name="inv" value="{{ $inv }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="grandTotal" value="{{ $grandTotal }}">
                    <input type="hidden" name="disc" value="{{ $disc }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <button type="submit" class="btn btn-success mb-4">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection