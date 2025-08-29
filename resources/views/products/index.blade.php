@extends('layouts.app', ['title' => 'Produk'])

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-emerald-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Produk
            </h1>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 shadow-sm transition">
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

        <!-- Table -->
        @if ($products->count() > 0)
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
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                                        <!-- Detail -->
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-gray-200 text-sm inline-flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                                <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" />
                                            </svg>
                                            Detail
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="px-3 py-1 bg-green-100 text-green-500 rounded-lg hover:bg-green-200 text-sm inline-flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                                <path
                                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="-3 -2 24 24" fill="currentColor">
                                                    <path
                                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
