<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $borrowings = \App\Models\BookLending::with(['user', 'book'])->get();
        return view('admin.peminjaman.index', compact('borrowings'));
    }
}
