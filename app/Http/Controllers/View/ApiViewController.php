<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ApiViewController extends Controller
{
    public function landing() {
        return response()->view('welcome');
    }

    public function login() {
        return response()->view('login');
    }

    public function handleLogin(Request $req) {
        $req = [$req->all()['username'], $req->all()['password']];
        $validator = Validator::make($req, [
            'username' => 'required|string|max:255|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return redirect('/');
        }
        
        JWTAuth::factory()->setTTL(60);
        $token = Auth::attempt($req);
        if (!$token) {
            return redirect('/login');
        }

        $user = Auth::user();
        session()->keep($user);
        return redirect('/');
    }

    
}
