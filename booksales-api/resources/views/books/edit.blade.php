@extends('layouts.app') 

@section('title', 'Edit Book')

@section('content')
    <div class="max-w-3xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Edit Book</h1>
            <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title" value="{{ $book->title }}" class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block mb-1">Author</label>
                    <select name="author_id" class="w-full border rounded-lg p-2">
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Genre</label>
                    <select name="genre_id" class="w-full border rounded-lg p-2">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Price</label>
                        <input type="number" name="price" step="0.01" value="{{ $book->price }}" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block mb-1">Stock</label>
                        <input type="number" name="stock" value="{{ $book->stock }}" class="w-full border rounded-lg p-2">
                    </div>
                </div>

                <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
