<!DOCTYPE html>
<html>
<head>
    <title>Tambah Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Tambah Partner</h1>

    <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Partner</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Alamat Website</label>
            <input type="url" name="web_address" class="form-control" value="{{ old('web_address') }}">
            @error('web_address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Detail</label>
            <textarea name="details" class="form-control">{{ old('details') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
