<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function pharmacistRegister(Request $request)
    {
        $fields=$request->validate([
            'name'=>'required|string|min:3',
            'phone'=>'required|string|min:10|max:10|unique:users,phone',
            'password'=>'required|string|confirmed|min:6',
            'pharmacy_name'=>'required|string|min:3',
            'role'=>'boolean'
        ]);
        $pharmacist_user=User::create([
            'name'=>$fields['name'],
            'phone'=>$fields['phone'],
            'password'=>bcrypt($fields['password']),
            'role'=>0
        ]);
        
        $token=$pharmacist_user->createtoken('UserToken')->plainTextToken;
        
        $pharmacy=Pharmacy::create([
            'user_id'=>$pharmacist_user['id'],
            'pharmacy_name'=>$request['pharmacy_name']
        ]);
        
        // for testing
        //    return response()->json(['user'=>$pharmacist_user ,'pharmacy'=> $pharmacy ,'User Token'=> $token],201);
        //return response()->json();
        return response()->json(['massege'=>'success'],201);
    }
    public function ownerRegister(Request $request)
    {
        $fields=$request->validate([
            'name'=>'required|string|min:3',
            'phone'=>'required|string|min:10|max:10|unique:users,phone',
            'password'=>'required|string|confirmed|min:6',
            'warehouse_name'=>'required|string|min:3',
            'role'=>'boolean'
        ]);
        $owner_user=User::create([
            'name'=>$fields['name'],
            'phone'=>$fields['phone'],
            'password'=>bcrypt($fields['password']),
            'role'=>1
        ]);
        
        $token=$owner_user->createtoken('UserToken')->plainTextToken;
        
        $warehouse=Warehouse::create([
            'user_id'=>$owner_user['id'],
            'warehouse_name'=>$request['warehouse_name']
        ]);
        
        // for testing
       // return response()->json(['user'=>$owner_user ,'pharmacy'=> $warehouse ,'User Token'=> $token],201);
       // return response()->json([],201);
    }
    public function login(Request $request)
    {
        $fields=$request->validate([
            'phone'=>'required',
            'password'=>'required',
        ]);

        // Check phone
        $user=User::where('phone',$fields['phone'])->first();
        
        // Check password 
        if (!$user || !Hash::check($fields['password'],$user->password))
        {
            return response()->json(['massege'=>'Bad Credentials'],401);
            
        }
        
        $token=$user->createtoken('UserToken')->plainTextToken;
        
        // for testing
        return response()->json(['user'=>$user ,'UserToken' => $token],200);

    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>"you've logged out"]);
    }
}
