@extends('layouts.app') {{-- sesuaikan dengan nama layout utama --}}

@section('title', 'Edit Author')

@section('content')
    <div class="max-w-lg mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Edit Author</h1>
            <form action="{{ route('authors.update', $author->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ $author->name }}" class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block mb-1">Bio</label>
                    <textarea name="bio" class="w-full border rounded-lg p-2">{{ $author->bio }}</textarea>
                </div>

                <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
