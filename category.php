<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
  
     public function products()
    {
        return $this->hasMany(Product::class);
    }


    protected $fillable = [

        'name',

    ];

}
