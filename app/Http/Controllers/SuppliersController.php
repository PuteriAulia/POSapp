<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\SuppliersModel;
use Illuminate\Support\Facades\Session;

class SuppliersController extends Controller
{
    protected $dbSuppliers;

    public function __construct(){
        $this->dbSuppliers = new SuppliersModel();
    }

    public function index(){
        $suppliers = SuppliersModel::select('*')->where('supplier_status','active')->get();
        return view('suppliers/dataSuppliers',[
            'suppliers'=>$suppliers,
        ]);
    }

    public function formAdd(){
        $maxId = SuppliersModel::max('supplier_id');
        $intMaxId = (int) substr($maxId,3);

        if ($maxId == null) {
            $intMaxId = '0001';
        }else{
            $addIntMaxId = $intMaxId+1;
            $intMaxId = sprintf("%'.04d",$addIntMaxId);
        }
        // Make new code
        $newId = "SUP".$intMaxId;

        return view('suppliers/addSuppliers',[
            'supplierId'=>$newId,
        ]);
    }

    public function add(Request $request){
        $this->dbSuppliers->supplier_id = $request->id;
        $this->dbSuppliers->supplier_name = $request->name;
        $this->dbSuppliers->supplier_address = $request->address;
        $this->dbSuppliers->supplier_phone = $request->phone;
        $this->dbSuppliers->supplier_status = 'active';
        $insertData = $this->dbSuppliers->save();

        if ($insertData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }

        return redirect('/supplier');
    }

    public function formEdit($id){
        $supplier = SuppliersModel::select('*')->where('supplier_id',$id)->get();
        return view('suppliers/editSupplier',[
            'supplier'=>$supplier,
        ]);
    }

    public function edit(Request $request, $id){
        $editData = SuppliersModel::where('supplier_id',$id)->update([
            'supplier_id' => $id,
            'supplier_name' => $request->name,
            'supplier_address' => $request->address,
            'supplier_phone' => $request->phone,
            'supplier_status'=>'active',
        ]);

        if ($editData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil diubah');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal diubah');
        }

        return redirect('/supplier');
    }

    public function delete($id){
        $deleteData = SuppliersModel::where('supplier_id',$id)->update([
            'supplier_status'=>'deactive',
        ]);

        if ($deleteData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/supplier');
    }

}
