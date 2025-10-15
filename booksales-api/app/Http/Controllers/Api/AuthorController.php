<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Tampilkan semua author.
     */
    public function index()
    {
        $authors = Author::orderBy('id', 'asc')->get();
        
        return response()->json($authors, 200);
    }

    /**
     * Simpan author baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        $author = Author::create($validated);

        return response()->json($author, 201);
    }

    /**
     * Tampilkan detail author.
     */
    public function show(Author $author)
    {
        return response()->json($author, 200);
    }

    /**
     * Update data author.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        $author->update($validated);

        return response()->json($author, 200);
    }

    /**
     * Hapus author dari database.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully'
        ], 200);
    }
}