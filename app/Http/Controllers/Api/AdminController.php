<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Admin registered successfully', 'admin' => $admin]);
    }

    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $admin = Admin::where('email', $validated['email'])->first();

            if ($admin && Hash::check($validated['password'], $admin->password)) {
                $token = $admin->createToken('admin-token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'admin' => $admin,
                ]);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();


        return response()->json(['message' => 'Logout successful']);
    }
}
