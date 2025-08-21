<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Detail Produk</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gambar Produk -->
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}" class="rounded-lg shadow w-full">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold">{{ $product->title }}</h2>
                <p class="text-gray-600">{{ $product->description ?? 'Tidak ada deskripsi' }}</p>

                <div>
                    <span class="font-semibold">Harga: </span>
                    @if($product->has_discount)
                        <span class="line-through text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @else
                        <span class="text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                @if($product->has_discount)
                <div>
                    <span class="font-semibold">Diskon: </span>
                    <span class="text-red-500">{{ $product->discount }}%</span>
                </div>

                <div>
                    <span class="font-semibold">Harga Setelah Diskon: </span>
                    <span class="text-green-600 font-bold">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span><br>
                    <span class="text-sm text-green-500">(Anda hemat Rp {{ number_format($product->total_discount, 0, ',', '.') }})</span>
                </div>
                @endif

                <div>
                    <span class="font-semibold">Kategori: </span>
                    <span>{{ $product->category->name ?? '-' }}</span>
                </div>

                <div>
                    <span class="font-semibold">Disusun Oleh: </span>
                    <span>{{ $product->disusun }}</span>
                </div>

                <div>
                    <span class="font-semibold">Jumlah Modul: </span>
                    <span>{{ $product->jumlah_modul }}</span>
                </div>

                <div>
                    <span class="font-semibold">Bahasa: </span>
                    <span>{{ $product->bahasa }}</span>
                </div>

                <div>
                    <span class="font-semibold">No. Telepon: </span>
                    <span>{{ $product->notlp ?? '-' }}</span>
                    @if($product->formatted_phone)
                        <span class="text-sm text-gray-500">({{ $product->formatted_phone }})</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </div>

</body>
</html>
