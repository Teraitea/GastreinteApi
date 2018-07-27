<?php

namespace App\Http\Controllers;
/**
 * Import the models that we need in this controller
 */
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required|string', 
            'firstname' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'user_type_id' => 'required',
            'picture_profil' => 'required' 
        ]);

        if($validator->fails()):
            return response()->json(['error'=>$validator->errors()], 401);
        endif;


        if($request->hasfile('picture_profil')):
            $file = $request->file('picture_profil');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
            $file->move('uploads/images/', $filename);
        endif;

        $input = $request->all();
        $input['picture_profil'] = $filename;
        $input['password'] = bcrypt($input['password']);
        
        $user = User::create($input);

        $success['id'] =  $user->id;
        $success['lastname'] =  $user->lastname;
        $success['firstname'] =  $user->firstname;
        $success['email'] =  $user->email;
        $success['user_type_id'] =  $user->user_type_id;
        $success['picture_profil'] =  $user->picture_profil;
        $success['token'] =  ('Bearer ').$user->createToken('Laravel')->accessToken;

        return Response::json($success);
    }

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            $success['lastname'] =  $user->lastname;
            $success['firstname'] =  $user->firstname;
            $success['email'] =  $user->email;
            $success['user_type_id'] =  $user->user_type_id;
            $success['picture_profil'] =  $user->picture_profil;
            $success['token'] =  ('Bearer ').$user->createToken('Laravel')->accessToken;
            return Response::json($success);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }
}
