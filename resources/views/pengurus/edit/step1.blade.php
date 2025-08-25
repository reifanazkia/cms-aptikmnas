<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengurus - Step 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Pengurus - Step 1 dari 3</h4>
                            <div>
                                <a href="{{ route('pengurus.show', $pengurus->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <a href="{{ route('pengurus.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 33%"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pengurus.edit.step1.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title', $pengurus->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="descroption" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('descroption') is-invalid @enderror"
                                               id="descroption" name="descroption" value="{{ old('descroption', $pengurus->descroption) }}" required>
                                        @error('descroption')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                          id="address" name="address" rows="3" required>{{ old('address', $pengurus->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{ old('phone', $pengurus->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', $pengurus->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_daftar_id" class="form-label">Kategori Daftar</label>
                                        <select class="form-select @error('category_daftar_id') is-invalid @enderror"
                                                id="category_daftar_id" name="category_daftar_id">
                                            <option value="">Pilih Kategori Daftar</option>
                                            @foreach($categoryDaftar as $category)
                                                <option value="{{ $category->id }}"
                                                        {{ old('category_daftar_id', $pengurus->category_daftar_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_daftar_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_pengurus_id" class="form-label">Kategori Pengurus</label>
                                        <select class="form-select @error('category_pengurus_id') is-invalid @enderror"
                                                id="category_pengurus_id" name="category_pengurus_id">
                                            <option value="">Pilih Kategori Pengurus</option>
                                            @foreach($categoryPengurus as $category)
                                                <option value="{{ $category->id }}"
                                                        {{ old('category_pengurus_id', $pengurus->category_pengurus_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_pengurus_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Foto Profil</label>
                                @if($pengurus->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $pengurus->image) }}" alt="Current Image"
                                             class="img-thumbnail" width="100">
                                        <small class="text-muted d-block">Gambar saat ini</small>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fb" class="form-label">Facebook</label>
                                        <input type="url" class="form-control @error('fb') is-invalid @enderror"
                                               id="fb" name="fb" value="{{ old('fb', $pengurus->fb) }}"
                                               placeholder="https://facebook.com/username">
                                        @error('fb')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ig" class="form-label">Instagram</label>
                                        <input type="url" class="form-control @error('ig') is-invalid @enderror"
                                               id="ig" name="ig" value="{{ old('ig', $pengurus->ig) }}"
                                               placeholder="https://instagram.com/username">
                                        @error('ig')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tiktok" class="form-label">TikTok</label>
                                        <input type="url" class="form-control @error('tiktok') is-invalid @enderror"
                                               id="tiktok" name="tiktok" value="{{ old('tiktok', $pengurus->tiktok) }}"
                                               placeholder="https://tiktok.com/@username">
                                        @error('tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="yt" class="form-label">YouTube</label>
                                        <input type="url" class="form-control @error('yt') is-invalid @enderror"
                                               id="yt" name="yt" value="{{ old('yt', $pengurus->yt) }}"
                                               placeholder="https://youtube.com/channel/...">
                                        @error('yt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Lanjut ke Step 2 <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
