<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    protected $dbUsers;

    public function __construct(){
        $this->dbUsers = new User();
    }

    public function index(){
        $users = User::where('status','active')->get();

        //get role_name
        $fArrRoleName = [];
        foreach ($users as $data) {
            $roleId = $data->role_id;
            $arrRoleName = RolesModel::select('role_name')->where('role_id',$roleId)->get();
            foreach ($arrRoleName as $dataRole) {
                $roleName = $dataRole->role_name;
                array_push($fArrRoleName,$roleName);
            }
        }

        return view('users/dataUsers',[
            'users'=>$users,
            'role_name'=>$fArrRoleName,
        ]);
    }

    public function formAdd(){
        $roles = RolesModel::where('role_status','active');
        return view('users/addUsers',['roles'=>$roles]);
    }

    public function add(Request $request){
        $validator = $request->validate([
            'username' => 'unique:users',
        ]);

        $this->dbUsers->name = $request->name;
        $this->dbUsers->username = $request->username;
        $this->dbUsers->email = $request->email;
        $this->dbUsers->phone = $request->phone;
        $this->dbUsers->role_id = $request->level;
        $this->dbUsers->status = 'active';
        $this->dbUsers->password = Hash::make($request->password);
        $insertData = $this->dbUsers->save();

        if ($insertData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil ditambahkan');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal ditambahkan');
        }
        return redirect('/user');
    }

    public function formEdit($id){
        $user = User::where('id',$id)->get();
        
        //Level control
        foreach ($user as $data) {
            $roleId = $data->role_id;
        }

        $arrLvlSelected = RolesModel::where('role_id',$roleId)->get();
        foreach ($arrLvlSelected as $data) {
            $nameSelected = $data->role_name;
            $idSelected = $data->role_id;
        }

        $arrLvlNotSelected = RolesModel::where('role_id', '!=', $roleId)->where('role_status','active')->get();

        return view('users/editUsers',[
            'user'=>$user,
            'nameSelected'=>$nameSelected,
            'idSelected'=>$idSelected,
            'arrLvlNotSelected'=>$arrLvlNotSelected,
        ]);
    }

    public function edit(Request $request, $id){
        $editData = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->level,
            'status'=>'active',
        ]);

        if ($editData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil diubah');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal diubah');
        }

        return redirect('/user');
    }

    public function delete($id){
        $deleteData = User::where('id',$id)->update([
            'status'=>'deactive',
        ]);

        if ($deleteData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data berhasil dihapus');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data gagal dihapus');
        }
        return redirect('/user');
    }
}
