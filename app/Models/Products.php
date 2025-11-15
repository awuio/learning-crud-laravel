<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity',
        'description',
    ];
}
