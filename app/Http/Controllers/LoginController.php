<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }else{

                return redirect()->intended('/')->with('info', 'Connecter avec succès');
            }

       }

        return redirect("login")->with('info', 'Nick Mouk');
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
