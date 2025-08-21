<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Contact</h4>
                        <a href="{{ route('contact.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email DPP *</label>
                                        <input type="email" class="form-control" name="email_dpp" value="{{ old('email_dpp') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email DPD *</label>
                                        <input type="email" class="form-control" name="email_dpd" value="{{ old('email_dpd') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat *</label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Telepon *</label>
                                <input type="number" class="form-control" name="notlp" value="{{ old('notlp') }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Instagram URL</label>
                                        <input type="url" class="form-control" name="url_ig" value="{{ old('url_ig') }}" placeholder="https://instagram.com/username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Twitter URL</label>
                                        <input type="url" class="form-control" name="url_twit" value="{{ old('url_twit') }}" placeholder="https://twitter.com/username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">YouTube URL</label>
                                        <input type="url" class="form-control" name="url_yt" value="{{ old('url_yt') }}" placeholder="https://youtube.com/channel/">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Facebook URL</label>
                                        <input type="url" class="form-control" name="url_fb" value="{{ old('url_fb') }}" placeholder="https://facebook.com/username">
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Save Contact</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
