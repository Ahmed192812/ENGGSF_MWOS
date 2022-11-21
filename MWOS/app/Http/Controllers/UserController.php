<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
   
    


    // Navbar
    public function home()
    {
        
        if (Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at == null ) {
            return view('auth.verify');
             }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code != 0){
            return view('auth.phoneVerify');
        }
        elseif(Auth::user()->verifiedBy == 2 && Auth::user()->code == 0 || Auth::user()->verifiedBy == 1 && Auth::user()->email_verified_at !== null){

        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.View.viewHome', compact('posts'));
        }
    }

    public function repair()
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.Transaction.reqRepair', compact('posts'));
    }

    public function custom()
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.Transaction.reqCustom', compact('posts'));
    }

    public function catalog(Request $request)
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        $search = $request->input('category');

        $filter = DB::table('products')
            ->join('product_categorys', 'prodCategory_ID', '=', 'product_categorys.id')
            ->where('product_Categorys.prodCategory', 'LIKE', $search)
            ->select('products.*', 'productS.prodCategory_ID as categ')
            ->get();

        return view('user.Transaction.reqCatalog', compact('filter', 'posts'));
    }

    public function orders()
    {
        $orders =DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('*','orders.id as orderId')
        ->where('user_id',Auth::user()->id)->get();

        
       
        $customs =DB::table('customs')
        ->join('product_categorys', 'customs.productCategory_id', '=', 'product_categorys.id')
        ->join('materials', 'customs.material_id', '=', 'materials.id')
        ->select('*','customs.id as CustomId')
        ->where('user_id',Auth::user()->id)->get();
        $repairs =DB::table('repairs')
        ->join('product_categorys', 'repairs.productCategory_id', '=', 'product_categorys.id')
        ->select('*','repairs.id as repairsId')
        ->where('user_id',Auth::user()->id)->get();
        

        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();
          
            return view('user.View.viewOrder', compact('orders','posts','customs','repairs'));


        // $pending = DB::table('orders')
        //     ->join('products', 'product_id', '=', 'orders.product_id')
        //     ->select('*')
        //     ->where('user_id', '=', Auth::user()->id)
        //     ->get();

        // return view('user.View.viewOrder', compact('pending', 'posts'));
    }

    public function profile()
    {
    
        
        if (Auth::user()->email_verified_at == null && Auth::user()->verifiedBy == 1||Auth::user()->verifiedBy == 2) {

                $userId = auth()->user()->id;
                $user = User::find($userId);
                return view('profile', compact('user'))->with('message','verify your email');
            }
            elseif(Auth::user()->email_verified_at !== null){
                $userId = auth()->user()->id;
                $user = User::find($userId);
                return view('profile', compact('user'));
            }
  

        
   
      
        
    }
    public function profileUpdate(Request $request)
    {
        //validation rules

        $request->validate([
            'Fname' => ['required', 'string', 'max:20'],
            'Lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'phoneNumber' => ['required', 'digits_between:3,15',],

            'Address' => ['max:255',],
        ]);
        $oldEmail = auth()->user()->email;
        $oldPhoneNumber = auth()->user()->phoneNumber;

        $user = User::find($request->id);
        // Getting values from the blade template form
        $user->Fname =  $request->Fname;
        $user->Lname = $request->Lname;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->Address = $request->Address;

        $user->save();
      
        if ($oldEmail != $request->email) {
            $user_id=Auth::user()->id;
            $userNewData = User::all()->where('id', '=', $user_id)->first();  
    
            auth()->user()->update([
                'email_verified_at' => null
            ]);

            $userNewData->sendEmailVerificationNotification();
          
                return view('auth.verify');
                 
           
        }
        elseif ($oldPhoneNumber != $request->phoneNumber) {
            $code=rand(1111,9999);
            $PhoneNumber=Auth::user()->phoneNumber;
            auth()->user()->update([
                'code' => $code,
            ]);
            //     $nexmo = app('Nexmo\Client');
            //     $nexmo->message()->send([
            //      'to'=>'+63'.(int)$PhoneNumber,
            //      'from'=>'Vonage APIs',
            //      'text'=>'Verify Code: '.$code,
            //  ]);
             return view('auth.phoneVerify');
            }
       
        else{
            return back()->with(['Success'=> 'Profile Updated']);

        }
        
       
           
        

    }


    public function changePssword(Request $request)
    {

        return view('changePassword');
    }
    public function UpdatePassword(Request $request)
    {


        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function verifyCodeView(Request $request)
    {
        return view('auth.phoneVerify');
    }
    public function verifyCode(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'code' => ['required'],
        ]);

        if (Auth::user()->code == $request->code) {
            $User = User::find(Auth::user()->id);
            $User->code = 0000;
             $User->save();
             if (Auth::user()->role=1) {
                return redirect()->route('admin.dashboard')->with('message','your account have been verified Successfully');
             }
             elseif(Auth::user()->role=2){
                return redirect()->route('user.dashboard')->with('message','your account have been verified Successfully');
             }
        }
        else{
            return redirect()->route('allUsers.phoneVerify')->with('message','code is wrong');
        }
        
    }

}
