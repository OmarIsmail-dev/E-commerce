<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'price',
        'action',
        'order_status',
        'created_at'
    ];

 public function getPriceAttribute($value)
{
    return number_format($value, 0, '', '');  // يقوم بحذف الأجزاء العشرية
}



    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }


}
