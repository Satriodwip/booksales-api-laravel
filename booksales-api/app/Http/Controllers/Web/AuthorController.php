<?php

namespace App\Http\Controllers\Web;

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
        return view('authors.index', compact('authors'));
    }

    /**
     * Tampilkan form tambah author baru.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Simpan author baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        Author::create($request->only(['name', 'bio']));

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    /**
     * Tampilkan form edit author.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update data author.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        $author->update($request->only(['name', 'bio']));

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Hapus author dari database.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
