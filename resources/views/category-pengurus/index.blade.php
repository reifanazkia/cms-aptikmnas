<!DOCTYPE html>
<html>
<head>
    <title>Category Pengurus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="container">
        <h2 class="mb-3">Daftar Category Pengurus</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>No Tlp</th>
                    <th>Email</th>
                    <th>Youtube</th>
                    <th>Facebook</th>
                    <th>Instagram</th>
                    <th>TikTok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengurus as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" width="80" class="img-thumbnail">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $p->notlp }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->yt }}</td>
                    <td>{{ $p->fb }}</td>
                    <td>{{ $p->ig }}</td>
                    <td>{{ $p->tiktok }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}">Edit</button>
                        <form action="{{ route('category-pengurus.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('category-pengurus.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{ $p->name }}" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Foto</label><br>
                                        @if($p->image)
                                            <img src="{{ asset('storage/'.$p->image) }}" width="100" class="mb-2">
                                        @endif
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>No Tlp</label>
                                        <input type="number" name="notlp" value="{{ $p->notlp }}" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $p->email }}" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Youtube</label>
                                        <input type="text" name="yt" value="{{ $p->yt }}" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>Facebook</label>
                                        <input type="text" name="fb" value="{{ $p->fb }}" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>Instagram</label>
                                        <input type="text" name="ig" value="{{ $p->ig }}" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>TikTok</label>
                                        <input type="text" name="tiktok" value="{{ $p->tiktok }}" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('category-pengurus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Foto</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>No Tlp</label>
                            <input type="number" name="notlp" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Youtube</label>
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
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
