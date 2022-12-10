<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nexmo\Laravel\Facade\Nexmo;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Fname' => ['required', 'string', 'max:20'],
            'Lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required', 'digits_between:3,15', 'unique:users'],
            'verifiedBy' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        if ($data['verifiedBy'] == 2) {
            $code = rand(1111, 9999);
            $nexmo = app('Nexmo\Client');
            $nexmo->message()->send([
                'to' => '+63' . (int)$data['phoneNumber'],
                'from' => 'Vonage APIs',
                'text' => 'Verify Code: ' . $code,
            ]);
        } else {
            $code = 0;
        }
        return User::create([
            'Fname' => $data['Fname'],
            'Lname' => $data['Lname'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'code' => $code,
            'role' => 2,
            'verifiedBy' => $data['verifiedBy'],
            'password' => Hash::make($data['password']),
        ]);
    }
    protected function redirectTo()
    {
        if (Auth()->user()->role == 1) {
            return route('admin.dashboard');
        } elseif (Auth()->user()->role == 2) {
            return route('user.dashboard');
        } elseif (Auth()->user()->role == 3) {
            return route('admin.dashboard');
        }
    }
}
