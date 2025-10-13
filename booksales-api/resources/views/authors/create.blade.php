@extends('layouts.app') {{-- sesuaikan dengan nama layout utama --}}

@section('title', 'Add Author')

@section('content')
    <div class="max-w-lg mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Add New Author</h1>
            <form action="{{ route('authors.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block mb-1">Bio</label>
                    <textarea name="bio" class="w-full border rounded-lg p-2"></textarea>
                </div>

                <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600">
                    Save
                </button>
            </form>
        </div>
    </div>
@endsection
