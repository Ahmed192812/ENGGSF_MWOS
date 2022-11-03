<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Materials;

use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        if($search!=""){
            $Materials =  DB::table('Materials')
            ->where(DB::raw("CONCAT(id,' ',name,' ',costPerUnit)"),'LIKE','%'.$search.'%')
            ->paginate(4);
    $Materials->appends(['search' => $search]);
    $count = $Materials->total();
    if($count == 0)
    return view('admin.Material')->with(['Materials' => $Materials, 'NoFound' => 'There is no result 😔']);
    else
    return view('admin.Material')->with(['Materials' => $Materials,'found' => $count.' records founded']);


    
}

else{
    $data['Materials'] = Materials::orderBy('id','desc')->paginate(4);
   
    return view('Admin.Material',$data);
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'costPerUnit' => ['required', 'numeric'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:5048'],

        ]);
        $newImgName = time() . '-' . $request->name . '.' .$request->image->extension();
        $request->image->move(public_path('imgs\materials'),$newImgName);
        if($request->id)
        {
        $Materials  =  Materials::find($request->id);
        }
        else{
        $Materials = new Materials();
        }
       
               $Materials->name = $request->name;
               $Materials->costPerUnit= $request->costPerUnit;
               $Materials->image = $newImgName;

                $Materials->save();
                  
    
                 return response()->json(['success' => true]);
                 if ($Materials->fails())
                    {
                        return response()->json(['error' => true]);
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
        $Materials = Materials::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }
}
