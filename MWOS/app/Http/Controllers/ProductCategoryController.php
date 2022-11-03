<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\productCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
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

            $product_category =  DB::table('product_categorys')
            ->where(DB::raw("CONCAT(id,' ',prodCategory)"),'LIKE','%'.$search.'%')
            ->paginate(4);
    $product_category->appends(['search' => $search]);
    $count = $product_category->total();
    if($count == 0)
    return view('admin.productCategory')->with(['product_category' => $product_category, 'NoFound' => 'There is no result 😔']);
    else
    return view('admin.productCategory')->with(['product_category' => $product_category,'found' => $count.' records founded']);


    
}

        else{
            $data['product_category'] = ProductCategory::orderBy('id','desc')->paginate(4);
        
            return view('admin.productCategory',$data);
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
            'prodCategory' => ['required', 'string', 'max:255'],
        ]);
        
        if($request->id)
        {

        $ProductCategory = ProductCategory::find($request->id);
        }
        else {
        $ProductCategory = new ProductCategory();
        }
                $ProductCategory->prodCategory = $request->prodCategory;
            
                $ProductCategory->save();
                return response()->json(['success' => true]);

                if ($ProductCategory->fails())
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
        $productCategory  = ProductCategory::where($where)->first();
        return response()->json($productCategory);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product_category = productCategory::where('id',$request->id)->delete();
        return response()->json(['success' => true]);
    }

}
