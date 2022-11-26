<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\productCategory;
use App\Models\Materials;
use Illuminate\Support\Facades\Auth;

class CustomController extends Controller
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
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();
        return view('user.Transaction.reqCustom',compact('productCategory','Materials','posts'));

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
        } 
        elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code != 0) {
            return view('auth.phoneVerify');
        } 
        elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null) {
        

        $request->validate( [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
                'productCategory_id' => ['required'],
                'material_id' => ['required'],
                'desiredMaterial' => ['required'],
                'description' => ['required'],
                'payment_type' => ['required'],
                'quantity' => ['required'],


                
            ],
            [  
                'image.image' => "Image must be in jpeg,png,jpg,gif,svg",
                'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
                'image.required' => "An image is required",
                'productCategory_id.required' => "Please Select Product Category",
                'material_id.required' => "Please Select Material",
                'desiredMaterial.required' => "pleas write your desired material ",
                'description.required' => "pleas  write description",
           ]
        );
            $Custom = new Custom();
                $newImgName = time() . '-' . 'custom' . '.' .$request->image->extension();
                $request->image->move(public_path('imgs\products'),$newImgName);
                $Custom->image= $newImgName;
                $Custom->productCategory_id= $request->productCategory_id;
                $Custom->material_id= $request->material_id;
                $Custom->quantity= $request->quantity;
                $Custom->payment_type= $request->payment_type;
                $Custom->user_id= Auth::user()->id;
                $Custom->desiredMaterial= $request->desiredMaterial;
                $Custom->description= $request->description;

            $Custom->save();
           
            return redirect()->route('user.orders');
    }
}else {
    return redirect()->back()->with(['login' => 'pleas log in to order']);    
}



        
    }
   
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function show(Custom $custom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        $where = array('customs.id' => $request->id);
        $custom  = custom::withTrashed()->select('*','customs.image as customImage','customs.id as CustomId')
        ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
        ->join('materials', 'customs.material_id', '=', 'materials.id')
        ->where($where)->first();
        
        return response()->json($custom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Custom $custom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Custom::onlyTrashed()->where('customs.id',$request->id)) {
            $Custom = Custom::onlyTrashed()->where('customs.id',$request->id)->forceDelete();

        }
        $Custom = Custom::where('customs.id',$request->id)->delete();
        return response()->json(['success' => true]);

        
    }
    public function restore(Request $request)
    {
        
        $Custom = Custom::where('customs.id',$request->id)->restore();
        return redirect()->back();

        
    }
}
