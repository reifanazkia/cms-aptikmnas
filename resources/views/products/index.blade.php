@extends('layouts.app', ['title' => 'Produk'])

@section('content')
    <div class="bg-white p-6 rounded-lg space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <h1 class="text-3xl font-bold text-emerald-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Produk
            </h1>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center px-4 py-2 mt-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg text-green-700">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-red-700">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif

        @if ($products->count() > 0)
            <!-- Versi Mobile (Card) -->
            <div class="sm:hidden space-y-4">
                @foreach ($products as $index => $product)
                    <div class="p-4 bg-white shadow-sm rounded-xl border border-emerald-100">
                        <!-- Header Card -->
                        <div class="flex items-center gap-3 mb-4">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="h-16 w-16 object-cover rounded-lg">
                            @else
                                <div
                                    class="h-16 w-16 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg border">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                                       l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01
                                       M6 20h12a2 2 0
                                       002-2V6a2 2 0
                                       00-2-2H6a2 2 0
                                       00-2 2v12a2 2 0
                                       002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div>
                                <h2 class="font-semibold text-gray-800 leading-tight">{{ $product->title }}</h2>
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    {{ $product->category->name ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3zM12 15v2m0-9V6m-6 6h12" />
                                </svg>
                                @if ($product->has_discount)
                                    <span class="line-through text-gray-400">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-green-600 font-semibold">Rp
                                        {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                @else
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                @endif
                            </p>
                        </div>

                        <!-- Aksi -->
                        <div class="flex gap-2 text-sm">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Detail
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Versi Desktop (Table) -->
            <div class="hidden sm:block">
                <div class="overflow-x-auto rounded-lg border border-emerald-100 bg-white shadow">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="bg-emerald-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-center">No</th>
                                <th class="px-4 py-2 text-center">Gambar</th>
                                <th class="px-4 py-2 text-center">Judul</th>
                                <th class="px-4 py-2 text-center">Harga</th>
                                <th class="px-4 py-2 text-center">Harga Diskon</th>
                                <th class="px-4 py-2 text-center">Kategori</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                    <td class="px-4 py-2 text-center">
                                        {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="h-14 w-1/2 mx-auto rounded">
                                        @else
                                            <div
                                                class="h-14 w-14 flex items-center justify-center bg-gray-100 text-gray-400 rounded mx-auto">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0
                                                               012.828 0L16 16m-2-2
                                                               l1.586-1.586a2 2 0
                                                               012.828 0L20 14m-6-6h.01
                                                               M6 20h12a2 2 0
                                                               002-2V6a2 2 0
                                                               00-2-2H6a2 2 0
                                                               00-2 2v12a2 2 0
                                                               002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center font-medium text-gray-800">{{ $product->title }}</td>
                                    <td class="px-4 py-2 text-center">
                                        @if ($product->has_discount)
                                            <span class="line-through text-gray-500">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @else
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if ($product->has_discount)
                                            <span class="text-green-600 font-semibold">Rp
                                                {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if ($product->category)
                                            <span
                                                class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">Detail</a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-500">
                <p>Belum ada produk</p>
                <a href="{{ route('products.create') }}"
                    class="mt-4 inline-block px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">
                    Tambah Produk
                </a>
            </div>
        @endif
    </div>
@endsection
