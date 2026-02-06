<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validatedData->errors()->first()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || $user->role == 'admin' || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email atau password salah'
                ], 401);
            }

            Auth::login($user);
            $user->tokens()->delete();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'token' => $token,
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Logout berhasil'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat logout'
            ], 500);
        }
    }
}
