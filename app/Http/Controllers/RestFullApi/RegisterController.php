<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validatedData->errors()->first()
            ], 422);
        }

        try {
            $user = new \App\Models\User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Akun berhasil dibuat, silahkan login menggunakan akun anda.',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Terjadi kesalahan saat registrasi "
            ], 500);
        }
    }
}
