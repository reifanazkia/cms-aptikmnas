@extends('layouts.app', ['title' => 'Tentang Kami'])

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-emerald-700">Tentang Kami</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi tentang organisasi / perusahaan Anda</p>
        </div>
        <a href="{{ route('aboutus.create') }}"
           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition">
            + Tambah Data
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="p-4 bg-emerald-100 text-emerald-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Kategori (client-side saja) -->
    <div class="flex items-center gap-2">
        <select id="categoryFilter" class="rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
            @endforeach
        </select>
    </div>

    <!-- Grid Data -->
    <div id="aboutusGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($aboutus as $item)
            <div class="aboutus-item bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition" data-category="{{ $item->category_tentangkami_id }}">
                <!-- Gambar -->
                @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                        No Image
                    </div>
                @endif

                <!-- Konten -->
                <div class="p-5 space-y-3">
                    <h2 class="text-lg font-semibold text-emerald-700">
                        {{ $item->title }}
                    </h2>
                    <p class="text-gray-500 text-sm line-clamp-3">{{ $item->description }}</p>

                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <span>{{ $item->category->nama ?? '-' }}</span>
                        @if($item->display_on_home)
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs">
                                Ditampilkan di Home
                            </span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 pt-3">
                        <a href="{{ route('aboutus.edit', $item->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600">Edit</a>
                        <form action="{{ route('aboutus.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <div class="p-6 text-center text-gray-500 bg-gray-50 rounded-lg">
                    Belum ada data "Tentang Kami".
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Script filter kategori client-side -->
<script>
    document.getElementById('categoryFilter').addEventListener('change', function() {
        let selected = this.value;
        document.querySelectorAll('.aboutus-item').forEach(item => {
            if (selected === '' || item.dataset.category === selected) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection
