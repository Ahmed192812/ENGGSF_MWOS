<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarpenterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function dashboard()
    {  
        return view('carpenter.dashboardCarpenter');

    }
}
