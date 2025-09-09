@extends('layouts.app', ['title' => 'Kategori Podcast'])

@section('content')
<div class="bg-white p-6 rounded-lg space-y-6">
    <!-- Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="md:flex md:flex-col">
            <h1 class="text-3xl font-bold text-emerald-700">Kategori Podcast</h1>
            <p class="text-sm text-emerald-600">Kelola data kategori Podcast</p>
        </div>

        <!-- Tombol Tambah -->
        <button onclick="openAddModal()"
            class="px-5 py-3 mt-4 md:mt-0 rounded-xl bg-emerald-600 text-white font-semibold shadow-md hover:bg-emerald-700 transition">
            + Tambah Kategori
        </button>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div id="success-message" class="hidden">{{ session('success') }}</div>
    @endif

    <!-- Mobile: Card -->
    <div class="sm:hidden space-y-4">
        @forelse ($podcats as $index => $item)
            <div class="p-4 bg-white shadow rounded-xl border border-emerald-100">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-medium text-emerald-600">#{{ $index + 1 }}</span>
                    <div class="flex space-x-2">
                        <!-- Edit -->
                        <button onclick="openEditModal({{ $item->id }}, '{{ $item->name }}')"
                            class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583z"/>
                                <path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158a.29.29 0 0 1-.179.01H5V5h6.847l2-2H5a2 2 0 0 0-2 2v14c0 1.103.897 2 2 2"/>
                            </svg>
                        </button>
                        <!-- Hapus -->
                        <button onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
                            class="p-2 bg-red-200 hover:bg-red-300 text-red-600 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2A3 3 0 0 1 14.994 21H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7H4.141z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-gray-800 font-semibold">{{ $item->name }}</p>
            </div>
        @empty
            <div class="p-6 text-center text-emerald-600 bg-emerald-50 rounded-xl">
                Belum ada data
            </div>
        @endforelse
    </div>

    <!-- Desktop: Table -->
    <div class="hidden sm:block overflow-x-auto bg-white shadow-md rounded-xl border border-emerald-100">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-emerald-50 text-emerald-700 font-semibold">
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 text-center">Nama Kategori</th>
                    <th class="px-6 py-4 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-emerald-100">
                @forelse ($podcats as $index => $item)
                    <tr class="hover:bg-gray-50 border-b border-emerald-50">
                        <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-center font-medium">{{ $item->name }}</td>
                        <td class="px-6 py-4 flex space-x-3 justify-center">
                            <!-- Edit -->
                            <button onclick="openEditModal({{ $item->id }}, '{{ $item->name }}')"
                                class="flex items-center gap-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-600 text-sm rounded-lg shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583z"/>
                                    <path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158a.29.29 0 0 1-.179.01H5V5h6.847l2-2H5a2 2 0 0 0-2 2v14c0 1.103.897 2 2 2"/>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <!-- Hapus -->
                            <button onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
                                class="flex items-center gap-2 px-4 py-2 bg-red-200 hover:bg-red-300 text-red-600 text-sm rounded-lg shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2A3 3 0 0 1 14.994 21H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7H4.141z"/>
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-emerald-600 font-medium">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="addModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <h2 class="text-xl font-bold text-emerald-700 mb-4">Tambah Kategori</h2>
        <form id="addForm" action="{{ route('category-podcasts.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Kategori</label>
                <input type="text" name="name" id="addName"
                    class="w-full rounded-lg px-2 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeAddModal()"
                    class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">Batal</button>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <h2 class="text-xl font-bold text-emerald-700 mb-4">Edit Kategori</h2>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Kategori</label>
                <input type="text" name="name" id="editName"
                    class="w-full px-2 py-2 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()"
                    class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">Batal</button>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Modal Tambah
    function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }

    // Modal Edit
    function openEditModal(id, name) {
        let url = '{{ route('category-podcasts.update', ':id') }}'.replace(':id', id);
        document.getElementById('editForm').action = url;
        document.getElementById('editName').value = name;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

    // Tutup modal klik luar
    document.addEventListener('click', (e) => {
        if (e.target.id === 'addModal') closeAddModal();
        if (e.target.id === 'editModal') closeEditModal();
    });

    // Konfirmasi hapus
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `Kategori <b>${name}</b> akan dihapus permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = '{{ route('category-podcasts.destroy', ':id') }}'.replace(':id', id);
                const form = document.getElementById('deleteForm');
                form.action = url;
                form.submit();
            }
        });
    }

    // Notifikasi sukses
    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = document.getElementById('success-message');
        if (successMessage && successMessage.textContent.trim() !== '') {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: successMessage.textContent,
                timer: 3000,
                showConfirmButton: false
            });
        }
    });
</script>
@endsection
