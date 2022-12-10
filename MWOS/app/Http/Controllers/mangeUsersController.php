<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mangeUsersController extends Controller
{
   
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
            $filter = $request->get('filter');
                    if($search!=""){
                        $Users =  DB::table('users')
                        ->where( DB::raw("CONCAT(id,' ',Fname,' ',Lname,' ',email )"),'LIKE','%'.$search.'%'
                        )->paginate(10);
                        
                $Users->appends(['search' => $search]);
                $count = $Users->total();
                if($count == 0)
                return view('admin.mangeUsers')->with(['Users' => $Users,'NoFound' => 'There is no result 😔']);
                else
                return view('admin.mangeUsers')->with(['Users' => $Users,'found' => $count.' records founded']);
                 
    
                
            }
            elseif ($filter!="") {
                $Users =  DB::table('users')
                ->where('role',$filter)
                ->paginate(10); 
                return view('admin.mangeUsers',compact('Users'));
            }
            else{
                $Users =  DB::table('users')
                // ->where('role','3')
                // ->orWhere('role','1')
                ->paginate(10); 
                return view('admin.mangeUsers',compact('Users'));
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
        $validator= Validator::make($request->all(),[
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber'=>['required','digits_between:3,15','unique:users'], 
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'verifiedBy'=>['required'], 

        ],
        ['fname.required' => "First name is required",
          'lname.required' => "Last name is required",
          'email.required' => "Email is required",
          'role.required' => "Role is required",
          'password.confirmed' => "Please confirm password",
          'password.required' => "Password is required",
          'verifiedBy.required' => "pleas select verification method",


    ],

    
    );
        $data = $request->all();
        if (!$validator->passes()) {
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }
        else{
           $this->create($data);
            return response()->json(['status'=>1,'msg'=>'saved successfully']);
        }
               
    }

    public function create(array $data)
    {
        if ($data['verifiedBy']==2) {
            $code=rand(1111,9999);
        //     $nexmo = app('Nexmo\Client');
        //     $nexmo->message()->send([
        //      'to'=>'+63'.(int)$data['phoneNumber'],
        //      'from'=>'Vonage APIs',
        //      'text'=>'Verify Code: '.$code,
        //  ]);
         
        }
        else{
            $code=0;
        }
        
      return User::create([
        'Fname' => $data['fname'],
        'Lname' => $data['lname'],
        'email' => $data['email'],
        'phoneNumber' => $data['phoneNumber'],
        'code'=>$code,
        'role' => $data['role'],
        'password' => Hash::make($data['password']),
        'verifiedBy' => $data['verifiedBy'],
        
      ]);
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
        $User  = User::where($where)->first();
        
        return response()->json($User);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $User = User::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }
  
    
}
