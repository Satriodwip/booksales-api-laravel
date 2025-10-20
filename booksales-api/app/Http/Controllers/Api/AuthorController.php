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

        if ($authors->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No authors found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $authors
        ], 200);
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

            return response()->json([
                'success' => true,
                'data' => $author
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Tampilkan detail author berdasarkan ID.
     */
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        if ($author->photo) {
            $author->photo_url = asset('storage/' . $author->photo);
        }

        return response()->json([
            'success' => true,
            'data' => $author
        ], 200);
    }

    /**
     * Update data author.
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                if ($author->photo && Storage::disk('public')->exists($author->photo)) {
                    Storage::disk('public')->delete($author->photo);
                }

                $path = $request->file('photo')->store('authors', 'public');
                $validated['photo'] = $path;
            }

            $author->update($validated);

            return response()->json([
                'success' => true,
                'data' => $author
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Hapus author dari database.
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        try {
            if ($author->photo && Storage::disk('public')->exists($author->photo)) {
                Storage::disk('public')->delete($author->photo);
            }

            $author->delete();

            if ($author->books()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete author with associated books'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Author deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
