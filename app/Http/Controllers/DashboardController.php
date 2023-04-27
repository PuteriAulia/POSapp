<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\SuppliersModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index(){
        $dateMonth = date('m');
        $dateYear = date('Y');

        $products = ProductsModel::count();
        $suppliers = SuppliersModel::count();
        $income = TransactionModel::select(DB::raw('SUM(transaction_grand_total) as sellIncome'))
        ->where(DB::raw('MONTH(transaction_date)'),$dateMonth)
        ->where(DB::raw('YEAR(transaction_date)'),$dateYear)
        ->get();
        $transaction = TransactionModel::orderBy('transaction_id','desc')->get();

        return view('dashboard',[
            'products'=>$products,
            'suppliers'=>$suppliers,
            'income'=>$income,
            'transaction'=>$transaction,
        ]);
    }
}
