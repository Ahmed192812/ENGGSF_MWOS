<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'productCategory_id',
        'image',
        'furnitureState',
        'estimatedPrice',
        'actualPrice'
    ];
}
