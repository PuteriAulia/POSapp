<?php

namespace App\Http\Controllers;

use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        Session::flash('status', 'gagal');
        Session::flash('message', 'Gagal login');

        return redirect('/login');
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
