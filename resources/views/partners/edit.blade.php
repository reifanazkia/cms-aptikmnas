<!DOCTYPE html>
<html>
<head>
    <title>Edit Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Partner</h1>

    <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Partner</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$partner->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Alamat Website</label>
            <input type="url" name="web_address" class="form-control" value="{{ old('web_address',$partner->web_address) }}">
            @error('web_address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description',$partner->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Detail</label>
            <textarea name="details" class="form-control">{{ old('details',$partner->details) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label><br>
            @if($partner->image)
                <img src="{{ asset('storage/'.$partner->image) }}" width="100" class="mb-2 d-block">
            @endif
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
