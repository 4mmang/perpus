<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class KatalogBukuController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.catalog.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.catalog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)   
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.catalog.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        Book::where('id', $id)->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Data Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
