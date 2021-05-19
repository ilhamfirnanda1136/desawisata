<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User};

use Auth;

class AuthController extends Controller
{
    /* Admin Authentication */
    public function index() 
    {
        return view('auth.login');    
    }

    public function process(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username',$req->username)->first();
        if(!$user) return redirect()->back()->with('error','mohon maaf username yang anda masukkan salah');
        if(!Auth::attempt(['username' => $req->username, 'password' => $req->password]))  return redirect()->back()->with('error','mohon maaf password yang anda masukkan salah');
        return redirect('home');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
