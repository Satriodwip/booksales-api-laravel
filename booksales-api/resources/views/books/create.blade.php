@extends('layouts.app') 

@section('title', 'Add Book')

@section('content')
    <div class="max-w-3xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Add New Book</h1>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                           class="w-full border rounded-lg p-2 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Author</label>
                    <select name="author_id" class="w-full border rounded-lg p-2 @error('author_id') border-red-500 @enderror">
                        <option value="">-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Genre</label>
                    <select name="genre_id" class="w-full border rounded-lg p-2 @error('genre_id') border-red-500 @enderror">
                        <option value="">-- Select Genre --</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" 
                               class="w-full border rounded-lg p-2 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" 
                               class="w-full border rounded-lg p-2 @error('stock') border-red-500 @enderror">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Description</label>
                    <textarea name="description" rows="4" 
                              class="w-full border rounded-lg p-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Image Section -->
                <div>
                    <label class="block mb-1 font-medium">Cover Photo</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-emerald-500 transition">
                        <input type="file" name="cover_photo" id="cover_photo" accept="image/*" 
                               class="hidden" onchange="previewImage(event)">
                        <label for="cover_photo" class="cursor-pointer flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Click to upload cover photo</span>
                            <span class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG, GIF, WEBP (Max. 5MB)</span>
                        </label>
                    </div>
                    @error('cover_photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="image-preview" class="mt-4 hidden">
                        <img id="preview" src="" alt="Preview" class="max-w-xs rounded-lg shadow-md">
                        <button type="button" onclick="removeImage()" 
                                class="mt-2 text-red-500 text-sm hover:text-red-700">
                            Remove Image
                        </button>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition">
                        Save Book
                    </button>
                    <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('cover_photo').value = '';
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('preview').src = '';
        }
    </script>
@endsection