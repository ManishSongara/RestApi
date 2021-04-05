<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $user = $request->user();

        $accessToken =  $user->createToken('Personal Access Token')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    
    public function Forgout_password(Request $request){
        //coming soon
    }

    public function Change_password(Request $request){
        $loginData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);  

    }
}
