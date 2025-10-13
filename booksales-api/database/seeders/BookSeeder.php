<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'genre_id' => 1,
                'author_id' => 1,
                'description' => 'Petualangan pertama Harry Potter di Hogwarts.',
                'price' => 120000,
                'stock' => 15,
                'cover_photo' => 'harry_potter.jpg',
            ],
            [
                'title' => 'A Game of Thrones',
                'genre_id' => 1,
                'author_id' => 2,
                'description' => 'Kisah perebutan kekuasaan di Westeros.',
                'price' => 150000,
                'stock' => 10,
                'cover_photo' => 'got.jpg',
            ],
            [
                'title' => 'Kafka on the Shore',
                'genre_id' => 4,
                'author_id' => 3,
                'description' => 'Novel penuh simbolisme dan misteri.',
                'price' => 135000,
                'stock' => 8,
                'cover_photo' => 'kafka.jpg',
            ],
            [
                'title' => 'The Shining',
                'genre_id' => 2,
                'author_id' => 4,
                'description' => 'Kisah horor psikologis di hotel berhantu.',
                'price' => 110000,
                'stock' => 12,
                'cover_photo' => 'shining.jpg',
            ],
            [
                'title' => 'The Alchemist',
                'genre_id' => 5,
                'author_id' => 5,
                'description' => 'Perjalanan spiritual seorang penggembala.',
                'price' => 95000,
                'stock' => 20,
                'cover_photo' => 'alchemist.jpg',
            ],
        ];

        Book::insert($books);
    }
}
