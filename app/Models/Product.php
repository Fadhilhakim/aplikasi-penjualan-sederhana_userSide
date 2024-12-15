<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

class Product extends Model
{
    protected $table = 'products'; 
    public function sales()
    {
        return $this->hasMany(Sales::class, 'product_id');
    }
    public function orderRequests()
    {
        return $this->hasMany(OrderRequest::class);
    }
}
