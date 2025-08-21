<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategori Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h1 class="mb-4">Kategori Gallery</h1>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        + Tambah Kategori
    </button>

    {{-- Tabel --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Kategori</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gallery as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('category-gallery.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('category-gallery.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Kategori</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                              <label>Nama Kategori</label>
                              <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
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
            @endforeach
        </tbody>
    </table>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('category-gallery.store') }}" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kategori</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                  <label>Nama Kategori</label>
                  <input type="text" name="name" class="form-control" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
