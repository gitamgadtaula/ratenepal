<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    public function __invoke(){
        $user = auth()->user();
        return response()->json(['user'=>$user]);
    }
}
