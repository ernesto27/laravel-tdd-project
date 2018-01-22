<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public static $registerSuccessMessage = 'El usuario se registro correctamente';
    public static $registerErrorMessage = "Invalid data passed";

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

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password')
        ]);

        return self::$registerSuccessMessage;
    }
}
