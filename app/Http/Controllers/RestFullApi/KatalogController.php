<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categories = Category::all();
            $books = Book::all();
            if ($request->kategori) {
                $books = Book::where('category_id', $request->kategori)->get();
            }
            return response()->json([
                'status' => 'success',
                'books' => $books, 
                'categories' => $categories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data buku.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'book' => $book,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan.'
            ], 404);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('q');
            $books = Book::where('title', 'LIKE', "%{$query}%")
                         ->orWhere('author', 'LIKE', "%{$query}%")
                         ->get();

            return response()->json([
                'status' => 'success',
                'books' => $books,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mencari buku.'
            ], 500);
        }
    } 
}
