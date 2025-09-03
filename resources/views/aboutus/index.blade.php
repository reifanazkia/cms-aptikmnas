@extends('layouts.app', ['title' => 'Tentang Kami'])

@section('content')
    <div class="bg-white p-6 rounded-xl space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Tentang Kami</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi tentang organisasi / perusahaan Anda</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="p-4 bg-emerald-100 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter + Button -->
        <div class="flex justify-between items-center gap-2">
            <select id="categoryFilter"
                class="rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                @endforeach
            </select>

            <a href="{{ route('aboutus.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition">
                + Tambah Data
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Gambar</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-center">Home</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="aboutusTable" class="divide-y divide-gray-200 text-sm">
                    @forelse($aboutus as $item)
                        <tr class="aboutus-row" data-category="{{ $item->category_aboutus_id }}">
                            <td class="px-4 py-3">
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                        class="w-20 h-14 object-cover rounded-md">
                                @else
                                    <div
                                        class="w-20 h-14 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded-md">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-emerald-700">{{ $item->title }}</td>
                            <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ $item->description }}</td>
                            <td class="px-4 py-3">{{ $item->category->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($item->display_on_home)
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs">
                                        Ya
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs">
                                        Tidak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('aboutus.edit', $item->id) }}"
                                    class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">Edit</a>
                                <form action="{{ route('aboutus.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500 bg-gray-50">
                                Belum ada data "Tentang Kami".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script filter kategori client-side -->
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            let selected = this.value;
            document.querySelectorAll('.aboutus-row').forEach(row => {
                if (selected === '' || row.dataset.category === selected) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
