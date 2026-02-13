<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = User::with('profile')->find(Auth::id());
        return response()->json([
            'status' => 'success',
            'profil' => [
                'id' => $profil->id,
                'username' => $profil->username,
                'email' => $profil->email,
                'address' => $profil->profile->address,
                'phone' => $profil->profile->phone,
                'gender' => $profil->profile->gender,
            ],
        ]);   
    }
}
