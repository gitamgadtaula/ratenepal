<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function loginRequest(Request $request)
    {

        // $credentials ={ $req->email , $req->password};
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response('not authenticated', 401);
        }
        return response()->json(['token'=>$token, 'msg'=>'login successful']);
    }
    public function userInfo(){
        if(!$user = auth()->user()){
            return response()->json(['unauthorized',401]);
        }
        return response()->json(['user'=>$user]);
    }
}
