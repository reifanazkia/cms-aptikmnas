<!DOCTYPE html>
<html>
<head>
    <title>Daftar Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Partner</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('partners.create') }}" class="btn btn-primary mb-3">+ Tambah Partner</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Website</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $partner->name }}</td>
                    <td>
                        @if($partner->web_address)
                            <a href="{{ $partner->web_address }}" target="_blank">{{ $partner->web_address }}</a>
                        @endif
                    </td>
                    <td>{{ Str::limit($partner->description, 50) }}</td>
                    <td>
                        @if($partner->image)
                            <img src="{{ asset('storage/'.$partner->image) }}" width="80" class="img-thumbnail">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('partners.edit',$partner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('partners.destroy',$partner->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus partner ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
