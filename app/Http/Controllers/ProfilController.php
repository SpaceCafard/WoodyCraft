<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Panier;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function showProfil(User $user)
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $customers= Customer::where('id', $user->customer_id)->first();

            $count = Panier::where('name', $user->name)->count();

            return view('profil.profil',compact('count','user','customers'));

        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }

    }

    public function editProfil()
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $customers= Customer::where('id', $user->customer_id)->first();

            $count = Panier::where('name', $user->name)->count();

            return view('profil.editProfil',compact('count','user','customers'));

        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }

    public function updateProfil(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $request->validate([

                'forname' ,
                'surname',
                'add1',
                'add2',
                'add3',
                'postcode',
                'phone',
                'email'


            ]);

            $customer = Customer::query()->findOrFail($id);
            $customer->forname = $request->get('forname');
            $customer->surname = $request->get('surname');
            $customer->add1 = $request->get('add1');
            $customer->add2 = $request->get('add2');
            $customer->add3 = $request->get('add3');
            $customer->phone = $request->get('phone');
            $customer->postcode = $request->get('postcode');

            $customer->update();

            $user->email = $request->get('email');

            $user->update();

            return redirect('/user/profil');

        }
        else
        {
            return redirect('login');
        }
    }

    public function editMdp()
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $count = Panier::where('name', $user->name)->count();

            return view('profil.editMdp',compact('count','user'));

        }
        else
        {
            return redirect('login')->with('info','Il faut vous connecter pour acceder a cette fonctionalité');
        }
    }


    public function updateIdentifiant(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $request->validate([

                'oldPwd',
                'verifPwd' => 'min:8',
                'password' => 'min:8'

            ]);

            $check = Hash::check($request->oldPwd, $user->password);

            if(!Hash::check($request->oldPwd, $user->password))
            {
                return redirect('/user/profil/'. $id .'/mdp')->with('info','Votre mot de passe est incorect '. $check);
            }
            else
            {
                if($request->get('verifPwd') == $request->get('password'))
                {
                    $hashMdp = Hash::make($request['password']);
                    $user->password=$hashMdp;

                    $user->update();

                    return redirect('/user/profil')->with('info','Votre mot de pass a été mis à jour');
                }
                else
                {
                    return redirect('/user/profil/'. $id .'/mdp')->with('info','Les mots de pass ne correspondent pas');
                }
            }

        }
        else
        {
            return redirect('login');
        }
    }

}
