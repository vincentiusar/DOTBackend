<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $req) {
        $validator = Validator::make($req->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('username', $req->username)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                
                $response['user'] = $user;
                $response['token'] = $user->createToken('TokenHotel')->plainTextToken;
                return response($response, 200);
            }
        } else {
            $response = ["message" =>'Unauthenticated'];
            return response($response, 422);
        }

    }

    public function register(Request $req){
        $validator = Validator::make($req, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'require|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($req['password']);

        $user = User::create($req->toArray());
        $token = $user->createToken('TokenHotel')->plainTextToken;
        $response = ['user'=>$user,'token' => $token];
        
        return response($response, 200);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
