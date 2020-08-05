<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;

class AuthController extends Controller
{
    public function loginRequest(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['msg' => 'Sorry wrong email or password']);
        }
        return response()->json(['token' => $token, 'msg' => 'login successful']);
    }
    public function userInfo()
    {
        if (!$user = auth()->user()) {
            return response()->json('unauthorized', 401);
        }
        return response()->json(['user' => $user]);
    }

    public function userInfoById($user_id)
    {
        $result = User::find($user_id);
        if (!$result) {
            return response()->json('User not found');
        }
        return response()->json(['user' => $result]);
    }


    public function logout()
    {
        $action = auth()->logout();
        if (!$action) {
            return response()->json('bad request', 401);
        }
        return response()->json(['status' => 'logged out successfully']);
    }
}
