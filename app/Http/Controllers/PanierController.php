<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Panier;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{


    public function ajoutPanier(Request $request, $id="")
    {
        if(Auth::id())
        {
            $user=auth()->user();
            $product=product::find($id);
            $paniers = Panier::all();
            foreach ($paniers as $panier)
            {
                if($user->name == $panier->name && $product->id == $panier->product_id){
                    if($panier->quantity+$request->quantity > $product->stock)
                    {
                        return redirect()->back()->with('info', 'Stock Insufisant');
                    }
                    else
                    {
                        $panier->quantity = $panier->quantity + $request->quantity;
                        $panier->update();
                        return redirect()->back()->with('info', 'Quantité mis à jour');
                    }
                }
                else{
                    continue;
                }
            }


            $panier= new panier;
            $panier->name=$user->name;
            $panier->product_id=$product->id;
            $panier->quantity=$request->quantity;
            $panier->save();

            return redirect()->back()->with('info', 'Produit ajouter avec succès');
        }
        else
        {
            return redirect('login');
        }
    }


    public function verifPanier()
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $hs = false;

            $paniers = Panier::where('name', $user->name)->get();

            $products = Product::all();

            foreach ($paniers as $panier) {
                foreach ($products as $product) {
                    if ($panier->product_id == $product->id) {
                        if ($product->stock < $panier->quantity) {
                            $hs = true;
                            $panier->delete();
                        }
                        elseif ($product->status == 1) {
                            $hs = true;
                            $panier->delete();
                        }
                    }
                }
            }
            if ($hs == true) {
                $hs = true;
            } else {
                $hs = false;
            }


        return $this->showPanier($hs);
        }
        else
        {
            return redirect('login');
        }
    }

    public function showPanier($hs)
    {
        if(Auth::id())
        {
            $user = auth()->user();

            $count = Panier::where('name', $user->name)->count();

            $paniers = Panier::where('name', $user->name)->get();

            $ip = $_SERVER['SERVER_ADDR'];

            if($hs==true)
            {
                $info="Certains porduit ont été supprimer de votre panier";
                return view('panier.cart2', compact('count', 'paniers','info','ip','user'));
            }
            else
            {
                $info="";
                return view('panier.cart2', compact('count', 'paniers','info','ip','user'));
            }
        }
        else
        {
            return redirect('login');
        }
    }

    public function updatePanier(Request $request, $id="")
    {
        $request->validate([
            'quantity' ,
        ]);

        $paniers = Panier::query()->findOrFail($id);
        $paniers->quantity = $request->get('quantity');

        $paniers->update();

        return redirect('/showPanier')->with('info', 'Votre commande a été mis à jour');
    }

    public function destroyPanier()
    {
        $user = auth()->user();
        $paniers=Panier::where('name',$user->name);
        $paniers->delete();
        return redirect('/showPanier')->with('info', 'Votre panier a été vidé');
    }

    public function destroyPanierProduct($id)
    {
        $paniers = Panier::query()->findOrFail($id);
        $paniers->delete();
        return redirect('/showPanier')->with('info', 'Produit supprimé');
    }

}
