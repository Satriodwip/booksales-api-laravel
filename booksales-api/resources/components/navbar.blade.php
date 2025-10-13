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
            <li>
                <a href="{{ route('transactions.index') }}" class="relative group px-1 py-1">
                    Transactions
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-emerald-600 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="relative group px-1 py-1">
                    Users
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-emerald-600 transition-all group-hover:w-full"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>
