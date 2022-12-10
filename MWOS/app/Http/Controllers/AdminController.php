<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Custom;
use App\Models\Repair;
use App\Models\Materials;
use App\Models\Products;
use App\Models\productCategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $Users  = User::all()
            ->where('role', '2')->count();
        $Materials = Materials::all()->count();
        $Products = Products::all()->count();
        $Custom = Custom::all()->count();
        $Repair = Repair::all()->count();
        $Order = Order::all()->count();
        $AllOrders = $Order + $Repair + $Custom;

        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null) {
            return view('auth.verify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code != 0) {
            return view('auth.phoneVerify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null) {
            return view('admin.dashboardAdmin', compact('AllOrders', 'Products', 'Materials', 'Users'));
        } else {
            dd($AllOrders);
            return view('admin.dashboardAdmin', compact('AllOrders', 'Products', 'Materials', 'Users'));
        }
    }
}
