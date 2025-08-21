<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="bg-white shadow-md rounded-2xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Daftar Kategori Kegiatan</h1>
            <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Tambah Kategori
            </button>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nama Kategori</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan as $index => $item)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $item->name }}</td>
                        <td class="border px-4 py-2 text-center">
                            <!-- Tombol Edit -->
                            <button
                                onclick="openEditModal({{ $item->id }}, '{{ $item->name }}')"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('category-kegiatan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($kegiatan->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Tambah Kategori</h2>
            <form action="{{ route('category-kegiatan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 mt-1" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="name" id="editName" class="w-full border rounded-lg px-3 py-2 mt-1" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, name) {
            let url = '{{ route("category-kegiatan.update", ":id") }}';
            url = url.replace(':id', id);

            const form = document.getElementById('editForm');
            form.action = url;
            document.getElementById('editName').value = name;

            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>
