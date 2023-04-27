<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\ProductsOutModel;
use Illuminate\Support\Facades\Session;

class ProductsOutController extends Controller
{
    protected $dbProductsOut, $dbProducts;

    public function __construct(){
        $this->dbProductsOut = new ProductsOutModel();
        $this->dbProducts = new ProductsModel();
    }

    public function index(){
        $productsOut = ProductsOutModel::all();
        return view('productsOut/dataProductsOut',[
            'productsOut'=>$productsOut,
        ]);
    }

    public function formAdd(){
        $maxId = ProductsOutModel::max('productOut_id');
        $intMaxId = (int) substr($maxId,3);

        if ($maxId == null) {
            $intMaxId = '0001';
        }else{
            $addIntMaxId = $intMaxId+1;
            $intMaxId = sprintf("%'.04d",$addIntMaxId);
        }
        // Make new code
        $newId = "BRR".$intMaxId;

        // Get all products
        $products = ProductsModel::all();

        return view('productsOut/addProductsOut',[
            'productOutId'=>$newId,
            'products'=>$products,
        ]);
    }

    public function add(Request $request){
        // Cut product stock
        $qtyInput = $request->qty;
        $ObjQtyDbProduct = ProductsModel::select('product_stock')->where('product_id',$request->product)->get();
        foreach ($ObjQtyDbProduct as $data) {
            $qtyDbProduct = $data->product_stock;
        }
        $finalStock = (int) $qtyDbProduct - $qtyInput;

        // Insert data to productIn table
        $this->dbProductsOut->productOut_id = $request->id;
        $this->dbProductsOut->product_id = $request->product;
        $this->dbProductsOut->productOut_qty = $request->qty;
        $this->dbProductsOut->productOut_date = $request->date;
        $this->dbProductsOut->productOut_info = $request->info;
        $insertDataProductOut = $this->dbProductsOut->save();

        // Update data to product table
        $editDataProduct = ProductsModel::where('product_id',$request->product)->update([
            'product_stock'=>$finalStock,
        ]);

        if ($insertDataProductOut && $editDataProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }

        return redirect('/barangRetur');
    }

    public function delete($id){
        // Plus product stock
        $dataProductOut = ProductsOutModel::select('*')->where('productOut_id',$id)->get();
        foreach ($dataProductOut as $data) {
            $productOutQty = $data->productOut_qty;
            $productOutProductId = $data->product_id; 
        }

        $dataProduct = ProductsModel::select('*')->where('product_id',$productOutProductId)->get();
        foreach ($dataProduct as $data) {
            $productStock = $data->product_stock;
            $productId = $data->product_id;
        }

        $finalStock = (int) $productStock + (int) $productOutQty;

        // Update product stock
        $editDataProduct = ProductsModel::where('product_id',$productId)->update([
            'product_stock'=>$finalStock,
        ]);

        // Delete product in
        $deleteDataProductOut = ProductsOutModel::where('productOut_id',$id)->delete();

        if ($deleteDataProductOut && $editDataProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/barangRetur');
    }

    public function detail($id){
        $productOut = ProductsOutModel::select('*')->where('productOut_id',$id)->get();
        return view('productsOut/detailProductsOut',[
            'productOut'=>$productOut,
        ]);
    }
}
