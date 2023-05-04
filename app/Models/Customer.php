<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';

    protected $fillable = ['forname','surname','add1','add2','add3','postcode','phone','email'];


    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}

