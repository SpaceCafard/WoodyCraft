<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Panier;
use App\Models\Product;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Hash;

class AdminController extends Controller
{

    public function homeAdmin()
    {
        if(Auth::id()) {
            $user = auth()->user();
            $count = Panier::where('name', $user->name)->count();
            $ip = $_SERVER['SERVER_ADDR'];
            return view('admin.homeAdmin', compact('user','count','ip'));
        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }

    public function indexUser()
    {
        if(Auth::id())
        {
            $customers= Customer::oldest('forname')->get();

            return view('admin.listUser', compact('customers'));

        }
        else{
            return redirect('login');
        }
    }

    public function showUser($id)
    {
        if(Auth::id())
        {
            $customers = Customer::query()->findOrFail($id);
            $user = auth()->user();
            return view('admin.showUser', compact('customers','user'));
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
            $ip = $_SERVER['SERVER_ADDR'];
            return view('admin.archive', compact('user','products','categories','ip'));
        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }

    public function registerAdmin()
    {
        return view('admin.registerAdmin');
    }

    public function storeRegAdmin(Request $request)
    {
        $request->validate([

            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:12',

        ]);

        $hashMdp = Hash::make($request['password']);
        $users = new user([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => $hashMdp,
        ]);

        $users->is_admin = 1;

        $pathFile = resource_path('views\admin\registerAdmin.blade.php');
        unlink($pathFile);
        $users->save();


        return redirect('/')->with('info', "Inscrit en temps qu'admin avec succès");
    }


}
