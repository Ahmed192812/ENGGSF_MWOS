<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;
    protected $fillable = [
        'productCategory_id',
        'image',
        'state',
        'fix',
        'price',
        'material_id'
    ];
}
