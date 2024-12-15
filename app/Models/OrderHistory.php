<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'order_history';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_name',
        'user_email',
        'order_date',
        'total_quantity',
        'total_price',
        'status',
        'payment',
        'products_order',
    ];

    // Ubah kolom JSON menjadi array secara otomatis
    protected $casts = [
        'products_order' => 'array',
        'order_date' => 'date', // Carbon instance untuk date
    ];
}
