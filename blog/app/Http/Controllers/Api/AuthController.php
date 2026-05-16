<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required' , 'string' , 'max:255'],
            "email" =>  ['required' , 'string' ,'unique:users' ],
            'password' => ['required' , 'min:8' , 'confirmed']
        ]);

        $user = new User();
        $user->forceFill([
            "name" => $validatedData['name'],
            "email" => $validatedData['email'],
            "password" => Hash::make($validatedData['password'])
        ])->save();

        return response()->json([
            "message" => "User Registered"
        ]);
    }

    public function login(Request $request)
    {
        $creds = $request->only('email', 'password');
        if(auth()->attempt($creds))
        {
            $token = auth()->user()->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token], 200);
        }

        return response()->json(['message' => "Unauthoried"], 401);
    }


    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        // $request->user()->tokens()->delete();

        return response()->json(['message' => "logout"], 200);

    }


}
