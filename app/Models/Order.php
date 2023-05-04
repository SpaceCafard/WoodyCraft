<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['payment_id','status'];

    use HasFactory;
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
