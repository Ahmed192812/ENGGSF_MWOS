<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    // Navbar
    public function home()
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.View.viewHome', compact('posts'));
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

        return view('user.Transaction.reqCatalog', compact('filter','posts'));
    }

    public function profile()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        return view('profile', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        //validation rules

        $request->validate([
            'Fname' => ['required', 'string', 'max:20'],
            'Lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($request->id)],
            'phoneNumber' => ['required','digits_between:3,15',],

            'Address' => ['max:255',],
        ]);
        $oldEmail = auth()->user()->email;
        $user = User::find($request->id);
        // Getting values from the blade template form
        $user->Fname =  $request->Fname;
        $user->Lname = $request->Lname;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->Address = $request->Address;


        $user->save();
        if ($oldEmail != $request->email) {
            auth()->user()->update([
                'email_verified_at' => null
            ]);
            auth()->user()->sendEmailVerificationNotification();
        }

        return back()->with('message', 'Profile Updated');
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
}
