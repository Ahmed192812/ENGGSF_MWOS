<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
}
