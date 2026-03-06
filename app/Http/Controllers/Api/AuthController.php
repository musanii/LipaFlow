<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=>'required|min:6'

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ],422);
        }

        $credentials = $request->only('email','password');

        if(!$token = auth('api')->attempt($credentials)){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid credentials'
            ],401);

        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        
        return response()->json([
            'status'=>true,
            'user'=>auth('api')->user()
            ]);
    }

    public function logout()
    {
         auth('api')->logout();
        return response()->json([
            'status'=>true,
            'message'=>'Logged out successfully'
            ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token){
        return response()->json([
            'status'=>true,
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth('api')->factory()->getTTL() * 60,
            'user'=>auth('api')->user()

        ]);
    }
}
