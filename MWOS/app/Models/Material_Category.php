<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'matCategory',
    ];
}
