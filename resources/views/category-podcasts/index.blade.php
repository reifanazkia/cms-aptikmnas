@extends('layouts.app', ['title' => 'Kategori Podcast'])

@section('content')
    <div class="bg-white p-6 rounded-lg space-y-6">
        <!-- Judul -->
        <div>
            <h1 class="text-3xl font-bold text-emerald-700">Kategori Podcast</h1>
            <p class="text-sm text-emerald-600">Kelola data kategori podcast</p>
        </div>

        <!-- Alert (SweetAlert) -->
        @if (session('success'))
            <div class="hidden" id="success-message">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <button onclick="openAddModal()"
            class="px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow-md hover:bg-emerald-700 transition">
            + Tambah Kategori
        </button>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-emerald-100">
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
                                <!-- Tombol Edit -->
                                <button onclick="openEditModal({{ $item->id }}, '{{ $item->name }}')"
                                    class="flex items-center gap-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-500 text-sm rounded-lg shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                        <path
                                            d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                    </svg>
                                    <span>Edit</span>
                                </button>

                                <!-- Tombol Hapus -->
                                <button onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
                                    class="flex items-center gap-2 px-4 py-2 bg-red-200 hover:bg-red-300 text-red-600 text-sm rounded-lg shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="-3 -2 24 24" fill="currentColor">
                                        <path
                                            d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
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
                        class="w-full rounded-lg px-4 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
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
                        class="w-full rounded-lg px-4 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
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

    <!-- Form Hapus Tersembunyi -->
    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, name) {
            let url = '{{ route('category-podcasts.update', ':id') }}';
            url = url.replace(':id', id);

            const form = document.getElementById('editForm');
            form.action = url;
            document.getElementById('editName').value = name;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.addEventListener('click', function(event) {
            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');

            if (event.target === addModal) closeAddModal();
            if (event.target === editModal) closeEditModal();
        });

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Kategori <b>${name}</b> akan dihapus secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    if (form) {
                        let url = '{{ route('category-podcasts.destroy', ':id') }}';
                        url = url.replace(':id', id);
                        form.action = url;
                        form.submit();
                    }
                }
            });
        }

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
