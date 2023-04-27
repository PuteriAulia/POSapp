<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    protected $dbUsers;

    public function __construct(){
        $this->dbUsers = new User();
    }

    public function formAccount($id){
        $accountData = User::where('id',$id)->get();
        return view('setting/accountSet',[
            'accountData' => $accountData,
        ]);
    }

    public function editAccount(Request $request){
        $editData = User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($editData) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data akun berhasil diubah');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Data akun gagal diubah');
        }

        return redirect('/');
    }

    public function formPassword($id){
        return view('setting/passSet',[
            'userId' => $id,
        ]);
    }

    public function editPassword(Request $request){
        $pass = $request->password;
        $confPass = $request->confPass;
        $id = $request->id;

        if ($pass === $confPass) {
            $editData = User::where('id',$request->id)->update([
                'password' => Hash::make($pass),
            ]);
    
            if ($editData) {
                Session::flash('status', 'success');
                Session::flash('message', 'Password berhasil diubah');
            }else{
                Session::flash('status', 'failed');
                Session::flash('message', 'Password gagal diubah');
            }
            return redirect('/');
            
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Konfirmasi password tidak sesuai');
            return redirect('/pengaturan/password/'.$request->id);
        }
    }
}
