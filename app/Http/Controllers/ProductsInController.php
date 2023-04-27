<?php

namespace App\Http\Controllers;

use App\Models\ProductsInModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsInController extends Controller
{
    protected $dbProductsIn, $dbProducts;

    public function __construct(){
        $this->dbProductsIn = new ProductsInModel();
        $this->dbProducts = new ProductsModel();
    }

    public function index(){
        $productsIn = ProductsInModel::all();
        return view('productsIn/dataProductsIn',[
            'productsIn'=>$productsIn,
        ]);
    }

    public function formAdd(){
        $maxId = ProductsInModel::max('productIn_id');
        $intMaxId = (int) substr($maxId,3);

        if ($maxId == null) {
            $intMaxId = '0001';
        }else{
            $addIntMaxId = $intMaxId+1;
            $intMaxId = sprintf("%'.04d",$addIntMaxId);
        }
        // Make new code
        $newId = "BRM".$intMaxId;

        // Get all products
        $products = ProductsModel::all();

        return view('productsIn/addProductsIn',[
            'productInId'=>$newId,
            'products'=>$products,
        ]);
    }

    public function add(Request $request){
        // Multiple product stock
        $qtyInput = $request->qty;
        $ObjQtyDbProduct = ProductsModel::select('product_stock')->where('product_id',$request->product)->get();
        foreach ($ObjQtyDbProduct as $data) {
            $qtyDbProduct = $data->product_stock;
        }
        $finalStock = (int) $qtyDbProduct + $qtyInput;

        // Insert data to productIn table
        $this->dbProductsIn->productIn_id = $request->id;
        $this->dbProductsIn->product_id = $request->product;
        $this->dbProductsIn->productIn_qty = $request->qty;
        $this->dbProductsIn->productIn_date = $request->date;
        $this->dbProductsIn->productIn_info = $request->info;
        $insertDataProductIn = $this->dbProductsIn->save();

        // Update data to product table
        $editDataProduct = ProductsModel::where('product_id',$request->product)->update([
            'product_stock'=>$finalStock,
        ]);

        if ($insertDataProductIn && $editDataProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }

        return redirect('/barangMasuk');
    }

    public function delete($id){
        // Cut product stock
        $dataProductIn = ProductsInModel::select('*')->where('productIn_id',$id)->get();
        foreach ($dataProductIn as $data) {
            $productInQty = $data->productIn_qty;
            $productInProductId = $data->product_id; 
        }

        $dataProduct = ProductsModel::select('*')->where('product_id',$productInProductId)->get();
        foreach ($dataProduct as $data) {
            $productStock = $data->product_stock;
            $productId = $data->product_id;
        }

        $finalStock = (int) $productStock - (int) $productInQty;

        // Update product stock
        $editDataProduct = ProductsModel::where('product_id',$productId)->update([
            'product_stock'=>$finalStock,
        ]);

        // Delete product in
        $deleteDataProductIn = ProductsInModel::where('productIn_id',$id)->delete();

        if ($deleteDataProductIn && $editDataProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/barangMasuk');
    }

    public function detail($id){
        $productIn = ProductsInModel::select('*')->where('productIn_id',$id)->get();
        return view('productsIn/detailProductsIn',[
            'productIn'=>$productIn,
        ]);
    }
}
