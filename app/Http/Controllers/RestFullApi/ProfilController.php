<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = User::with('profile')->find(Auth::id());
        return response()->json([
            'status' => 'success',
            'profil' => [
                'id' => $profil->id,
                'name' => optional($profil->profile)->name,
                'username' => $profil->username,
                'email' => $profil->email,
                'address' => optional($profil->profile)->address,
                'phone' => optional($profil->profile)->phone,
                'gender' => optional($profil->profile)->gender,
            ],
        ]);
    }

    public function update(Request $request)
    {
        try { 

            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validatedData->errors()->first()
                ], 422);
            }

            DB::beginTransaction();
            $user = User::find(Auth::id());
            $user->email = $request->email;
            $user->save();

            $profile = $user->profile;
            $profile->name = $request->name;
            $profile->address = $request->address;
            $profile->phone = $request->phone;
            $profile->gender = $request->gender;
            $profile->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Profil berhasil diperbarui',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }
}
