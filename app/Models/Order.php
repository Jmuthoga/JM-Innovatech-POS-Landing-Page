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

        //  PERSONAL DETAILS (user snapshot)
        'first_name',
        'last_name',
        'email',
        'phone',

        //  SHIPPING DETAILS (NEW)
        'shipping_name',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_county',
        'shipping_town',

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
