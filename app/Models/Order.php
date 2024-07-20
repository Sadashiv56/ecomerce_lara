<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = "orders";

    protected $fillable = [
        'first_name', 'last_name', 'email', 'country', 'address',
        'city', 'state', 'zip', 'mobile', 'order_notes',
        'subtotal', 'shipping', 'total', 'payment_status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
