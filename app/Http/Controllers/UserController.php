<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public static $registerSuccessMessage = 'El usuario se registro correctamente';
    public static $registerErrorMessage = "Invalid data passed";
    public static $loginSuccessMessage = 'login success';
    public static $loginErrorMessage = 'login error';

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return self::$registerErrorMessage;
        }

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);

        return back()->with('status', self::$registerSuccessMessage);
    }


    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        
        $user = User::where('email', $request->get('email'))
                    ->first();



        if(!$user){
            return back()->with('status', self::$loginErrorMessage);
        }


        if(Hash::check($request->get('password'), $user->password)){
            Auth::login($user);
            return back()->with('status', self::$loginSuccessMessage);
        }

        die('Not valid password');
    }
}









