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
                'book' => [
                    "title" => $book->title,
                    "category_name" => $book->category->name,
                    "author" => $book->author,
                    "publication_year" => $book->publication_year,
                    "stock" => $book->stock
                ],
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
            $query = strtolower(trim($request->input('q')));
            $queryTokens = explode(' ', $query);

            $books = Book::all();
            $result = [];

            foreach ($books as $book) {

                $text = strtolower($book->title . ' ' . $book->author);
                $bookTokens = explode(' ', $text);

                $totalDistance = 0;

                foreach ($queryTokens as $qToken) {

                    $minDistance = PHP_INT_MAX;

                    foreach ($bookTokens as $bToken) {
                        $distance = levenshtein($qToken, $bToken);
                        $minDistance = min($minDistance, $distance);
                    }

                    $totalDistance += $minDistance;
                }

                if ($totalDistance <= 5) {
                    $book->distance = $totalDistance;
                    $result[] = $book;
                }
            }

            usort($result, fn($a, $b) => $a->distance <=> $b->distance);

            return response()->json([
                'status' => 'success',
                'books' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mencari buku.'
            ], 500);
        }
    }
}
