<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'features'
    ];

    protected $casts = [
        'features' => 'array'
    ];
}
