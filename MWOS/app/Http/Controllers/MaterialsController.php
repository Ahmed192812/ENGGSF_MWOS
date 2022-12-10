<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Materials;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MaterialsController extends Controller
{
   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null ) {
            return view('auth.verify');
             }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code != 0){
            return view('auth.phoneVerify');
        }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null){
            $search = $request->get('search');
        
            if($search!=""){
                $Materials =  DB::table('Materials')
                ->where(DB::raw("CONCAT(id,' ',name,' ',costPerUnit)"),'LIKE','%'.$search.'%')
                ->paginate(10);
        $Materials->appends(['search' => $search]);
        $count = $Materials->total();
        if($count == 0)
        return view('admin.Material')->with(['Materials' => $Materials, 'NoFound' => 'There is no result 😔']);
        else
        return view('admin.Material')->with(['Materials' => $Materials,'found' => $count.' records founded']);
    
    
        
    }
    
    else{
        $data['Materials'] = Materials::orderBy('id','desc')->paginate(10);
       
        return view('Admin.Material',$data);
    }

        }

        

    }
    
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
       
        if($request->id)
        {
            $validator= Validator::make($request->all(),[
                'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:5048'],
                'name' => ['required', 'string', 'max:50'],
                'costPerUnit' => ['required', 'numeric'],
    
            ],
            [  
                'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
                'name.required' => "Material name is required",
                'costPerUnit.required' => "Cost per unit is required",
           ]
        );
           
        $Materials  =  Materials::find($request->id);
        }
        else{
            $validator= Validator::make($request->all(),[
                'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:5048'],
                'name' => ['required', 'string', 'max:255'],
                'costPerUnit' => ['required', 'numeric'],
    
            ],
            [  
                'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
                'image.required' => "An image is required",
                'name.required' => "Material name is required",
                'costPerUnit.required' => "Cost per unit is required",
           ]
        );
           
        $Materials = new Materials();
        }
        if (!$validator->passes()) {
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }
        else{
            if ($request->image) {
                $newImgName = time() . '-' . $request->name . '.' .$request->image->extension();
                $request->image->move(public_path('imgs\materials'),$newImgName);
                $Materials->image = $newImgName;
                        }
           
            $Materials->name = $request->name;
            $Materials->costPerUnit= $request->costPerUnit;
            
            
           

             $Materials->save();
             return response()->json(['status'=>1,'msg'=>'saved successfully']);
        }
       
                  
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $Materials  = Materials::where($where)->first();
        
        return response()->json($Materials);
        
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    //    $MaterialsCount = Materials::count();
    try {
        $Materials = Materials::where('id',$request->id)->delete();

    } catch (\Exception $th) {
        return response()->json(['success' => true, 'statuse'=>2]);
    }
    return response()->json(['success' => true , 'statuse'=>1]);

        // $Materials= Materials::count();
        // if ($Materials==$MaterialsCount) {
        // }
        // else{

        // }
    }
}
