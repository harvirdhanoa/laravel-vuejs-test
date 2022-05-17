<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth()->attempt($requestData)){
            $response = ['status' => 401,'message' => 'Invalid Credentials'];
            return response($response);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        $response = ['status' => 200,'message' => 'Logged In', 'data' => ['user' => auth()->user(), 'access_token' => $accessToken]];
        return response($response, 200);
    }


    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['status' => 200, 'message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}