<!DOCTYPE html>
<html>
<head>
    <title>CRUD Daftar DPD Category</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h1 class="mb-4">Daftar DPD Categories</h1>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        + Tambah Kategori
    </button>

    <!-- Tabel List Data -->
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Tlp</th>
                <th>Gambar</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $i => $c)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->notlp }}</td>
                <td>
                    @if($c->image)
                        <img src="{{ asset('storage/'.$c->image) }}" alt="image" width="80">
                    @endif
                </td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $c->id }}">Edit</button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('category-daftar.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $c->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('category-daftar.update', $c->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Nama</label>
                                    <input type="text" name="name" value="{{ $c->name }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $c->email }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>No Tlp</label>
                                    <input type="number" name="notlp" value="{{ $c->notlp }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Gambar</label><br>
                                    @if($c->image)
                                        <img src="{{ asset('storage/'.$c->image) }}" width="100" class="mb-2">
                                    @endif
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>YouTube</label>
                                    <input type="text" name="yt" value="{{ $c->yt }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Facebook</label>
                                    <input type="text" name="fb" value="{{ $c->fb }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Instagram</label>
                                    <input type="text" name="ig" value="{{ $c->ig }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>TikTok</label>
                                    <input type="text" name="tiktok" value="{{ $c->tiktok }}" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <tr><td colspan="10" class="text-center">Belum ada data</td></tr>
        @endforelse
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('category-daftar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>No Tlp</label>
                            <input type="number" name="notlp" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>YouTube</label>
                            <input type="text" name="yt" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Facebook</label>
                            <input type="text" name="fb" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Instagram</label>
                            <input type="text" name="ig" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>TikTok</label>
                            <input type="text" name="tiktok" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
