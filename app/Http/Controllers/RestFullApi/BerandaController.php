<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        try {
            $favoriteBooks = BookLending::select('book_id', DB::raw('count(*) as total_lendings'))
                ->where('status', 'returned') // hanya yang sudah dikembalikan
                ->groupBy('book_id')
                ->orderByDesc('total_lendings')
                ->with('book')
                ->take(5)
                ->get();

            // $books = Book::take(5)->latest()->get();

            return response()->json([
                'status' => 'success',
                'favorite_books' => $favoriteBooks,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }
}
