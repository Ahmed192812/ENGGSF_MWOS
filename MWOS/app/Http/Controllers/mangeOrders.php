<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\Order;
use App\Models\Repair;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mangeOrders extends Controller
{
    public function index()
    {
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();
        $orders =DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('*','orders.id as orderId')->get();
        $customs =DB::table('customs')
        ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
        ->join('materials', 'customs.material_id', '=', 'materials.id')
        ->select('*','customs.id as CustomId')->get();
        $repairs =DB::table('repairs')
        ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
        ->select('*','repairs.id as repairsId')->get();
        return view('admin.orders', compact('customs','orders','repairs','productCategory','Materials'));
    }
    public function store(Request $request)
    {
        // dd('repair'.$request->repairsId,'custom'.$request->CustomId,'order'.$request->orderId);

        if($request->repairsId >0)
        {
            // dd('repair',$request->repairsId);

        $Repair  =  Repair::find($request->repairsId);
        if( $request->size !==null && $request->price ==null ){
            $Repair->estimatedPrice = $request->size;
            $Repair->actualPrice = NULL;
        }
        elseif ($request->price !==null && $request->size == null) {
            $Repair->actualPrice = $request->price;
            $Repair->estimatedPrice = NULL;
        }
       else{
        $Repair->actualPrice = $request->price;
        $Repair->estimatedPrice = NULL;
       
       }
        $Repair->status = $request->status;

         $Repair->save();

        }
        elseif ($request->CustomId >0) {
        $Custom  =  Custom::find($request->CustomId);
        
            $Custom->price = $request->price;
            $Custom->quantity = $request->quantity;
            $Custom->status= $request->status;

         $Custom->save();
        }
        elseif($request->orderId >0){
                //  dd('order',$request->orderId);
        $Order  =  Order::find($request->orderId);
        
        $Order->quantity = $request->quantity;
        $Order->status= $request->status;

        $Order->save();
        }
       
           
        
            return response()->json(['status'=>1,'msg'=>'saved successfully']);
        
       
            
           

        
    }
}
