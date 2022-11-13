<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use App\Models\productCategory;
use App\Models\Materials;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
        $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();
        $filter = $request->get('filter');
        $search = $request->get('search');
        if ($search != "") {
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

<<<<<<< HEAD
            
        }
        elseif ($filter!="") {
           
                $Products =  DB::table('Products')
                ->where('prodCategory_ID',$filter)
                ->join('product_categorys', 'Products.prodCategory_ID', '=', 'product_categorys.id')
                ->join('materials', 'Products.material_ID', '=', 'materials.id')
                ->select('Products.id','Products.name','Products.image','Products.tall','Products.width','Products.height','Products.price','Products.description','materials.name as materialName','prodCategory',)
                ->paginate(4);
                $count = $Products->total(); 
                if ($count == 0) {
                    $Products = DB::table('Products')
                    ->join('product_categorys', 'Products.prodCategory_ID', '=', 'product_categorys.id')
                    ->join('materials', 'Products.material_ID', '=', 'materials.id')
                    ->select('Products.id','Products.name','Products.image','Products.tall','Products.width','Products.height','Products.price','Products.description','materials.name as materialName','prodCategory',)->paginate(4);
                    return view('admin.Products',compact('productCategory','Products','Materials'))->with('error','this category has no product !');
                }
                else{
                    return view('admin.Products',compact('productCategory','Products','Materials'));

                }
            
           
           
        }
        else{
            $Products = DB::table('Products')
            ->join('product_categorys', 'Products.prodCategory_ID', '=', 'product_categorys.id')
            ->join('materials', 'Products.material_ID', '=', 'materials.id')
            ->select('Products.id','Products.name','Products.image','Products.tall','Products.width','Products.height','Products.price','Products.description','materials.name as materialName','prodCategory',)->paginate(4);
            return view('admin.Products',compact('productCategory','Products','Materials'));
        }

        
=======


        } elseif ($filter != "") {

            $Products =  DB::table('products')
                ->where('prodCategory_id', $filter)
                ->join('product_categorys', 'products.prodCategory_id', '=', 'product_categorys.id')
                ->join('materials', 'products.material_id', '=', 'materials.id')
                ->select('products.*', 'materials.name as materialName', 'prodCategory',)
                ->paginate(4);
            $count = $Products->total();
            if ($count == 0) {
                $Products = DB::table('products')
                    ->join('product_categorys', 'Products.prodCategory_id', '=', 'product_categorys.id')
                    ->join('materials', 'Products.material_id', '=', 'materials.id')
                    ->select('products.*', 'materials.name as materialName', 'prodCategory',)
                    ->paginate(4);
                return view('admin.Products', compact('productCategory', 'Products', 'Materials'))->with('error', 'this category has no product !');
            } else {
                return view('admin.Products', compact('productCategory', 'Products', 'Materials'));
            }
        } else {
            $Products = DB::table('products')
                ->join('product_categorys', 'Products.prodCategory_id', '=', 'product_categorys.id')
                ->join('materials', 'products.material_id', '=', 'materials.id')
                ->select('products.*', 'materials.name as materialName', 'prodCategory',)
                ->paginate(4);
            return view('admin.Products', compact('productCategory', 'Products', 'Materials'));
        }
>>>>>>> d7cac7476dc386cc5f731ba48929e6be60e8972a
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
            'name' => ['required', 'string', 'max:255'],
            'prodCategory_id' => ['required'],
            'tall' => ['required'],
            'width' => ['required'],
<<<<<<< HEAD
            'hight' => ['required'],
            'price' => ['required','digits_between:0,5000'],
            'material_ID' => ['required'],
=======
            'height' => ['required'],
            'price' => ['required'],
            'material_id' => ['required'],
>>>>>>> d7cac7476dc386cc5f731ba48929e6be60e8972a
            'description' => ['required'],
        ]);

        if ($request->id) {
            $validator = Validator::make($request->all(), [
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
                'name' => ['required', 'string', 'max:255'],
                'prodCategory_id' => ['required'],
                'tall' => ['required'],
                'width' => ['required'],
<<<<<<< HEAD
                'hight' => ['required'],
                'price' => ['required','digits_between:0,5000'],
                'material_ID' => ['required'],
=======
                'height' => ['required'],
                'price' => ['required'],
                'material_id' => ['required'],
>>>>>>> d7cac7476dc386cc5f731ba48929e6be60e8972a
                'description' => ['required'],
            ]);
            $Products = Products::find($request->id);
        } else {
            $validator = Validator::make($request->all(), [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
                'name' => ['required', 'string', 'max:255'],
                'prodCategory_id' => ['required'],
                'tall' => ['required'],
                'width' => ['required'],
<<<<<<< HEAD
                'hight' => ['required'],
                'price' => ['required','digits_between:0,5000'],
                'material_ID' => ['required'],
=======
                'height' => ['required'],
                'price' => ['required'],
                'material_id' => ['required'],
>>>>>>> d7cac7476dc386cc5f731ba48929e6be60e8972a
                'description' => ['required'],
            ]);
            $Products = new Products();
        }
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->image) {
<<<<<<< HEAD
                $newImgName = time() . '-' . $request->name . '.' .$request->image->extension();
                $request->image->move(public_path('imgs\products'),$newImgName);
                $Products->image= $newImgName;
            }
                $Products->name= $request->name;
                $Products->prodCategory_id= $request->prodCategory_ID;
                $Products->tall= $request->tall;
                $Products->width= $request->width;
                $Products->height= $request->hight;
                $Products->price= $request->price;
                $Products->material_id= $request->material_ID ;
                $Products->description= $request->description;
=======
                $newImgName = time() . '-' . $request->name . '.' . $request->image->extension();
                $request->image->move(public_path('imgs\products'), $newImgName);
                $Products->image = $newImgName;
            }
            $Products->name = $request->name;
            $Products->prodCategory_id = $request->prodCategory_id;
            $Products->tall = $request->tall;
            $Products->width = $request->width;
            $Products->height = $request->height;
            $Products->price = $request->price;
            $Products->material_id = $request->material_id;
            $Products->description = $request->description;
>>>>>>> d7cac7476dc386cc5f731ba48929e6be60e8972a

            $Products->save();
            return response()->json(['status' => 1, 'msg' => 'saved successfully']);
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
        $Products = Products::where('id', $request->id)->delete();

        return response()->json(['success' => true]);
    }
}
