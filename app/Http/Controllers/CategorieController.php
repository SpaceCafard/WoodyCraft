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
        $categories = Categorie::query()->findOrFail($id);
        $categories->status = 1;
        $categories->update();

        return back()->with('info','Catégorie archivé');

    }
    public function reactivedCat($id)
    {

        $categories = Categorie::query()->findOrFail($id);
        $categories->status = 0;
        $categories->update();

        return back()->with('info','produit remis en ciruclation');

    }
}
