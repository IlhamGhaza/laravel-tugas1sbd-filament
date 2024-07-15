<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8'],
         'role' => 'required|string|in:staff,user,admin',

      ]);
      $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password),
         'role' => $request['role'],
      ]);
      $token = $user->createToken('auth_token')->plainTextToken;
      return response()->json
        (['data' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer',
        ], 201);
   }

   //login

   public function login(Request $request)
   {
      $request->validate([
         'email' => 'required|string|email',
         'password' => 'required|string',
         'remember_me' => 'boolean',
      ]);
      $user = User::where('email', $request->email)->first();
      if (!$user || !Hash::check($request->password, $user->password)) {
         return response()->json([
            'message' => 'Unauthorized'
        ], 401);
      }
      $token = $user->createToken('auth_token')->plainTextToken;
      $response = [
        'status' => 'success',
        'token' => $token,
        'message' => 'User berhasil ditambahkan',
        'user' => $user,
    ];

    return response($response, 200);
   }

   //logout

   public function logout(Request $request)
   {
      $request->user()->currentAccessToken()->delete();
      return response()->json([
         'status' => 'success',
         'message' => 'Logout Success'
      ], 200);
   }

}
