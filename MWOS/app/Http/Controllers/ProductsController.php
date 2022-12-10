<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use App\Models\productCategory;
use App\Models\Materials;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null) {
            return view('auth.verify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code != 0) {
            return view('auth.phoneVerify');
        } elseif (Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null) {

            $productCategory  = DB::table('product_categorys')->select('id as productCategoryId', 'prodCategory')->get();
            $Materials  = DB::table('Materials')->select('id as MaterialsId', 'name')->get();
            $filter = $request->get('filter');
            $search = $request->get('search');
            if ($filter != "") {
                $Products =  DB::table('Products')
                    ->where('prodCategory_id', $filter)
                    ->join('product_categorys', 'Products.prodCategory_id', '=', 'product_categorys.id')
                    ->join('materials', 'Products.material_id', '=', 'materials.id')
                    ->select('Products.id', 'Products.name', 'Products.image', 'Products.tall', 'Products.width', 'Products.height', 'Products.price', 'Products.description', 'materials.name as materialName', 'prodCategory',)
                    ->paginate(10);
                $count = $Products->total();
                if ($count == 0) {
                    $Products = DB::table('Products')
                        ->join('product_categorys', 'Products.prodCategory_id', '=', 'product_categorys.id')
                        ->join('materials', 'Products.material_id', '=', 'materials.id')
                        ->select('Products.id', 'Products.name', 'Products.image', 'Products.tall', 'Products.width', 'Products.height', 'Products.price', 'Products.description', 'materials.name as materialName', 'prodCategory',)->paginate(10);
                    return view('admin.Products', compact('productCategory', 'Products', 'Materials'))->with('error', 'this category has no product !');
                } else {
                    return view('admin.Products', compact('productCategory', 'Products', 'Materials'));
                }
            } else {
                $Products = DB::table('Products')
                    ->join('product_categorys', 'Products.prodCategory_id', '=', 'product_categorys.id')
                    ->join('materials', 'Products.material_id', '=', 'materials.id')
                    ->select('Products.id', 'Products.name', 'Products.image', 'Products.tall', 'Products.width', 'Products.height', 'Products.price', 'Products.description', 'materials.name as materialName', 'prodCategory',)->paginate(10);
                return view('admin.Products', compact('productCategory', 'Products', 'Materials'));
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
        if ($request->id) {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
                    'name' => ['required', 'string', 'max:50'],
                    'prodCategory_id' => ['required'],
                    'tall' => ['required'],
                    'width' => ['required'],
                    'height' => ['required'],
                    'price' => ['required', 'digits_between:0,5000'],
                    'material_id' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'image.image' => "Image must be in jpeg,png,jpg,gif,svg",
                    'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
                    'image.required' => "An image is required",
                    'prodCategory_id.required' => "Please Select Product Category",
                    'material_id.required' => "Please Select Material",
                    'tall.required' => "Length is required",
                    'width' => "Width is required",
                    'height' => "Height is required",
                    'price' => "Price is required",
                    'description' => "Description is required",
                ]
            );
            $Products = Products::find($request->id);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
                    'name' => ['required', 'string', 'max:50'],
                    'prodCategory_id' => ['required'],
                    'tall' => ['required'],
                    'width' => ['required'],
                    'height' => ['required'],
                    'price' => ['required', 'digits_between:0,5000'],
                    'material_id' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'image.image' => "Image must be in jpeg,png,jpg,gif,svg",
                    'image.mimes' => "Image must be in jpeg,png,jpg,gif,svg",
                    'image.required' => "An image is required",
                    'name.required' => "Product name is required",
                    'prodCategory_id.required' => "Please Select Product Category",
                    'material_id.required' => "Please Select Material",
                    'tall.required' => "Length is required",
                    'width' => "Width is required",
                    'height' => "Height is required",
                    'price' => "Price is required",
                    'description' => "Description is required",
                ]
            );
            $Products = new Products();
        }
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->image) {

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
