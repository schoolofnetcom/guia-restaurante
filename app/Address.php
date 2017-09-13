<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['cep', 'address', 'number', 'city', 'neighborhood', 'state', 'complement'];

    public function restaurant()
    {
        return $this->belongsTo(\App\Restaurant::class);
    }
}
