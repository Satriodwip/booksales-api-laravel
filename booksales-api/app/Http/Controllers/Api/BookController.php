<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Tampilkan semua buku beserta author dan genre.
     */
    public function index()
    {
        $books = Book::with(['author', 'genre'])->orderBy('id', 'desc')->get();

        if ($books->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No books found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $books
        ], 200);
    }

    /**
     * Simpan buku baru ke database.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'genre_id' => 'required|exists:genres,id',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
            ]);

            // Upload cover image jika ada
            if ($request->hasFile('cover_photo')) {
                $image = $request->file('cover_photo');
                $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('covers', $filename, 'public');
                $validated['cover_photo'] = $path;
            }

            $book = Book::create($validated);
            $book->load(['author', 'genre']);

            return response()->json([
                'success' => true,
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan detail buku berdasarkan ID.
     */
    public function show($id)
    {
        $book = Book::with(['author', 'genre'])->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        // Tambahkan URL cover jika ada
        if ($book->cover_photo) {
            $book->cover_photo_url = asset('storage/' . $book->cover_photo);
        }

        return response()->json([
            'success' => true,
            'data' => $book
        ], 200);
    }

    /**
     * Update data buku.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'genre_id' => 'required|exists:genres,id',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            // Jika ada file baru, hapus yang lama dan simpan baru
            if ($request->hasFile('cover_photo')) {
                if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
                    Storage::disk('public')->delete($book->cover_photo);
                }

                $image = $request->file('cover_photo');
                $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('covers', $filename, 'public');
                $validated['cover_photo'] = $path;
            }

            $book->update($validated);
            $book->load(['author', 'genre']);

            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus buku dari database.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        try {
            // Hapus cover jika ada
            if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
                Storage::disk('public')->delete($book->cover_photo);
            }

            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
