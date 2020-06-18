<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){

        $creds = $request->only(['email','password']);

        if(!$token=auth()->attempt($creds)){
            
            return response()->json([
                'success' => false,
                'message' => 'invalid credintials'
            ]);
        }
        return response()->json([
            'success' =>true,
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'logout success'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);
        }
    }
    
}
