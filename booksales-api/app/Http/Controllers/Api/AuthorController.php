<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    try {
        $validated = $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('authors', 'public');
            $validated['photo'] = $path;
        }

        $author = Author::create($validated);
        return response()->json($author, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    /**
     * Tampilkan detail author.
     */
    public function show(Author $author)
    {
        // Tambahkan URL penuh ke photo (jika ada)
        if ($author->photo) {
            $author->photo_url = asset('storage/' . $author->photo);
        }

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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // validasi photo juga di update
        ]);

        // Jika ada file baru, hapus foto lama dan simpan baru
        if ($request->hasFile('photo')) {
            if ($author->photo && Storage::disk('public')->exists($author->photo)) {
                Storage::disk('public')->delete($author->photo);
            }

            $path = $request->file('photo')->store('authors', 'public');
            $validated['photo'] = $path;
        }

        $author->update($validated);

        return response()->json($author, 200);
    }

    /**
     * Hapus author dari database.
     */
    public function destroy(Author $author)
    {
        // Hapus foto dari storage kalau ada
        if ($author->photo && Storage::disk('public')->exists($author->photo)) {
            Storage::disk('public')->delete($author->photo);
        }

        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully'
        ], 200);
    }
}
