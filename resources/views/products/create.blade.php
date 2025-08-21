<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Judul</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div>
                <label class="block mb-1">Harga</label>
                <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Diskon (%)</label>
                <input type="number" name="discount" class="w-full border rounded px-3 py-2" min="0" max="100">
            </div>

            <div>
                <label class="block mb-1">Disusun Oleh</label>
                <input type="text" name="disusun" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Jumlah Modul</label>
                <input type="number" name="jumlah_modul" class="w-full border rounded px-3 py-2" min="1" >
            </div>

            <div>
                <label class="block mb-1">Bahasa</label>
                <input type="text" name="bahasa" class="w-full border rounded px-3 py-2" >
            </div>

            <div>
                <label class="block mb-1">No. Telepon</label>
                <input type="text" name="notlp" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1">Kategori</label>
                <select name="category_store_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1">Gambar</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
        </form>
    </div>

</body>
</html>
