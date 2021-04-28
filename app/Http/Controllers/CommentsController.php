<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Passport\Passport;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentsController extends Controller
{
        //
        public function test(Request $request)
        {
                try {

                        if (!$user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 404);
                        }
                } catch ( Auth $e) {

                        return response()->json(['token_invalid'], $e);
                }
                return response()->json(compact('user'));
                /* return response()->json([
            'message' => 'Successfully logged in'
        ]);*/
        }
}
