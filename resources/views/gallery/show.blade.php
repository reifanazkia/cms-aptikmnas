<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - {{ $gallery->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-8">
    <!-- Kartu detail -->
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $gallery->title }}</h1>

        {{-- Gambar --}}
        @if($gallery->image)
            <img src="{{ asset('storage/' . $gallery->image) }}"
                 alt="{{ $gallery->title }}"
                 class="w-full max-h-96 object-cover rounded-xl mb-6">
        @endif

        {{-- Deskripsi --}}
        @if($gallery->description)
            <p class="text-gray-700 mb-4">{{ $gallery->description }}</p>
        @endif

        {{-- Detail lain --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 text-sm">
            <div>
                <span class="font-semibold">Kategori:</span>
                {{ $gallery->category->name ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Tanggal Publikasi:</span>
                {{ $gallery->pub_date ? \Carbon\Carbon::parse($gallery->pub_date)->format('d M Y') : '-' }}
            </div>
            <div>
                <span class="font-semibold">Tampilkan di Home:</span>
                {!! $gallery->display_on_home ? '<span class="text-green-600">Ya</span>' : '<span class="text-red-600">Tidak</span>' !!}
            </div>
            <div>
                <span class="font-semibold">Link URL:</span>
                @if($gallery->url)
                    <a href="{{ $gallery->url }}" target="_blank" class="text-blue-600 hover:underline">{{ $gallery->url }}</a>
                @else
                    -
                @endif
            </div>
        </div>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
        <a href="{{ route('gallery.index') }}"
           class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
           ← Kembali ke Daftar
        </a>
    </div>
</div>

</body>
</html>
