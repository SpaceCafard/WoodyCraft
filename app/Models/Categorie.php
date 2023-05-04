<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','description','image','status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

