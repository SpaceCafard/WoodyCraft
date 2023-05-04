<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['categorie_id','nameP','description','image','price','stock','status'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class);
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}

