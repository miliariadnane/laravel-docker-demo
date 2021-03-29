<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validation with register request
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:25',
            'lastName' => 'required|string|max:25',
            'username' => 'required|string|max:10|unique:users',
            'phoneNumber' => 'required|string|max:20',
            'address' => 'max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        
        // crypting password
        $validatedData['password'] = Hash::make($request->password);
        
        $user = User::create($validatedData);
        // create token
        $accessToken = $user->createToken('authToken')->accessToken;
        // dd('test');
        return response([ 'user' => $user, 'access_token' => $accessToken], 201);
    }

    public function login(Request $request)
    {
        // validation with login request
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // verfiy if infos are correct
        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        // generate token
        $user = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['id' => $user->id, 'token' => $accessToken]);

    }
}

