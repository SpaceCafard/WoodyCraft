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
        $user = auth()->user();
        return view('admin.categorie.indexCat', compact('categories','user'));
    }

    public function createCat()
    {
        $user = auth()->user();
        $categories = Categorie::all();
        return view('admin.categorie.createCat', compact('categories','user'));
    }


    public function storeCat(Request $request)
    {
        $request->validate([
            'name' => 'required',



        ]);

        $categories = new Categorie([
            'name' => $request->get('name'),

        ]);
        $categories->status = 0;
        $categories->save();
        return redirect('/admin/categorie')->with('info', 'Categorie ajouté avec succès');
    }

    public function editCat($id)
    {
        $categories = Categorie::query()->findOrFail($id);
        $user = auth()->user();
        return view('admin.categorie.editCat', compact('categories','user'));
    }

    public function updateCat(Request $request, $id)
    {
        $request->validate([

            'name',


        ]);



        $categories = Categorie::query()->findOrFail($id);
        $categories->name = $request->get('name');



        $categories->update();

        return redirect('/admin/categorie')->with('info', 'Categorie ajouté avec succès');
    }


    public function destroyCat($id)
    {
        $categories = Categorie::query()->findOrFail($id);
        $categories->status = 1;
        $categories->update();

        return back()->with('info','Catégorie archivée');

    }
    public function reactivedCat($id)
    {

        $categories = Categorie::query()->findOrFail($id);
        $categories->status = 0;
        $categories->update();

        return back()->with('info','Catégorie réactivée');

    }
}
