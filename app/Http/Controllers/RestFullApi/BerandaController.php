<?php

namespace App\Http\Controllers\RestFullApi;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        try {
            dd(request()->header('Authorization'));
            $books = Book::take(5)->latest()->get();
            return response()->json([
                'status' => 'success', 
                'books' => $books
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }
}
