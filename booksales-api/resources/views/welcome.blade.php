<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSales</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-indigo-50 flex items-center justify-center min-h-screen">

    <div class="text-center p-8 bg-white rounded-xl shadow-lg">
        <h1 class="text-4xl font-bold mb-4 text-indigo-600">📚 Welcome to BookSales</h1>
        <p class="text-gray-700 mb-6">Manage your books, authors, and genres easily.</p>
        <a href="{{ url('/books') }}" class="px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-500 transition">Go to Book List</a>
    </div>

</body>
</html>
    