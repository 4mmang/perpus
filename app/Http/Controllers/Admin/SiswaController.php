<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'user')->get();
        return view('admin.students.index', compact('students'));
    }
}
