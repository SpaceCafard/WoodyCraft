<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Panier;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function homeAdmin()
    {
        if(Auth::id()) {
            $user = auth()->user();
            $count = Panier::where('name', $user->name)->count();
            return view('admin.homeAdmin', compact('user','count'));
        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }

    public function showUser()
    {
        if(Auth::id())
        {
            $customers= Customer::all();


            return view('admin.listUser', compact('customers'));

        }
        else{
            return redirect('login');
        }
    }

    public function archiveIndex()
    {
        if(Auth::id()) {
            $user = auth()->user();
            $products = Product::all();
            $categories = Categorie::all();
            return view('admin.archive', compact('user','products','categories'));
        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }


}
