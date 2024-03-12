<?php

namespace App\Http\Controllers\Auth;

use App\Constant\UserRole;
use App\Constant\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {

        return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'status'  => UserStatus::ACTIVE,
          'role'    => UserRole::USER
        ]);
    }

    public function createUserAccount(Request $request){
        $validate = Validator::make($request['data'], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validate->fails()){
            return response()->json(['error'=>$validate->errors()->all(), "status" => "400"]);
        }
        User::create([
            'name' => $request['data']['name'],
            'email' => $request['data']['email'],
            'password' => Hash::make($request['data']['password']),
            'status'  => UserStatus::ACTIVE,
            'role'    => UserRole::USER
        ]);

        return response()->json(['data' => 'success', 'status' => "200"]);
    }
}
