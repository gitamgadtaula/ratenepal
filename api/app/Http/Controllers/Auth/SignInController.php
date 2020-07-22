<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __invoke(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response('not authenticated', 401);
        }
        return response()->json(['token' => $token, 'msg' => 'login successful']);
    }
}
