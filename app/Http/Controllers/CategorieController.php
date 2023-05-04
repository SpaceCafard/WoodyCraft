<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;

class CategorieController extends Controller
{
    public function indexCat()
    {
        $categories = Categorie::all();
        return view('admin.categorie.indexCat', compact('categories'));
    }

    public function createCat()
    {
        $categories = Categorie::all();
        return view('admin.categorie.createCat', compact('categories'));
    }


    public function storeCat(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension(NULL);
            $request->image->move(public_path('image'), $imageName);
        }



        $categories = new Categorie([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        if($request->has('image')){
            $categories->image = ("/image/".$imageName);
        }




        $categories->save();
        return redirect('/admin/categorie')->with('info', 'Categorie ajouté avec succès');
    }

    public function editCat($id)
    {
        $categories = Categorie::query()->findOrFail($id);
        return view('admin.categorie.editCat', compact('categories'));
    }

    public function updateCat(Request $request, $id)
    {
        $request->validate([

            'name',
            'description',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension(NULL);
            $request->image->move(public_path('image'), $imageName);
        }


        $categories = Categorie::query()->findOrFail($id);
        $categories->name = $request->get('name');
        $categories->description = $request->get('description');
        if($request->has('image')){
            $categories->image = ("/image/".$imageName);
        }

        $categories->update();

        return redirect('/admin/categorie')->with('info', 'Categorie ajouté avec succès');
    }

    public function showCat($id)
    {
        $categories = Categorie::query()->findOrFail($id);
        return view('admin.categorie.showCat', compact('categories'));
    }

    public function destroyCat($id)
    {
        $products= Product::all();
        $categories = Categorie::query()->findOrFail($id);
        foreach($products as $product)
        {
            if($product->categorie_id==$id)
            {
                return back()->with('info', "Impossible car des produits sont toujours associé à cette organisation, Liquidé d'abord les membres de l'organisation pour en entreprendre le demantelement ");
            }
        }
        $allegeances->delete();

        return back()->with('info', 'Allégeance neutralisé avec succès');
    }
}
