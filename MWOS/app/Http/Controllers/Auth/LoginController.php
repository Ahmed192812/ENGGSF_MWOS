<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected function formLogin(request $request){
    
    //     $key = 'login.'.$request->ip();
    //     return view('auth/login',['key'=>$key,'retries'=>RateLimiter::retriesLeft($key,5),
    //     'seconds'=>RateLimiter::availableIn($key),
    // ]);
    // }




    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if(Auth()->user()->role ==1){
            return route('admin.dashboard');
        }
        elseif(Auth()->user()->role ==2){
            return route('user.dashboard');
        }
        elseif(Auth()->user()->role ==3){
            return route('admin.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
        $this->middleware('guest')->except('logout');

    }
    
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
           
            'email' => 'required_without:phoneNumber',
            'phoneNumber' => 'required_without:email',
            'password' => 'required|',
           
        ],
    );
        if ($request->email) {
            $this->checkTooManyFailedAttempts();

            $this->validate($request,[
           
            'email' => 'exists:users',
            'password' => 'required|',
           
        ],
        [ 'email.exists' => "We could not find your account.",
        ],
    );
        }
        elseif ($request->phoneNumber) {
            $this->checkTooManyFailedAttempts();

            $this->validate($request,[
           
            'phoneNumber' => 'digits_between:3,15|exists:users',
            'password' => 'required',
           
        ],
        [ 'phoneNumber.exists' => "We could not find your  account.",
        ],
    );       
 }
       
        
       
        if (auth()->attempt(array('email'=>$input['email'],'password'=>$input['password']))) {
           RateLimiter::clear('login.'.$request->ip());
         
           if(Auth()->user()->role ==1){
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth()->user()->role ==2){
            return redirect()->route('user.dashboard');
        }
        elseif(Auth()->user()->role ==3){
            return redirect()->route('admin.dashboard');
        }
        }
        elseif (auth()->attempt(array('phoneNumber'=>$input['phoneNumber'],'password'=>$input['password']))) {
            RateLimiter::clear('login.'.$request->ip());
            if(Auth()->user()->role ==1){
                return redirect()->route('admin.dashboard');
            }
            elseif(Auth()->user()->role ==2){
                return redirect()->route('user.dashboard');
            }
            elseif(Auth()->user()->role ==3){
                return redirect()->route('admin.dashboard');
            }
        }

        else{


            $errors = ['password' => 'Wrong password'];
        
            if ($request->expectsJson()) {
                return response()->json($errors, 422);
            }
            return redirect()->back()
            
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
            RateLimiter::hit($this->throttleKey(), $seconds = 3600);



            
       
        };
        
       
    }
    public function throttleKey()
    {
        return Str::lower(request('email')) . '|' . request()->ip();
    }
    public function checkTooManyFailedAttempts()
    {
        $errors=['attempt' => 'to many attempt try again in 5 mints'];
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return with($errors);
        }
}
}
    

