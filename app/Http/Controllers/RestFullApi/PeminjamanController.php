<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{

    public function index()
    {
        try {
            $lendings = BookLending::with('book')
                ->where('user_id', Auth::id())
                ->get();

            $data = [];

            foreach ($lendings as $lending) {
                $data[] = [
                    'id' => $lending->id,
                    'book_id' => $lending->book_id,
                    'user_id' => $lending->user_id,
                    'status' => $lending->status,
                    'created_at' => $lending->created_at,
                    'lend_date' => $lending->lend_date,
                    'return_date' => $lending->return_date,
                    'title' => optional($lending->book)->title,
                ];
            }

            return response()->json([
                'status' => 'success',
                'lendings' => $data,
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
            DB::beginTransaction();

            $cekStatus = BookLending::where('user_id', Auth::id())
                ->where('book_id', $id)
                ->first();
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
            $book->stock = $book->stock - 1;
            $book->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan pinjaman buku berhasil.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
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
            DB::beginTransaction();
            $lending = BookLending::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $book = Book::findOrFail($lending->book_id);
            $book->stock = $book->stock + 1;

            $book->save();
            $lending->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman buku berhasil dibatalkan.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membatalkan peminjaman buku.'
            ], 500);
        }
    }

    public function cariPinjaman(Request $request)
    {
        $query = BookLending::with('book')
            ->where('user_id', Auth::id());

        if ($request->has('title')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('title', $request->input('title'));
            });
        }

        $lendings = $query->get();

        $data = [];

        foreach ($lendings as $lending) {
            $data[] = [
                'id' => $lending->id,
                'book_id' => $lending->book_id,
                'user_id' => $lending->user_id,
                'status' => $lending->status,
                'created_at' => $lending->created_at,
                'lend_date' => $lending->lend_date,
                'return_date' => $lending->return_date,
                'title' => optional($lending->book)->title,
            ];
        }

        return response()->json([
            'status' => 'successssss',
            'lendings' => $data,
        ], 200);
    }
}
