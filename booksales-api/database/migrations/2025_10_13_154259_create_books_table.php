<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable(); // <── Tambahkan ini
        $table->string('cover_photo')->nullable(); // <── Tambahkan ini
        $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');
        $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
        $table->decimal('price', 10, 2);
        $table->integer('stock')->default(0);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
