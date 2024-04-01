<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(Request $request){
         $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response()->json([
                'status'=> 'faild',
                'message' => 'invalid credentials'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;
        $response = [
            'status' => 'success',
            'message' => 'user is loged in successfully',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
            ];
            return response()->json($response,200);
    }
    function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'user is loged out successfully'
        ], 201);
    }
}
