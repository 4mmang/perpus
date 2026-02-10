<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function index()
    {
        try {
            $lendings = BookLending::where('user_id', Auth::id())->get();
            return response()->json([
                'status' => 'success',
                'lendings' => $lendings,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data peminjaman.'
            ], 500);
        }
    }

    public function ajukanPinjaman($id)
    {
        try {
            $cekStatus = BookLending::where('user_id', Auth::id())
                ->where('book_id', $id)
                ->firstOrFail();
            if ($cekStatus) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah mengajukan pinjaman untuk buku ini.',
                ], 400);
            }
            BookLending::create([
                'user_id' => Auth::id(),
                'book_id' => $id,
            ]);

            $book = Book::findOrFail($id);
            $book->stok = $book->stok - 1;
            $book->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan pinjaman buku berhasil.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Gagal mengajukan pinjaman buku.'
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function batalkanPinjaman($id)
    {
        try {
            $lending = BookLending::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            $lending->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman buku berhasil dibatalkan.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membatalkan peminjaman buku.'
            ], 500);
        }
    }
}
