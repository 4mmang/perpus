<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLending;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalBook = Book::count();
        $totalStatusPending = BookLending::where('status', 'pending')->count();
        $totalStatusBorrowed = BookLending::where('status', 'borrowed')->count();
        $totalStatusReturned = BookLending::where('status', 'returned')->count();
        $totalStatusOverdue = BookLending::where('status', 'overdue')->count();
        return view('admin.dashboard', compact(
            'totalCategory',
            'totalBook',
            'totalStatusPending',
            'totalStatusBorrowed',
            'totalStatusReturned',
            'totalStatusOverdue'
        ));
    }
}
