<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'description',
    //     'price',
    //     'offer',
    //     'image',
    //     'stock',
    //     'category_id',
    //     "brand",
    //     "size_shoes",
    //     "size_clothes",
    //     "color",
    //     "description"

    // ];
    protected $guarded = [];

    // لو جدولك مش فيه created_at / updated_at
    public $timestamps = false;

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "product_id");
    }


}
