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

class CarpenterController extends Controller
{
    
   
    public function dashboard()
    {  
        $ordersTableCom = Order::select('*', 'orders.id as orderId', 'orders.created_at as date')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('status','done')
        ->orderByDesc('date')
        ->get();
        $customsTableCom = Custom::select('*', 'customs.id as CustomId', 'customs.created_at as date')
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->where('status','done')
            ->orderByRaw('date')
            ->get();
            $repairsTableCom = Repair::select('*', 'repairs.id as repairsId', 'repairs.created_at as date')
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->where('status','done')
            ->orderByRaw('date')
            ->get();
 $ordersTable = Order::select('*', 'orders.id as orderId', 'orders.created_at as date')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('status','TBR')
            ->orderByDesc('date')
            ->get();

        $customsTable = Custom::select('*', 'customs.id as CustomId', 'customs.created_at as date')
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->where('status','TBR')
            ->orderByRaw('date')
            ->get();

        $repairsTable = Repair::select('*', 'repairs.id as repairsId', 'repairs.created_at as date')
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->where('status','TBR')
            ->orderByRaw('date')
            ->get();
        $Users  = User::all()
        ->where('role','2')->count();
$Materials =Materials::all()->count();
$Products =Products::all()->count();
$Custom =Custom::all()->count();
$Repair =Repair::all()->count();
$Order =Order::all()->count();
$AllOrders = $Order+$Repair+$Custom;


        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null ) {
            return view('auth.verify');
             }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code != 0){
            return view('auth.phoneVerify');
        }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null){
            return view('admin.dashboardAdmin',compact('AllOrders','Products','Materials','Users','ordersTable','customsTable','repairsTable','ordersTableCom','customsTableCom','repairsTableCom'));

        }
        else{
           
            return view('admin.dashboardAdmin',compact('AllOrders','Products','Materials','Users','ordersTable','customsTable','repairsTable','ordersTableCom','customsTableCom','repairsTableCom'));
        }

    }
}
