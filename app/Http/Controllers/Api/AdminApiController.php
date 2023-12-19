<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\ResponseHelper;
use App\Models\Admin;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminApiController extends Controller
{
  
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:225|min:6',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return ResponseHelper::errorResponse($validator->errors()->all());
        }
    
        try {
            $credentials = $request->only('email', 'password');
    
            if (Auth::guard('admin-api')->attempt($credentials)) {
                // Upon successful login, JWT token is generated
                $token = JWTAuth::fromUser(Auth::guard('admin-api')->user());
    
                // Now you can return this token as the authentication response
                return ResponseHelper::responseMessage('success', ['token' => $token], "User login successful.");
            } else {
                return ResponseHelper::errorResponse(['Invalid email or password.']);
            }
        } catch (Exception $e) {
            return ResponseHelper::errorResponse(['Something went wrong!!']);
        }
    }

    public function getUsersList()
    {
        $user = User::get();
        return response()->json(['user' => $user]);
    }
}
