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

    public function update(Request $request, $id)
    {
        $borrowing = \App\Models\BookLending::findOrFail($id);
        $borrowing->status = 'approved';
        $borrowing->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
