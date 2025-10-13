<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fantasy', 'description' => 'Cerita fantasi dengan dunia imajinatif.'],
            ['name' => 'Thriller', 'description' => 'Cerita penuh ketegangan dan misteri.'],
            ['name' => 'Romance', 'description' => 'Kisah cinta dan hubungan antar karakter.'],
            ['name' => 'Science Fiction', 'description' => 'Fiksi ilmiah dengan teknologi masa depan.'],
            ['name' => 'Self Development', 'description' => 'Buku motivasi dan pengembangan diri.'],
        ];

        Genre::insert($genres);
    }
}
