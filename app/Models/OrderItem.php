<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $table = "order_items";

    protected $fillable = ['order_id', 'product_name', 'quantity', 'price', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
