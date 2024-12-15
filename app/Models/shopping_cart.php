<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shopping_cart extends Model
{
    protected $table = 'shopping_carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Menghubungkan product_id ke model Product
    }
}
