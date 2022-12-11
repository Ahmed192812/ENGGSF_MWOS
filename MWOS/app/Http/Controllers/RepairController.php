<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\productCategory;
use App\Models\Materials;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('product_categorys')->select('*')->orderByRaw('prodCategory')->get();
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        return view('user.Transaction.reqRepair',compact('productCategory','posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        if (Auth::user()) {
            # code...
       
        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null) {
            return view('auth.verify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code != 0) {
            return view('auth.phoneVerify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null) {
        
        $request->validate( [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
            'productCategory_id' => ['required'],
            'quantity' => ['required'],
            'furnitureState' => ['required','max:255'],
            'payment_type' => ['required'],


            
        ],
        [  
            'image.image' => "Image must be in jpeg,png,jpg,gif,svg",
            'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
            'image.required' => "An image is required",
            'productCategory_id.required' => "Please Select Product Category",
            'furnitureState.required' => "pleas write your furniture State",
       ]
    );
        $Repair = new Repair();
            $newImgName = time() . '-' . 'repair' . '.' .$request->image->extension();
            $request->image->move(public_path('imgs\products'),$newImgName);
            $Repair->image= $newImgName;
            $Repair->productCategory_id= $request->productCategory_id;
            $Repair->quantity= $request->quantity;
            $Repair->payment_type= $request->payment_type;
            $Repair->user_id= Auth::user()->id;
            $Repair->furnitureState= $request->furnitureState;

        $Repair->save();
       
        return redirect()->route('user.orders');
        }
     }
     else {
        return redirect()->back()->with(['login' => 'Please Login to Order!']);    
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        $where = array('repairs.id' => $request->id);
        $Repair  = Repair::withTrashed()->select('*','repairs.id as repairsId')
        ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')->where($where)->first();
        
        return response()->json($Repair);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair $repair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Repair::onlyTrashed()->where('repairs.id',$request->id)) {
            $Custom = Repair::onlyTrashed()->where('repairs.id',$request->id)->forceDelete();

        }
      
            $Repair = Repair::where('repairs.id',$request->id)->delete();
            return response()->json(['success' => true]);


        
    }
    public function restore(Request $request)
    {
            $Repair = Repair::where('repairs.id',$request->id)->restore();
            return redirect()->back()->with('success','restored Successfully');


        
    }
}
