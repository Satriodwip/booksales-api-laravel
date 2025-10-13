<button {{ $attributes->merge(['class' => 'px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition shadow-sm']) }}>
    {{ $slot }}
</button>
