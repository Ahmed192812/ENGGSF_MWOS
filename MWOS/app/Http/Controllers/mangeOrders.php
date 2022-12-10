<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\Order;
use App\Models\Repair;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mangeOrders extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users as us', 'orders.user_id', '=', 'us.id')
            ->select('*', 'orders.id as orderId', 'orders.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('orders.status',"!=","TBR")
            ->where('orders.status',"!=","Declined")  
            ->where('orders.deleted_at', "=", NULL)          
            ->orderByDesc('date')
            ->get();

        $customs = DB::table('customs')
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->join('users as us', 'customs.user_id', '=', 'us.id')
            ->select('*', 'customs.id as CustomId', 'customs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('customs.status',"!=","TBR")
            ->where('customs.status',"!=","Declined")
            ->where('customs.deleted_at', "=", NULL)  
            ->orderByRaw('date')
            ->get();

        $repairs = DB::table('repairs')
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->join('users as us', 'repairs.user_id', '=', 'us.id')
            ->select('*', 'repairs.id as repairsId', 'repairs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('repairs.status',"!=","TBR")
            ->where('repairs.status',"!=","Declined")
            ->where('repairs.deleted_at', "=", NULL)  
            ->orderByRaw('date')
            ->get();

        return view('admin.orders', compact('customs', 'orders', 'repairs', 'productCategory', 'Materials', 'input'));
    }

    public function requests(Request $request)
    {
        $input = $request->input('input');
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users as us', 'orders.user_id', '=', 'us.id')
            ->select('*', 'orders.id as orderId', 'orders.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('orders.status', "TBR")
            ->orderByDesc('date')
            ->get();

        $customs = DB::table('customs')
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->join('users as us', 'customs.user_id', '=', 'us.id')
            ->select('*', 'customs.id as CustomId', 'customs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('customs.status', "TBR")
            ->orderByRaw('date')
            ->get();

        $repairs = DB::table('repairs')
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->join('users as us', 'repairs.user_id', '=', 'us.id')
            ->select('*', 'repairs.id as repairsId', 'repairs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->where('repairs.status', "TBR")
            ->orderByRaw('date')
            ->get();

        return view('admin.requests', compact('customs', 'orders', 'repairs', 'productCategory', 'Materials', 'input'));
    }

    public function viewPdfPage()
    {
        return view('admin.orderPdfPage');
    }

    public function generatePdfAllOrders()
    {
        $sumOrderPrice = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.status', 'done')
            ->sum(DB::raw('products.price * orders.quantity'));

        $sumCustomPrice = Custom::where('status', 'done')
            ->sum(DB::raw('customs.price * customs.quantity'));

        $sumRepairPrice = Repair::where('status', 'done')
            ->sum('repairs.actualPrice');

        $orders = Order::select('*', 'orders.id as orderId')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('status', 'done')
            ->get();

        $customs = Custom::select('*', 'customs.id as CustomId')
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->where('status', 'done')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->get();

        $repairs = Repair::select('*', 'repairs.id as repairsId')
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->where('status', 'done')
            ->get();

        view()->share('admin.PDFs.pdfOrders', $repairs, $customs, $orders, $sumOrderPrice, $sumCustomPrice, $sumRepairPrice);
        $customPaper = array(0, 0, 567.00, 800.80);

        $pdf = PDF::loadView('admin.PDFs.pdfOrders', compact('repairs', 'customs', 'orders', 'sumOrderPrice', 'sumCustomPrice', 'sumRepairPrice'))->setPaper($customPaper, 'landscape');

        return $pdf->download('MWOSPDF.pdf');
    }

    public function archives(Request $request)
    {
        $input = $request->input('input');
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();

        $orders = Order::onlyTrashed()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users as us', 'orders.user_id', '=', 'us.id')
            ->select('*', 'orders.id as orderId', 'orders.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->get();
        $customs = Custom::onlyTrashed()
            ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
            ->join('materials', 'customs.material_id', '=', 'materials.id')
            ->join('users as us', 'customs.user_id', '=', 'us.id')
            ->select('*', 'customs.id as CustomId', 'customs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->get();
        $repairs = Repair::onlyTrashed()
            ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
            ->join('users as us', 'repairs.user_id', '=', 'us.id')
            ->select('*', 'repairs.id as repairsId', 'repairs.created_at as date', 'us.Fname as fname', 'us.Lname as lname', 'us.phoneNumber as mobile')
            ->get();

        return view('admin.orders', compact('customs', 'orders', 'repairs', 'productCategory', 'Materials', 'input'));
    }

    public function store(Request $request)
    {
        // dd('repair'.$request->repairsId,'custom'.$request->CustomId,'order'.$request->orderId);

        if ($request->repairsId > 0) {
            // dd('repair',$request->repairsId);

            $Repair  =  Repair::find($request->repairsId);
            if ($request->size !== null && $request->price == null) {
                $Repair->estimatedPrice = $request->size;
                $Repair->actualPrice = NULL;
            } elseif ($request->price !== null && $request->size == null) {
                $Repair->actualPrice = $request->price;
                $Repair->estimatedPrice = NULL;
            } else {
                $Repair->actualPrice = $request->price;
                $Repair->estimatedPrice = NULL;
            }
            $Repair->status = $request->status;

            $Repair->save();
        } elseif ($request->CustomId > 0) {
            $Custom  =  Custom::find($request->CustomId);

            $Custom->price = $request->price;
            $Custom->quantity = $request->quantity;
            $Custom->status = $request->status;

            $Custom->save();
        } elseif ($request->orderId > 0) {
            //  dd('order',$request->orderId);
            $Order  =  Order::find($request->orderId);

            $Order->quantity = $request->quantity;
            $Order->status = $request->status;

            $Order->save();
        }

        return response()->json(['status' => 1, 'msg' => 'saved successfully']);
    }

    public function destroy()
    {
    }
}
