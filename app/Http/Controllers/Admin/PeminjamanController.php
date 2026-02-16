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
        $borrowing->status = $request->input('status');
        if ($request->input('status') == 'borrowed') {
            $borrowing->lend_date = now();
        } elseif ($request->input('status') == 'returned') {
            $borrowing->return_date = now();
        }
        $borrowing->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
