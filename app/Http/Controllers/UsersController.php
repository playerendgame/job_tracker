<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'confirmPassword' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->all()], 422);
        }
    

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);

    }

    public function fetchLoggedInUser()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json(['message' => 'Logged in user', 'user' => $user->name], 200);
        } else {
            return response()->json(['message' => 'No logged in user'], 401);
        }
    }
        

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->all()], 422);
        }
    
        $credentials = $request->only(['email', 'password']);
    
        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
    
        $user = auth()->user();
    
        // If login is successful, return a JSON response with the user data
        return response()->json(['message' => 'Login successful', 'user' => $user], 200);

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);

    }
}
