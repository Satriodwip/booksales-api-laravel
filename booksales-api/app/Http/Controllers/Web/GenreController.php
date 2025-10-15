<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
class GenreController extends Controller
{
    /**
     * Tampilkan semua genre.
     */
    public function index()
    {
        $genres = Genre::orderBy('id', 'asc')->get(); // urut berdasarkan ID
        return view('genres.index', compact('genres'));
    }

    /**
     * Tampilkan form untuk menambahkan genre baru.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Simpan genre baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Genre::create($request->all());

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre created successfully.');
    }

    /**
     * Tampilkan form untuk mengedit genre tertentu.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update genre di database.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre->update($request->all());

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre updated successfully.');
    }

    /**
     * Hapus genre dari database.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre deleted successfully.');
    }
}
