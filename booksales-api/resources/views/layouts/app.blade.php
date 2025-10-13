<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSales</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-gradient-to-r from-emerald-50 to-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center gap-2 text-2xl font-bold text-emerald-600">
            <span>📚</span>
            <span>BookSales</span>
        </div>

        <!-- Menu -->
        <ul class="flex gap-8 text-gray-700 font-medium">
            <li>
                <a href="{{ route('books.index') }}" class="relative group px-1 py-1">
                    Books
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-emerald-600 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('authors.index') }}" class="relative group px-1 py-1">
                    Authors
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-emerald-600 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('genres.index') }}" class="relative group px-1 py-1">
                    Genres
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-emerald-600 transition-all group-hover:w-full"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>

    <!-- Layout: Sidebar + Main -->
    <div class="flex max-w-7xl mx-auto mt-6 px-4 gap-6">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-600 text-white rounded-lg p-4">
            <nav class="space-y-2">
                <a href="/" class="block px-2 py-1 rounded hover:bg-indigo-500">Dashboard</a>
                <a href="/books" class="block px-2 py-1 rounded hover:bg-indigo-500">Books</a>
                <a href="/authors" class="block px-2 py-1 rounded hover:bg-indigo-500">Authors</a>
                <a href="/genres" class="block px-2 py-1 rounded hover:bg-indigo-500">Genres</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 bg-white rounded-lg p-6 shadow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="mt-10 border-t text-center text-sm text-gray-500 py-4">
        &copy; {{ date('Y') }} Satrio Dwi - BookSales
    </footer>

</body>
</html>
