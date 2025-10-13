@if (session('success'))
    <div class="bg-emerald-100 border border-emerald-300 text-emerald-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
