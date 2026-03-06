<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'business_name'=>'required',
            'business_type'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        DB::beginTransaction();

        try{
            $business = Business::create([
                'name'=> $request->business_name,
                'type'=>$request->business_type
            ]);

            $user = User::create([
                'business_id'=>$business->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'role'=>'admin'
            ]);
            DB::commit();
            $token=auth('api')->login($user);

           
            return response()->json([
                'status'=>true,
                'business'=>$business,
                'user'=>$user,
                'access_token'=>$token,
                'message'=>'Business created successfully'
            ],201);


        }catch(Exception $e){
            DB::rollBack();
            Log::error("Registration failed: " . $e->getMessage());

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);

        }

    }
}
