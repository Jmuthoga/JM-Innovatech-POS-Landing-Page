<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'features',
        'new_price',
        'old_price',
        'stock',
        'image',
        'thumbnails',
        'variants',
        'flash_sale_ends',
        'is_hot_deal',
        'is_pos_equipment',
        'is_supply_item',
        'is_toner'
    ];

    protected $casts = [
        'thumbnails' => 'array',
        'variants' => 'array',
        'flash_sale_ends' => 'datetime',
        'is_hot_deal' => 'boolean',
        'is_pos_equipment' => 'boolean',
        'is_supply_item' => 'boolean',
        'is_toner' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->slug = Str::slug($model->name) . '-' . rand(100, 999));
    }
}
