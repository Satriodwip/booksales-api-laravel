<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio', // tambahkan bio agar bisa di-mass assign
    ];

    // Jika ingin relasi ke Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
