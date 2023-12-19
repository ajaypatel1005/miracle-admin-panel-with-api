<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    //
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:225|min:6',
            'password' => 'required',
        ]);

        // If validation error 
        if ($validator->fails()) {
            return ResponseHelper::errorResponse($validator->errors()->all());
        } else {
            try {
                if (sizeof(User::where('email', '=', request('email'))->get()) > 0) {
                    if (sizeof(User::where('email', '=', request('email'))->get()) > 0) {
                        if ($token = JWTAuth::attempt(['email' => request('email'), 'password' => request('password')])) {
                            $success['token'] = $token;
                            return ResponseHelper::responseMessage('success', $success, "User login successfully.");
                        } else {
                            return ResponseHelper::errorResponse(['You have entered an invalid email or password.']);
                        }
                    } else {
                        return ResponseHelper::errorResponse(['Your account does not actived. Please contact your administrator.']);
                    }
                } else {
                    return ResponseHelper::errorResponse(['Account does not exist.']);
                }
            } catch (Exception $e) {
                return ResponseHelper::errorResponse(['Something went wrong!!']);
            }
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }
}
