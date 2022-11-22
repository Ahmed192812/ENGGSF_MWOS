<?php

namespace App\Http\Controllers;
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
}
