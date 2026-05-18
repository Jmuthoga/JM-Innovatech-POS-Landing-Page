<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'invoice_number',
        'status',
        'payment_method',
        'payment_status',
        'delivery_status',
        'subtotal',
        'shipping_fee',
        'discount_applied',
        'total_order_amount',
        'shipping_paid',
        'amount_due_on_delivery',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'county',
        'town',
        'customer_note',
        'promo_used'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
