<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function login(Request $request){
        /**
         * get user by email
         */

         $user = User::where('email',$request->email)->first();

        /**
         * check user availability
         */

        if($user == null){
            return response()->json([
                'status' => false,
                'message' => 'email tidak ditemukan',
                'data' => null
            ], 400);
        }

        /**
         * check user password
         * , $user->password
         */
        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => false,
                'message' => 'password salah',
                'data' => null
            ], 400);
        }
        $token = $user->createToken('auth_token');
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'auth' => [
                    'token' => $token->plainTextToken,
                    'token_type' => 'Bearer'
                ]
            ]
        ], 200);
    }
    public function getUser(Request $request){
        /** 
         * get user token 
         */
        
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $user
        ]);
    }
}
