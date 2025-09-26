@extends('layouts.app', ['title' => 'Kategori Pengurus'])

@section('content')
    <div class="bg-white p-6 rounded-lg space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:flex md:flex-col">
                <h1 class="text-3xl font-bold text-emerald-700">Kategori Pengurus</h1>
                <p class="text-sm text-emerald-600">Kelola data kategori Pengurus</p>
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
            @forelse ($pengurus as $index => $item)
                <div class="p-4 bg-white shadow rounded-xl border border-emerald-100">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-emerald-600">#{{ $index + 1 }}</span>
                        <div class="flex space-x-2">
                            <!-- Edit -->
                            <button
                                onclick="openEditModal({{ $item->id }}, '{{ $item->name }}', '{{ $item->notlp }}', '{{ $item->email }}', '{{ $item->yt }}', '{{ $item->fb }}', '{{ $item->ig }}', '{{ $item->tiktok }}', '{{ $item->image }}')"
                                class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583z" />
                                    <path
                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158a.29.29 0 0 1-.179.01H5V5h6.847l2-2H5a2 2 0 0 0-2 2v14c0 1.103.897 2 2 2" />
                                </svg>
                            </button>
                            <!-- Hapus -->
                            <button onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
                                class="p-2 bg-red-200 hover:bg-red-300 text-red-600 rounded-lg shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2A3 3 0 0 1 14.994 21H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7H4.141z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-800 font-semibold">{{ $item->name }}</p>
                    <p class="text-gray-600 text-sm">Telp: {{ $item->notlp }} | Email: {{ $item->email }}</p>
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
                        <th class="px-6 py-4 text-center">Telp / Email</th>
                        <th class="px-6 py-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100">
                    @forelse ($pengurus as $index => $item)
                        <tr class="hover:bg-gray-50 border-b border-emerald-50">
                            <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-center font-medium">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-center text-sm">{{ $item->notlp }} / {{ $item->email }}</td>
                            <td class="px-6 py-4 flex space-x-3 justify-center">
                                <!-- Edit -->
                                <button
                                    onclick="openEditModal({{ $item->id }}, '{{ $item->name }}', '{{ $item->notlp }}', '{{ $item->email }}', '{{ $item->yt }}', '{{ $item->fb }}', '{{ $item->ig }}', '{{ $item->tiktok }}', '{{ $item->image }}')"
                                    class="flex items-center gap-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-600 text-sm rounded-lg shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583z" />
                                        <path
                                            d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158a.29.29 0 0 1-.179.01H5V5h6.847l2-2H5a2 2 0 0 0-2 2v14c0 1.103.897 2 2 2" />
                                    </svg>
                                    <span>Edit</span>
                                </button>
                                <!-- Hapus -->
                                <button onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')"
                                    class="flex items-center gap-2 px-4 py-2 bg-red-200 hover:bg-red-300 text-red-600 text-sm rounded-lg shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2A3 3 0 0 1 14.994 21H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7H4.141z" />
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-emerald-600 font-medium">
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
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg">

            <!-- Header (tetap di atas) -->
            <div class="px-6 pt-6 pb-4">
                <h2 class="text-xl font-bold text-emerald-700">Tambah Kategori</h2>
            </div>

            <!-- Form Scrollable -->
            <form id="addForm" action="{{ route('category-pengurus.store') }}" method="POST"
                enctype="multipart/form-data" class="px-6 py-6 space-y-6 max-h-[65vh] overflow-y-auto">
                @csrf

                <!-- Data Utama -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Data Utama</h3>
                    <div class="grid grid-cols-2 grid-row-5 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Kategori</label>
                            <input type="text" name="name"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">No. Telp</label>
                            <input type="text" name="notlp"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>

                        <!-- Upload Image -->
                        <div x-data="imageUploadCreate()" class="space-y-2 row-start-2 col-span-2">
                            <label class="block text-sm font-medium mb-1">Image</label>

                            <!-- Area Upload (hanya tampil kalau belum ada foto) -->
                            <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag=true"
                                x-on:dragleave.prevent="isDrag=false" x-on:drop.prevent="handleDrop($event)"
                                :class="{
                                    'border-emerald-400 bg-emerald-50': isDrag,
                                    'border-gray-300': !isDrag
                                }"
                                class="cursor-pointer rounded-lg border-2 p-6 flex flex-col items-center justify-center text-center transition-colors">

                                <!-- Icon Upload -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 15a4 4 0 004 4h9a4 4 0 000-8 6 6 0 10-11 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 11v6m-3-3 3-3 3 3" />
                                </svg>

                                <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                                <p class="text-xs text-gray-400">PNG, JPG, GIF (maks 2MB)</p>

                                <input type="file" name="image" accept="image/*" x-ref="fileInput" class="hidden"
                                    x-on:change="handleFiles($event.target.files)" required />
                            </div>

                            <!-- Preview (hanya tampil kalau sudah ada foto) -->
                            <div x-show="previewUrl" class="mt-2">
                                <img :src="previewUrl" class="max-h-40 rounded-md shadow" />
                                <button type="button" x-on:click="clear()"
                                    class="mt-3 px-3 py-1 text-sm rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                    Hapus
                                </button>
                            </div>

                            <p x-text="error" class="text-xs text-red-600"></p>
                        </div>
                    </div>
                </div>

                <!-- Sosial Media -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Sosial Media</h3>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">YouTube</label>
                            <input type="text" name="yt"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Facebook</label>
                            <input type="text" name="fb"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Instagram</label>
                            <input type="text" name="ig"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">TikTok</label>
                            <input type="text" name="tiktok"
                                class="w-full rounded-lg px-3 py-2 border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                </div>
            </form>

            <!-- Footer (tetap di bawah) -->
            <div class="px-6 py-4 flex justify-end space-x-3">
                <button type="button" onclick="closeAddModal()"
                    class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">Batal</button>
                <button type="submit" form="addForm"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Simpan</button>
            </div>
        </div>
    </div>




    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative">
            <h2 class="text-xl font-bold text-emerald-700 mb-4">Edit Kategori Pengurus</h2>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold">Nama</label>
                    <input id="editName" type="text" name="name"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold">No. Telepon</label>
                    <input id="editNotlp" type="text" name="notlp"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold">Email</label>
                    <input id="editEmail" type="email" name="email"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2">
                </div>

                <!-- Social Media -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold">YouTube</label>
                        <input id="editYt" type="text" name="yt"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">Facebook</label>
                        <input id="editFb" type="text" name="fb"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">Instagram</label>
                        <input id="editIg" type="text" name="ig"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">TikTok</label>
                        <input id="editTiktok" type="text" name="tiktok"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>
                </div>

                <!-- Upload Image -->
                <div id="editImageWrapper" x-data="imageUploadEdit()" class="space-y-2">
                    <label class="block text-sm font-semibold">Image</label>

                    <!-- Area Upload -->
                    <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag=true"
                        x-on:dragleave.prevent="isDrag=false" x-on:drop.prevent="handleDrop($event)"
                        :class="{
                            'border-emerald-400 bg-emerald-50': isDrag,
                            'border-gray-300': !isDrag
                        }"
                        class="cursor-pointer rounded-lg border-2 border-dashed p-6 flex flex-col items-center justify-center text-center transition-colors">

                        <!-- Icon Upload -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 15a4 4 0 004 4h9a4 4 0 000-8 6 6 0 10-11 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 11v6m-3-3 3-3 3 3" />
                        </svg>

                        <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                        <p class="text-xs text-gray-400">PNG, JPG, GIF (maks 2MB)</p>

                        <input type="file" name="image" accept="image/*" x-ref="fileInput" class="hidden"
                            x-on:change="handleFiles($event.target.files)" />
                    </div>

                    <!-- Preview -->
                    <div x-show="previewUrl" class="mt-2">
                        <img :src="previewUrl" class="max-h-40 rounded-md shadow">
                        <div class="mt-3 flex gap-2">
                            <button type="button" x-on:click="triggerInput"
                                class="px-3 py-1 text-sm rounded-lg border hover:bg-gray-50">
                                Ganti
                            </button>
                            <button type="button" x-on:click="clear"
                                class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <p x-text="error" class="text-xs text-red-600"></p>
                </div>



                <!-- Tombol -->
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">
                        Simpan Perubahan
                    </button>
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
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, name, notlp, email, yt, fb, ig, tiktok, image) {
            // set action form
            let url = '{{ route('category-pengurus.update', ':id') }}'.replace(':id', id);
            document.getElementById('editForm').action = url;

            // isi field input
            document.getElementById('editName').value = name;
            document.getElementById('editNotlp').value = notlp;
            document.getElementById('editEmail').value = email;
            document.getElementById('editYt').value = yt;
            document.getElementById('editFb').value = fb;
            document.getElementById('editIg').value = ig;
            document.getElementById('editTiktok').value = tiktok;

            // preview gambar lama
            const uploadComp = document.querySelector('#editImageWrapper');
            if (uploadComp) {
                const alpine = Alpine.$data(uploadComp);
                alpine.previewUrl = image ? "{{ asset('storage') }}/" + image : null;
                alpine.error = "";
            }

            // tampilkan modal
            document.getElementById('editModal').classList.remove('hidden');
        }


        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.addEventListener('click', (e) => {
            if (e.target.id === 'addModal') closeAddModal();
            if (e.target.id === 'editModal') closeEditModal();
        });

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
                    let url = '{{ route('category-pengurus.destroy', ':id') }}'.replace(':id', id);
                    const form = document.getElementById('deleteForm');
                    form.action = url;
                    form.submit();
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

    <script>
        function imageUploadCreate() {
            return {
                isDrag: false,
                previewUrl: null,
                error: "",
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];

                    // Validasi jenis file
                    if (!file.type.startsWith("image/")) {
                        this.error = "File harus berupa gambar!";
                        return;
                    }

                    // Validasi ukuran (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        this.error = "Ukuran maksimal 2MB!";
                        return;
                    }

                    this.error = "";
                    this.previewUrl = URL.createObjectURL(file);
                },
                handleDrop(e) {
                    this.isDrag = false;
                    this.handleFiles(e.dataTransfer.files);
                },
                clear() {
                    this.previewUrl = null;
                    this.$refs.fileInput.value = "";
                }
            };
        }
    </script>

    <script>
        function imageUploadEdit(config = {}) {
            return {
                previewUrl: config.preview || null,
                isDrag: false,
                error: '',
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];

                    // Validasi size (contoh: max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        this.error = 'Ukuran file maksimal 2MB';
                        return;
                    }

                    this.error = '';
                    const reader = new FileReader();
                    reader.onload = e => this.previewUrl = e.target.result;
                    reader.readAsDataURL(file);
                },
                handleDrop(e) {
                    this.isDrag = false;
                    this.handleFiles(e.dataTransfer.files);
                    this.$refs.fileInput.files = e.dataTransfer.files;
                },
                clear() {
                    this.previewUrl = null;
                    this.$refs.fileInput.value = '';
                }
            }
        }
    </script>
@endsection
