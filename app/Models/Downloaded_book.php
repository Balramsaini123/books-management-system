<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloaded_book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'user_email',
    ];
}
