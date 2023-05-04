<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Admin;
use Hash;

class RegisterController extends Controller
{
    public function Senregistrer()
    {
        return view('auth.register');
    }

    public function storeReg(Request $request)
    {
        $request->validate([
            $forname = 'forname' => 'required' ,
            'surname' => 'required',
            'add1' => 'required',
            'add2',
            'add3',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',

        ]);

        $hashMdp = Hash::make($request['password']);


        $customers = new customer([
            'forname' => $request->get('forname'),
            'surname' => $request->get('surname'),
            'add1' => $request->get('add1'),
            'add2' => $request->get('add2'),
            'add3' => $request->get('add3'),
            'postcode' => $request->get('postcode'),
            'phone' => $request->get('phone'),

        ]);

        $customers->save();

        $idNewClient = Customer::latest()->first()->id;


        $users = new user([
            'customer_id' => $idNewClient,
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => $hashMdp,
        ]);

        $users->is_admin = 0;


        $users->save();
        return redirect('/')->with('info', 'Inscrit avec succès');
    }


}
