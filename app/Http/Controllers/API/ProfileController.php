<?php

namespace App\Http\Controllers\API;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    //
    public function insert(Request $request){

        $photo = $request->input('photo');   
        $photo = str_replace('data:image/jpeg;base64,', '', $photo);
        $image = base64_decode($photo);
        $imageName = time();
        Storage::disk('public')->put('images/profiles/'.$imageName.'.'.'jpg',$image);


        $profile = new Profile([
            'name' => $request->input('name'),
            'user_id' => $request->input('u_id'),
            'profile_img' => $imageName,
            'country'=> $request->input('country'),
            'bio' => $request->input('bio'),
        ]);

        $profile->save();

        return response()->json([
            'message' => 'profile completed!',
            'post' => $profile
        ], 201);
    }

    public function getProfile(Request $request)
    {
        $filename = $request->filename;
        $path = storage_path().'/app/public/images/profiles/'.$filename;  

        if(!File::exists($path)) abort(404);
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function RetriveData(Request $request){
        if(!$request->id){
            $Contacts = Profile::all();
        }elseif($request->id){
            $Contacts = Profile::all()->where('user_id',$request->id);
        }
        return response()->json([
            'posts' =>  $Contacts->values()->toArray(),
            'message' => 'Data in Conatcts:',
        ],201);
    }


}
