<?php

namespace App\Http\Controllers;

use App\Models\RolesModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $dbRole;

    public function __construct(){
        $this->dbRole = new RolesModel();
    }

    public function index(){
        $roles = RolesModel::where('role_status','active')->get();
        return view('roles/dataRoles',[
            'roles'=>$roles,
        ]);
    }

    public function formAdd(){
        $maxId = RolesModel::max('role_id');
        $intMaxId = (int) substr($maxId,2);

        if ($maxId == null) {
            $intMaxId = '0001';
        }else{
            $addIntMaxId = $intMaxId+1;
            $intMaxId = sprintf("%'.04d",$addIntMaxId);
        }   
        // Make new code
        $newId = "RL".$intMaxId;

        return view('roles/addRoles',[
            'roleId'=>$newId,
        ]);
    }

    public function add(Request $request){
        $this->dbRole->role_id = $request->id;
        $this->dbRole->role_name = $request->name;
        $this->dbRole->role_status = 'active';
        $insertData = $this->dbRole->save();

        if ($insertData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }

        return redirect('/role');
    }

    public function formEdit($id){
        $role = RolesModel::select('*')->where('role_id',$id)->get();

        return view('roles/editRoles',[
            'role'=>$role,
        ]);
    }

    public function edit(Request $request, $id){
        $editData = RolesModel::where('role_id',$id)->update([
            'role_id' => $id,
            'role_name' => $request->name,
            'role_status'=>'active',
        ]);

        if ($editData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil diubah');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal diubah');
        }

        return redirect('/role');
    }

    public function delete($id){
        $deleteData = RolesModel::where('role_id',$id)->update([
            'role_status'=>'deactive',
        ]);

        if ($deleteData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/role');
    }
}
