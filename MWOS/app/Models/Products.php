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
        'prodCategory_id',
        'tall',
        'height',
        'width',
        'price',
        'material_id',
        'description'
    ];
}
