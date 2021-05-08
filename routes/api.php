<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//API Routes for LOgin 
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::post('/post', [PostsController::class, 'create']);
Route::post('/fileUp', [PostsController::class, 'store']);
Route::get('/getFile', [PostsController::class, 'index']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/test',[CommentsController::class,'test']);
});

Route::apiResource('projects', ProjectController::class)->middleware('auth:api');