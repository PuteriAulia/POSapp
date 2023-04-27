<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetailModel;

class TransactionController extends Controller
{
    public function index(){
        $transaction = TransactionModel::orderBy('transaction_id','desc')->get();
        return view('transaction/dataTransaction',[
            'trans'=>$transaction,
        ]);
    }

    public function detail($id){
        $transactionDetail = TransactionDetailModel::where('transaction_id',$id)->get();
        $transaction = TransactionModel::where('transaction_id',$id)->get();
        return view('transaction/detailTransaction',[
            'transactionDetail'=>$transactionDetail,
            'transaction'=>$transaction,
        ]);
    }

    public function print($id){
        $transactionDetail = TransactionDetailModel::where('transaction_id',$id)->get();
        $transaction = TransactionModel::where('transaction_id',$id)->get();
        return view('transaction/printDetailTransaction',[
            'transactionDetail'=>$transactionDetail,
            'transaction'=>$transaction,
        ]);
    }

    public function report(){
        $periodeTransaction = TransactionModel::select(DB::raw('SUM(transaction_grand_total) as incomePeriode, YEAR(transaction_date) year, MONTH(transaction_date) month'),'transaction_date')
        ->groupby('year','month')
        ->orderBy('transaction_date','desc')
        ->get();

        // $arrPeriode=[];
        foreach ($periodeTransaction as $data) {
            $date = $data->transaction_date;
            $newFormatDate = substr($date,0,7);
            $arrPeriode[] = [
                'date' => $newFormatDate,
                'income' => $data->incomePeriode,
            ];
            // array_push($arrPeriode, $newFormatDate);
        }

        return view('transaction/reportTransaction',[
            'sellPeriode' => $arrPeriode,
        ]);
    }

    public function detailReport($date){
        $sellCount = TransactionDetailModel::select(DB::raw('SUM(detail_qty) as sellQty, SUM(detail_subtotal) as sellIncome, YEAR(transaction_date) year, MONTH(transaction_date) month'),'product_name','transaction_date')
        ->join('transaction','transaction_detail.transaction_id','=','transaction.transaction_id')
        ->join('products','transaction_detail.product_id','=','products.product_id')
        ->groupby('product_name','year','month')
        ->orderby('sellQty','desc')
        ->get();

        foreach ($sellCount as $data) {
            $newPeriode = substr($data->transaction_date,0,7);
            if ($date == $newPeriode) {
                $detailReport[] = [
                    'productName' => $data->product_name,
                    'sellQty' => $data->sellQty,
                    'transactionDate' => $date,
                    'income' => $data->sellIncome
                ];
            }
        }

        return view('transaction/reportDetailTransaction',[
            'detailReport' => $detailReport,
            'date' => $date,
        ]);
    }
}
