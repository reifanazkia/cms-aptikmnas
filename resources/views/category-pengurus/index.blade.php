@extends('layouts.app', ['title' => 'Daftar Category Pengurus'])

@section('content')
    <div x-data="{ openCreate: false, openDetail: null, openEdit: null }" class="bg-white p-6 space-y-6">
        <!-- Judul -->
        <div>
            <h1 class="text-3xl font-bold text-emerald-700">Daftar Category Pengurus</h1>
            <p class="text-sm text-emerald-600">Kelola data kategori pengurus</p>
        </div>

        <!-- Pesan sukses (akan digantikan oleh SweetAlert) -->
        @if (session('success'))
            <div class="hidden" id="success-message">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <div>
            <button @click="openCreate = true"
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                Tambah
            </button>
        </div>

        <!-- Modal Tambah Data -->
        <div x-show="openCreate" x-transition.opacity
            class="fixed inset-0 z-50 p-4 flex items-center justify-center bg-black/50">
            <div @click.away="openCreate = false" class="bg-white w-full max-w-lg rounded-2xl shadow-lg p-6 space-y-4">
                <!-- Header -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-xl font-semibold text-emerald-700">Tambah Pengurus</h2>
                    <button @click="openCreate = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>

                <!-- Form -->
                <form id="createForm" action="{{ route('category-pengurus.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="name" id="createName" class="w-full border rounded-lg px-3 py-2"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Foto</label>
                        <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No Tlp</label>
                        <input type="text" name="notlp" id="createNotlp" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" id="createEmail" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Youtube</label>
                            <input type="text" name="yt" id="createYt" class="w-full border rounded-lg px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Facebook</label>
                            <input type="text" name="fb" id="createFb" class="w-full border rounded-lg px-3 py-2">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Instagram</label>
                            <input type="text" name="ig" id="createIg" class="w-full border rounded-lg px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">TikTok</label>
                            <input type="text" name="tiktok" id="createTiktok"
                                class="w-full border rounded-lg px-3 py-2">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <button type="button" @click="openCreate = false"
                            class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="min-w-full border bg-white border-gray-200 rounded-lg">
                <thead class="bg-emerald-50 text-emerald-700 font-semibold">
                    <tr>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Foto</th>
                        <th class="px-4 py-2 text-center">Phone</th>
                        <th class="px-4 py-2 text-center">Email</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengurus as $item)
                        <tr class="hover:bg-gray-50 border-b border-emerald-50">
                            <td class="px-4 py-2 text-center">{{ $item->name }}</td>
                            <td class="px-4 py-2 text-center">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Foto"
                                    class="h-12 w-12 object-cover mx-auto rounded-full">
                            </td>
                            <td class="px-4 py-2 text-center">{{ $item->notlp }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->email }}</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center gap-2">
                                    <!-- Tombol Detail -->
                                    <button @click="openDetail = {{ $item->id }}"
                                        class="flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                            <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" />
                                        </svg>
                                        <span>Detail</span>
                                    </button>


                                    <!-- Tombol Edit -->
                                    <button @click="openEdit = {{ $item->id }}"
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

                                    <!-- Tombol Delete -->
                                    <button @click="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
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

                        <!-- Modal Detail -->
                        <div x-show="openDetail === {{ $item->id }}" x-transition.opacity
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div @click.away="openDetail = null"
                                class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 space-y-4">
                                <div class="flex justify-between items-center border-b pb-2">
                                    <h3 class="text-lg font-semibold text-emerald-700">Detail Pengurus</h3>
                                    <button @click="openDetail = null"
                                        class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-semibold">Nama:</span> {{ $item->name }}</p>
                                    <p><span class="font-semibold">No Tlp:</span> {{ $item->notlp }}</p>
                                    <p><span class="font-semibold">Email:</span> {{ $item->email }}</p>
                                    <p><span class="font-semibold">Youtube:</span> {{ $item->yt }}</p>
                                    <p><span class="font-semibold">Facebook:</span> {{ $item->fb }}</p>
                                    <p><span class="font-semibold">Instagram:</span> {{ $item->ig }}</p>
                                    <p><span class="font-semibold">TikTok:</span> {{ $item->tiktok }}</p>
                                </div>
                                <div class="flex justify-end pt-3">
                                    <button @click="openDetail = null"
                                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div x-show="openEdit === {{ $item->id }}" x-transition.opacity
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div @click.away="openEdit = null"
                                class="bg-white w-full max-w-lg rounded-2xl shadow-lg p-6 space-y-4">
                                <div class="flex justify-between items-center border-b pb-3">
                                    <h2 class="text-xl font-semibold text-emerald-700">Edit Pengurus</h2>
                                    <button @click="openEdit = null"
                                        class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>

                                <!-- Form Edit -->
                                <form id="editForm-{{ $item->id }}"
                                    action="{{ route('category-pengurus.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="block text-sm font-medium">Nama</label>
                                        <input type="text" name="name" value="{{ $item->name }}"
                                            class="w-full border rounded-lg px-3 py-2" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium">Foto</label>
                                        <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium">No Tlp</label>
                                        <input type="text" name="notlp" value="{{ $item->notlp }}"
                                            class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium">Email</label>
                                        <input type="email" name="email" value="{{ $item->email }}"
                                            class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium">Youtube</label>
                                            <input type="text" name="yt" value="{{ $item->yt }}"
                                                class="w-full border rounded-lg px-3 py-2">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Facebook</label>
                                            <input type="text" name="fb" value="{{ $item->fb }}"
                                                class="w-full border rounded-lg px-3 py-2">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium">Instagram</label>
                                            <input type="text" name="ig" value="{{ $item->ig }}"
                                                class="w-full border rounded-lg px-3 py-2">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">TikTok</label>
                                            <input type="text" name="tiktok" value="{{ $item->tiktok }}"
                                                class="w-full border rounded-lg px-3 py-2">
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-2 pt-4 border-t">
                                        <button type="button" @click="openEdit = null"
                                            class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Batal</button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Hapus Tersembunyi -->
        <form id="deleteForm" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert untuk konfirmasi hapus
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Pengurus <b>${name}</b> akan dihapus secara permanen.`,
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
                    let url = '{{ route('category-pengurus.destroy', ':id') }}';
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

            // SweetAlert untuk form edit (untuk setiap form edit)

        });
    </script>
@endsection
