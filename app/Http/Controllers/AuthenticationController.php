<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{


    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:15'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $response = [
            'message' => 'success',
            'user' => $user
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:5|max:15'
        ]);

        Auth::attempt($request->only('email', 'password'));

        if (Auth::check()) {
            $token = Auth::user()->createToken('Token')->plainTextToken;
            $response = [
                'message' => 'success',
                'data' => Auth::user(),
                'token' => $token
            ];

            return response()->json($response, 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        $response = [
            'status' => true,
            'message' => 'success',
        ];

        return response()->json($response, 200);
    }
}
