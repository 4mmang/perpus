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
        $book = \App\Models\Book::find($borrowing->book_id);
        if ($request->input('status') == 'borrowed') {
            $borrowing->lend_date = now();
        } elseif ($request->input('status') == 'returned') {
            $book->stock += 1;
            $borrowing->return_date = now();
        } elseif ($request->input('status') == 'rejected') {
            $book->stock += 1;
        } elseif ($request->input('status') == 'overdue') {
            $book->stock += 1;
            $borrowing->return_date = now();
        }
        $book->save();
        $borrowing->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
