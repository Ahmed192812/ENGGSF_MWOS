<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Repair extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'productCategory_id',
        'image',
        'quantity',
        'payment_type',
        'status',
        'furnitureState',
        'estimatedPrice',
        'actualPrice',
        'deleted_at'
    ];
}
