<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block mb-4">
           + Tambah Produk
        </a>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-3">#</th>
                        <th class="p-3">Gambar</th>
                        <th class="p-3">Judul</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Harga Diskon</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="h-12 w-12 object-cover rounded">
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $product->title }}</td>
                            <td class="p-3">
                                @if($product->has_discount)
                                    <span class="line-through text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @else
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="p-3">
                                @if($product->has_discount)
                                    <span class="text-green-600 font-semibold">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $product->category->name ?? '-' }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Detail</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center text-gray-500">Belum ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
