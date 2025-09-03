@extends('layouts.app', ['title' => 'Daftar Kategori Store'])

@section('content')
    <div x-data="categoryHandler()" class="bg-white p-6 rounded-lg space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-2xl font-bold text-emerald-700">Daftar Kategori Store</h1>
                <p class="text-sm text-emerald-600">Kelola data kategori store</p>
            </div>
            <button @click="openCreateModal()"
                class="flex items-center w-[200px] px-5 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Alerts (akan digantikan oleh SweetAlert) -->
        @if (session('success'))
            <div class="hidden" id="success-message">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="hidden" id="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-emerald-50 text-emerald-700 font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Nama Kategori</th>
                        <th class="px-4 py-3 text-center">Tanggal Dibuat</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $index => $item)
                        <tr class=" hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2 justify-center flex gap-2">
                                <button @click="openEditModal(@js($item))"
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
                                <button @click="confirmDelete(@js($item))"
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
                            <td colspan="4" class="px-4 py-3 text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div x-show="createModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-bold text-emerald-700 mb-4">Tambah Kategori</h2>
                <form id="createForm" action="{{ route('category-store.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="name" id="createName"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="createModal = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div x-show="editModal" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-bold text-emerald-700 mb-4">Edit Kategori</h2>
                <form id="editForm" x-ref="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="name" x-model="selected.name" id="editName"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="editModal = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Update
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

    <script>
        function categoryHandler() {
            return {
                createModal: false,
                editModal: false,
                deleteModal: false,
                selected: {},
                openCreateModal() {
                    this.createModal = true;
                },
                openEditModal(item) {
                    this.selected = item;
                    // Set action form dengan ID yang benar
                    this.$refs.editForm.action = `/category-store/${item.id}`;
                    this.editModal = true;
                },
                confirmDelete(item) {
                    this.selected = item;

                    Swal.fire({
                        title: 'Hapus Kategori',
                        html: `Apakah Anda yakin ingin menghapus kategori <b>${item.name}</b>?`,
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
                            form.action = `/category-store/${item.id}`;

                            // Submit form
                            form.submit();
                        }
                    });
                },
                init() {
                    // SweetAlert untuk notifikasi sukses dari session
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

                    // SweetAlert untuk error messages
                    const errorMessage = document.getElementById('error-message');
                    if (errorMessage) {
                        const errors = errorMessage.querySelectorAll('li');
                        let errorText = '';
                        errors.forEach(error => {
                            errorText += `• ${error.textContent}<br>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            html: errorText,
                            confirmButtonText: 'Mengerti'
                        });
                    }
                }
            }
        }
    </script>
@endsection
