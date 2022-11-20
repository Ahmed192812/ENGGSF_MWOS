<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'custom_id',
        'repair_id',
        'payment_type',
        'status',
        'rating',
        'review'
    ];
}
