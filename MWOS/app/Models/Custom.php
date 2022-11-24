<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Custom extends Model
{
    use HasFactory, SoftDeletes;
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
