<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'productCategory_id',
        'image',
        'quantity',
        'description',
        'price',
        'material_id',
        'payment_type',
        'status',
        'desiredMaterial'
    ];
}
