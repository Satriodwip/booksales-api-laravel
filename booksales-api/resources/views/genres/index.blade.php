@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Genres</h1>
        <button onclick="window.location='{{ route('genres.create') }}'" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-400 transition">
            + Add Genre
        </button>
    </div>

    <div class="bg-white shadow rounded-xl p-4 overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr class="bg-white odd:bg-gray-50 hover:bg-purple-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $genre->name }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ Str::limit($genre->description, 50) }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('genres.edit', $genre->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-400 transition">Edit</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-400 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
