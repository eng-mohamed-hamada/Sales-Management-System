<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function update_get(){
        return view('auth.settings');
    }
    public function update_post(){
        $data = $this->validate(request(),[
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $email = Auth::user()->email;
        $photo = request()->file('photo');
        $name = $email.'.jpg';
        $photo->move(public_path('images'), $name);
        DB::table("users")
        ->where("email", "=", $email)
        ->update([
            'password' => bcrypt($data['password']),
            'photo' => $name,
        ]);
        return back();
    }

}
