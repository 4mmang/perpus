<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookLending extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected $guarded = [];
    protected $table = 'book_lending';
}
