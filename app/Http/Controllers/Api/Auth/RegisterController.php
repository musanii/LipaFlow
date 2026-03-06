<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return response()->json([
                'status'=>true,
                'message'=>'Business created successfully'
            ]);


        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);

        }

    }
}
