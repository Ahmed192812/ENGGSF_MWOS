<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function dashboard()
    {  
        return view('user.dashboardUser');

    }
    public function profile()
    {  
        $userId = auth()->user()->id;
        $user = User::find($userId);
        return view('profile', compact('user'));

    }
    public function profileUpdate(Request $request){
        //validation rules

        $request->validate([
            'Fname' => ['required', 'string', 'max:20'],
            'Lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'PHnumber' => [ 'string', 'max:15'],
            'Address' => [ 'string','max:255',],
        ]);
        $oldEmail = auth()->user()->email;
        $user = User::find($request->id);
        // Getting values from the blade template form
        $user->Fname =  $request->Fname;
        $user->Lname = $request->Lname;
        $user->email = $request->email;
        $user->phoneNumber =  $request->PHnumber;
        $user->Address = $request->Address;


        $user->save();
        if ($oldEmail != $request->email) {
            auth()->user()->update([
                'email_verified_at' => null
            ]);
            auth()->user()->sendEmailVerificationNotification();

        }
        return back()->with('message','Profile Updated');
    }
    
}
