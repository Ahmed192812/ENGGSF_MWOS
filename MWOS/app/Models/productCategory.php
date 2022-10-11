<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productCategory extends Model
{
    public $table = 'product_categorys';
    use HasFactory;

    protected $fillable = [
        'prodCategory',
    ];
}
