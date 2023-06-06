<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Panier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class IndexController extends Controller
{

    public function home()
    {
        if(Auth::id()) {
            $user = auth()->user();
            $count = Panier::where('name', $user->name)->count();
            $products = Product::inRandomOrder()->where('status', 0)->limit(3)->get();
            $ip = $_SERVER['SERVER_ADDR'];
            return view('home', compact('user','count','products','ip'));
        }
        else{
            $products = Product::inRandomOrder()->limit(3)->get();
        return view('home', compact('products'));
        }
    }

    public function index($name = null)
    {
        $query = $name ? Categorie::whereName($name)->firstOrFail()->products() : Product::query();
        $products = $query->oldest('nameP')->paginate(5);
        $categories = Categorie::all();

        if(Auth::id()) {
            if (auth()->user()->is_admin == 1) {
                $user = auth()->user();
                return view('admin.indexAdmin', compact('products','name','categories','user'));
            }
            $user = auth()->user();
            $count = Panier::where('name', $user->name)->count();
            return view('produit.index', compact('products','name','categories','count','user'));
        }
        return view('produit.index', compact('products','name','categories'));

    }


    public function show(Product $product)
    {

        $categories = $product->categorie->name;

        if(Auth::id()) {
            $user = auth()->user();
            $count = Panier::where('name', $user->name)->count();
            $ip = $_SERVER['SERVER_ADDR'];
            return view('produit.show', compact('product','categories','count','ip'));
        }
        $ip = $_SERVER['SERVER_ADDR'];
        return view('produit.show', compact('product', 'categories','ip'));
    }


    public function create()
    {
        $categories = Categorie::all();
        $user = auth()->user();
        return view('admin.create', compact('categories','user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameP' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'categorie_id' => 'required',
            'stock'  => 'required'
        ]);

        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension(NULL);
            $request->image->move(public_path('image'), $imageName);
        }

        $products = new product([
            'nameP' => $request->get('nameP'),
            'description' => $request->get('description'),

            'price' => $request->get('price'),
            'categorie_id' => $request->get('categorie_id'),
            'stock' => $request->get('stock')
        ]);

        if($request->has('image')){
            $products->image = ("/image/".$imageName);
        }
        $products->status=0;


        $products->save();
        return redirect('/products')->with('info','Produit crée');
    }

    public function edit($id)
    {
        $products = Product::query()->findOrFail($id);
        $ip = $_SERVER['SERVER_ADDR'];
        $categories = Categorie::all();
        $user = auth()->user();
        return view('admin.edit', compact('categories','products','ip','user'));
    }


    /**
     * Enregistre la modification dans la base de données
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nameP' ,
            'description',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price',
            'categorie_id',
            'stock'

        ]);
        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension(NULL);
            $request->image->move(public_path('image'), $imageName);
        }

        $products = Product::query()->findOrFail($id);
        $products->nameP = $request->get('nameP');
        $products->description = $request->get('description');
        if($request->has('image')){
            $products->image = ("/image/".$imageName);
        }
        $products->price = $request->get('price');
        $products->categorie_id = $request->get('categorie_id');
        $products->stock = $request->get('stock');


        $products->update();

        return redirect('/products');

    }

    public function destroy($id)
    {

        $products = Product::query()->findOrFail($id);
        $products->status = 1;
        $products->update();

        return back()->with('info','produit archivé : ' . $products->nameP);

    }

    public function reactived($id)
    {

        $products = Product::query()->findOrFail($id);
        if ($products->categorie->status == 0) {
            $products->status = 0;
            $products->update();
            return back()->with('info','Produit remis en ciruclation');
        }
        else{
            return back()->with('info','Le produit ne peut-etre remis en circulation car la catégorie associé : '. $products->categorie->name . ' est désactivée');
        }



    }




}

