<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // register a user
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'role' => $fields['role'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'message' => 'user is created successfully!',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    // login a user
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // check email
        $user = User::where('email', $fields['email'])->first();
        // check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad credintials'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'message' => 'user is logged in successfully!',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    // logout a user
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'logged out successfully!'
        ];
    }
}
