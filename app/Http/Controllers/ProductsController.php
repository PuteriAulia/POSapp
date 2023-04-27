<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\ProductsModel;
use App\Models\SuppliersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    protected $dbProducts,$dbSuppliers;

    public function __construct(){
        $this->dbProducts = new ProductsModel();
        $this->dbSuppliers = new SuppliersModel();
    }

    public function index(){
        // Get product
        $products = ProductsModel::select('*')->where('product_status','active')->get();
        return view('products/dataProducts',[
            'products'=>$products,
        ]);
    }

    public function formAdd(){
        $maxId = ProductsModel::max('product_id');
        $intMaxId = (int) substr($maxId,2);

        if ($maxId == null) {
            $intMaxId = '0001';
        }else{
            $addIntMaxId = $intMaxId+1;
            $intMaxId = sprintf("%'.04d",$addIntMaxId);
        }   
        // Make new code
        $newId = "BR".$intMaxId;

        // Get supplier datas
        $suppliers = SuppliersModel::all();

        return view('products/addProducts',[
            'productId'=>$newId,
            'suppliers'=>$suppliers,
        ]);
    }

    public function add(Request $request){
        $this->dbProducts->product_id = $request->id;
        $this->dbProducts->product_name = $request->name;
        $this->dbProducts->product_stock = 0;
        $this->dbProducts->product_purchase_price = $request->purchasePrice;
        $this->dbProducts->product_sell_price = $request->sellPrice;
        $this->dbProducts->supplier_id = $request->supplier;
        $insertData = $this->dbProducts->save();

        if ($insertData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }

        return redirect('/barang');
    }

    public function formEdit($id){
        $products = ProductsModel::select('*')->where('product_id',$id)->get();
        $suppliers = SuppliersModel::all();

        return view('products/editProduct',[
            'product'=>$products,
            'suppliers'=>$suppliers,
        ]);
    }

    public function edit(Request $request, $id){
        $editData = ProductsModel::where('product_id',$id)->update([
            'product_id' => $id,
            'product_name' => $request->name,
            'product_purchase_price'=>$request->purchasePrice,
            'product_sell_price'=>$request->sellPrice,
            'product_status'=>'active',
            'supplier_id'=>$request->supplier,
        ]);

        if ($editData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil diubah');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal diubah');
        }

        return redirect('/barang');
    }

    public function delete($id){
        $deleteData = ProductsModel::where('product_id',$id)->update([
            'product_status'=>'deactive',
        ]);

        if ($deleteData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/barang');
    }
}
