@extends('layouts.app', ['title' => 'Daftar DPD Categories'])

@section('content')
    <!-- Bungkus dengan Alpine -->
    <div x-data="{ openCreate: false, openEdit: null }" class="bg-white p-6 rounded-lg space-y-6">
        <!-- Judul -->
        <div>
            <h1 class="text-3xl font-bold text-emerald-700">Daftar DPD Categories</h1>
            <p class="text-sm text-emerald-600">Kelola data kategori DPD</p>
        </div>

        <!-- Pesan sukses (akan digantikan oleh SweetAlert) -->
        @if (session('success'))
            <div class="hidden" id="success-message">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <button @click="openCreate = true"
            class="px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow-md hover:bg-emerald-700 transition">
            + Tambah Kategori
        </button>

        <!-- Tabel List Data -->
        <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-emerald-100">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-emerald-50 text-emerald-700 font-semibold">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-center">Nama</th>
                        <th class="px-6 py-4 text-center">Email</th>
                        <th class="px-6 py-4 text-center">Phone</th>
                        <th class="px-6 py-4 text-center">Gambar</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100 bg-white">
                    @forelse($categories as $i => $c)
                        <tr class="hover:bg-gray-50 border-b border-emerald-50">
                            <td class="px-6 py-4 text-center">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 text-center font-medium">{{ $c->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $c->email }}</td>
                            <td class="px-6 py-4 text-center">{{ $c->notlp }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($c->image)
                                    <img src="{{ asset('storage/' . $c->image) }}"
                                        class="h-16 w-auto rounded-lg border border-emerald-100">
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 justify-center">
                                    <!-- Tombol Edit -->
                                    <button @click="openEdit = {{ $c->id }}"
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
                                    <button @click="confirmDelete({{ $c->id }}, '{{ $c->name }}')"
                                        class="flex items-center gap-2 px-4 py-2 bg-red-200 hover:bg-red-300 text-red-600 text-sm rounded-lg shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="-3 -2 24 24" fill="currentColor">
                                            <path
                                                d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div x-show="openEdit === {{ $c->id }}" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50" x-transition>
                            <div
                                class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 mx-4 overflow-y-auto max-h-screen">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-bold text-emerald-700">Edit Kategori</h2>
                                    <button @click="openEdit = null" class="text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form id="editForm-{{ $c->id }}"
                                    action="{{ route('category-daftar.update', $c->id) }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-4">
                                    @csrf @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                            <input type="text" name="name" value="{{ $c->name }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <input type="email" name="email" value="{{ $c->email }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">No Tlp</label>
                                            <input type="number" name="notlp" value="{{ $c->notlp }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                                            @if ($c->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $c->image) }}"
                                                        class="h-16 rounded-lg border border-emerald-200 object-cover">
                                                </div>
                                            @endif
                                            <input type="file" name="image"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                                            <input type="text" name="yt" value="{{ $c->yt }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                                            <input type="text" name="fb" value="{{ $c->fb }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                                            <input type="text" name="ig" value="{{ $c->ig }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">TikTok</label>
                                            <input type="text" name="tiktok" value="{{ $c->tiktok }}"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                                        <button type="button" @click="openEdit = null"
                                            class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-emerald-600 font-medium">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah - Diperbarui -->
        <div x-show="openCreate" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
            x-transition>
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 mx-4 overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-emerald-700">Tambah Kategori</h2>
                    <button @click="openCreate = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="createForm" action="{{ route('category-daftar.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="createName"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="createEmail"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No Tlp</label>
                            <input type="number" name="notlp" id="createNotlp"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                            <input type="file" name="image" id="createImage"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                            <input type="text" name="yt" id="createYt"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                            <input type="text" name="fb" id="createFb"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                            <input type="text" name="ig" id="createIg"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">TikTok</label>
                            <input type="text" name="tiktok" id="createTiktok"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                        <button type="button" @click="openCreate = false"
                            class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Hapus Tersembunyi -->
        <form id="deleteForm" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        // SweetAlert untuk konfirmasi hapus
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
                    // Set action form delete
                    const form = document.getElementById('deleteForm');
                    let url = '{{ route('category-daftar.destroy', ':id') }}';
                    url = url.replace(':id', id);
                    form.action = url;

                    // Submit form
                    form.submit();
                }
            });
        }

        // SweetAlert untuk notifikasi sukses dari session
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
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
