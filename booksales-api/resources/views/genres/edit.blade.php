@extends('layouts.app') 

@section('title', 'Edit Genre')

@section('content')
    <div class="max-w-lg mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Edit Genre</h1>
            <form action="{{ route('genres.update', $genre->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ $genre->name }}" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label class="block mb-1">Description</label>
                    <textarea name="description" class="w-full border rounded-lg p-2">{{ $genre->description }}</textarea>
                </div>
                <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600">Update</button>
            </form>
        </div>
    </div>
@endsection
