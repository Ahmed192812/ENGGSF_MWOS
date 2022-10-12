<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'prodCategory_ID',
        'tall',
        'hight',
        'width',
        'priceFull',
        'priceDp',
        'material_ID',
        'description',
        'rating',
    ];
}
