<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart'; // Explicitly specify the table name

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'price',
        'totalPrice'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,"product_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }


}
