<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('id', 'asc')->get();

        if ($genres->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No genres found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genres
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name',
                'description' => 'nullable|string',
            ]);

            $genre = Genre::create($validated);

            return response()->json([
                'success' => true,
                'data' => $genre
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genre
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
                'description' => 'nullable|string',
            ]);

            $genre->update($validated);

            return response()->json([
                'success' => true,
                'data' => $genre
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        try {
            $genre->delete();
            
            if ($genre->books()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete genre with associated books'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Genre deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
