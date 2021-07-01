<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function test(){
        return response()->json([
            'message' => 'Test DOne',
        ], 201);
    }
}
