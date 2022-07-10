<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '/sales';

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
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'required',
            'national_number' => 'required|exists:accounts,national_number|unique:users,national_number',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $photo = request()->file('photo');
        $name = $data['national_number'].'.jpg';
        $photo->move(public_path('images'), $name);
        $username = DB::table("accounts")
        ->where("national_number", "=", $data['national_number'])
        ->value("name");
        $permission = DB::table("accounts")
        ->where("national_number", "=", $data['national_number'])
        ->value("permission");
        return User::create([
            'name' => $username,
            'email' => $data['email'],
            'photo' => $name,
            'national_number' => $data['national_number'],
            'password' => bcrypt($data['password']),
            'permission' => $permission,
        ]);
    }
}
