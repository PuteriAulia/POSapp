<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    protected $dbCart, $dbTransaction, $dbTransDetail;

    public function __construct(){
        $this->dbCart = new CartModel();
        $this->dbTransaction = new TransactionModel();
        $this->dbTransDetail = new TransactionDetailModel();
    }

    public function index(){
        // Id transaction
        $maxId = TransactionModel::max('transaction_id');
        $dateKode = (int) substr($maxId,-10,6);
		$orderCode = (int) substr($maxId,-4,4);
        $date = date('ymd');

        if ($dateKode == $date) {
            $incrementCode = $orderCode+1;
            $orderCode = sprintf("%'.04d",$incrementCode);
        }else{
            $orderCode = "0001";
        }
        $invoice = "INV".date('ymd').$orderCode;

        // Ready product
        $products = ProductsModel::where('product_status','active')->where('product_stock','>',0)->get();

        // Purchase Total
        $idUser = Auth::user()->id;
        $findCart = CartModel::where('user_id',$idUser)->get();
        if (count($findCart) == 0) {
            $total=0;
        }else{
            $total=0;
            foreach ($findCart as $data) {
                $total+=$data->product_subtotal;
            }
        }

        // Get cart items with user id
        $idUser = Auth::user()->id;
        $cartItems = CartModel::where('user_id',$idUser)->get();

        return view('cashier/cashier',[
            'inv'=>$invoice,
            'products'=>$products,
            'total'=>$total,
            'cartItems'=>$cartItems,
        ]);
    }

    public function addCart(Request $request){
        $productId = $request->productId;
        $qty = $request->qty;
        $inv = $request->id;
        $idUser = Auth::user()->id;

        // Check product stock
        $dataProduct = ProductsModel::where('product_id',$productId)->get();
        foreach ($dataProduct as $data) {
            $checkStock = $data->product_stock-$qty;
        }

        if ($checkStock >= 0) {
            foreach ($dataProduct as $data) {
                $subtotal = $data->product_sell_price*$qty;
            }

            // Check same product at cart
            $productCart = CartModel::where('product_id',$productId)->where('user_id',$idUser)->get();
            
            if (count($productCart) == 0) {
                // Save to cart table
                $this->dbCart->user_id = $idUser;
                $this->dbCart->product_id = $productId;
                $this->dbCart->product_qty = $qty;
                $this->dbCart->product_subtotal = $subtotal;
                $this->dbCart->transaction_id = $inv;
                $this->dbCart->save();

                // Update product table
                foreach ($dataProduct as $data) {
                    $newStock = $data->product_stock - $qty;
                }
                ProductsModel::where('product_id',$productId)->update([
                    'product_stock'=>$newStock,
                ]);
            }else{
                // Update cart model
                foreach ($productCart as $data) {
                    $newQty = $data->product_qty + $qty;
                    $subtotal = $subtotal*$newQty; 
                }
                CartModel::where('user_id',$idUser)->where('product_id',$productId)->update([
                    'product_qty'=>$newQty,
                    'product_subtotal'=>$subtotal,
                ]);

                // Update product table
                foreach ($dataProduct as $data) {
                    $newStock = $data->product_stock - $qty;
                }
                ProductsModel::where('product_id',$productId)->update([
                    'product_stock'=>$newStock,
                ]);
            }

        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Stok barang tidak cukup');
        }
        return redirect()->to('/kasir');
    }

    public function deleteCart($cartId, $productId, $productQty){
        // Add product stock in product table
        $productData = ProductsModel::where('product_id',$productId)->get();
        foreach ($productData as $data) {
            $newStock = $data->product_stock + $productQty;
        }
        ProductsModel::where('product_id',$productId)->update([
            'product_stock'=>$newStock,
        ]);

        // Delete cart item
        CartModel::where('id',$cartId)->delete();

        return redirect()->to('/kasir');
    }

    public function payment(Request $request){
        $total = $request->total;
        $inv = $request->inv;
        $payment = $request->payment;
        $disc = $request->disc; 
        $idUser = Auth::user()->id;

        // Check total payment
        $check = $payment - $total;
        if ($check < 0) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Jumlah pembayaran kuran dari total belanja');
            return redirect()->to('/kasir');
        }else{
            $grandTotal = $total-$disc;
            $moneyRet = $payment - $grandTotal;
        }

        // Get match cart item with user id
        $cartItem = CartModel::where('user_id',$idUser)->get();
       
        return view('cashier/payment',[
            'total'=>$total,
            'payment'=>$payment,
            'grandTotal'=>$grandTotal,
            'disc'=>$disc,
            'moneyRet'=>$moneyRet,
            'cartItems'=>$cartItem,
            'inv'=>$inv,
        ]);
    }

    public function save(Request $request){
        $idUser = Auth::user()->id;

        // Save data to transaction table
        $this->dbTransaction->transaction_id = $request->inv;
        $this->dbTransaction->user_id = $idUser;
        $this->dbTransaction->transaction_date = $request->date;
        $this->dbTransaction->transaction_disc = $request->disc;
        $this->dbTransaction->transaction_total = $request->total;
        $this->dbTransaction->transaction_grand_total = $request->grandTotal;
        $this->dbTransaction->save();

        // Save data to transaction detail table
        $paymentItems = CartModel::where('user_id',$idUser)->get();
        foreach ($paymentItems as $data) {
            $saveTransactionDetail[] = [
                'transaction_id' => $data->transaction_id,
                'product_id' => $data->product_id,
                'detail_qty' => $data->product_qty,
                'detail_subtotal' => $data->product_subtotal,
                'detail_price' => $data->products->product_sell_price,
            ];
        }
        // dd($saveTransactionDetail);
        TransactionDetailModel::insert($saveTransactionDetail);

        // Delete cart item by user id
        CartModel::where('user_id',$idUser)->delete();
        return redirect()->to('/kasir');
    }
}
