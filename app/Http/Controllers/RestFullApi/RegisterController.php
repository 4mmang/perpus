<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
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
            DB::beginTransaction();
            $user = new \App\Models\User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $profile = new \App\Models\Profile();
            $profile->user_id = $user->id;
            $profile->name = $request->name;

            $profile->save();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Akun berhasil dibuat, silahkan login menggunakan akun anda.',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
