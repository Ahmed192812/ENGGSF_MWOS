<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\productCategory;
use App\Models\Materials;




class ProductsController extends Controller
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
        $productCategory  =DB::table('product_categorys')->select('id as productCategoryId','prodCategory')->get(); 
        $Materials  = DB::table('Materials')->select('id as MaterialsId','name')->get();
        $search = $request->get('search');
                if($search!=""){
            //         $Products =  DB::table('Products')
            //         ->join('airlines', 'flights.AirlineId', '=', 'airlines.id')
            //         ->select('flights.*', 'airlines.name', 'airlines.country','airlines.logo')
            //         ->where(DB::raw("CONCAT(flights.id,' ',flights.flightDesignator,' ',airlines.country,' ',airlines.name,' ',flights.departureFrom,' ',flights.arriveTo,' ',flights.departureTime,' ',flights.ArrivalTime)"),'LIKE','%'.$search.'%')
            //         ->paginate(4);
            // $flights->appends(['search' => $search]);
            // $count = $flights->total();
            // if($count == 0)
            // return view('admin.flights')->with(['flights' => $flights,'airline' => $airline, 'NoFound' => 'There is no result 😔']);
            // else
            // return view('admin.flights')->with(['flights' => $flights,'airline' => $airline,'found' => $count.' records founded']);
        

            
        }
        else{
            $Products = DB::table('Products')
            ->join('product_categorys', 'Products.prodCategory_ID', '=', 'product_categorys.id')
            ->join('materials', 'Products.material_ID', '=', 'materials.id')
            ->select('Products.id','Products.name','Products.image','Products.tall','Products.width','Products.hight','Products.priceFull','Products.priceDp','Products.description','materials.name as materialName','prodCategory',)->paginate(7);
            return view('admin.Products',compact('productCategory','Products','Materials'));
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
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:5048'],
            'name' => ['required', 'string', 'max:255'],
            'prodCategory_ID' => ['required'],
            'tall' => ['required'],
            'width' => ['required'],
            'hight' => ['required'],
            'priceFull' => ['required'],
            'priceDp' => ['required'],
            'material_ID' => ['required'],
            'description' => ['required'],



        ]);
        $newImgName = time() . '-' . $request->name . '.' .$request->image->extension();
        $request->image->move(public_path('imgs\products'),$newImgName);
        if($request->id)
        {
        $Products = Products::find($request->id);
        }
        else {
        $Products = new Products();
        }
                $Products->image = $newImgName;
                $Products->name= $request->name;
                $Products->prodCategory_ID= $request->prodCategory_ID;
                $Products->tall= $request->tall;
                $Products->width= $request->width;
                $Products->hight= $request->hight;
                $Products->priceFull= $request->priceFull;
                $Products->priceDp= $request->priceDp;
                $Products->material_ID= $request->material_ID;
                $Products->description= $request->description;

                $Products->save();
                return response()->json(['success' => true]);

                if ($Products->fails())
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
        $Products  = Products::where($where)->first();
 
        return response()->json($Products);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Products = Products::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }
}
