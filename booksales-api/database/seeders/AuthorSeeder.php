<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'J.K. Rowling',
                'bio' => 'Author of the famous Harry Potter series, known for her imaginative storytelling.'
            ],
            [
                'name' => 'George R.R. Martin',
                'bio' => 'Author of A Song of Ice and Fire series, inspiration for Game of Thrones.'
            ],
            [
                'name' => 'Haruki Murakami',
                'bio' => 'Japanese novelist known for his surreal and magical realism in novels.'
            ],
            [
                'name' => 'Stephen King',
                'bio' => 'Master of horror and suspense, author of numerous bestsellers.'
            ],
            [
                'name' => 'Paulo Coelho',
                'bio' => 'Brazilian author, famous for The Alchemist and spiritual storytelling.'
            ],
        ];

        Author::insert($authors);
    }
}
