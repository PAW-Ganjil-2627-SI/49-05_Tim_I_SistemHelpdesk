<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 fw-bold mb-0">Daftar Aset PC</h1>
            @auth
                <a href="{{ route('aset.create') }}" class="btn btn-primary">Tambah aset</a>
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
            <div class="btn-group">
                <a href="{{ route('aset.index', ['q' => request('q')]) }}"
                    @class(['btn btn-sm', 'btn-dark' => !request('unit'), 'btn-outline-primary' => request('unit')])>Semua</a>
                @foreach (['HRD', 'Finance', 'OPS'] as $u)
                    <a href="{{ route('aset.index', ['unit' => $u, 'q' => request('q')]) }}"
                        @class(['btn btn-sm', 'btn-dark' => request('unit') == $u, 'btn-outline-primary' => request('unit') != $u])>{{ $u }}</a>
                @endforeach
            </div>

            <form action="{{ route('aset.index') }}" method="GET" class="d-flex gap-2">
                @if (request('unit'))
                    <input type="hidden" name="unit" value="{{ request('unit') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm"
                    placeholder="Cari kode atau nama perangkat">
                <button class="btn btn-sm btn-secondary" type="submit">Cari</button>
            </form>
        </div>

        <div class="table-responsive bg-white p-3 border rounded-1">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th>Kode Aset</th>
                        <th>Nama Perangkat</th>
                        <th>Unit Kerja</th>
                        <th class="text-center">Kondisi</th>
                        <th class="text-center">Status</th>
                        @auth
                            <th class="text-center">Aksi</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aset as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->unit }}</td>
                            <td class="text-center">
                                @if ($item->kondisi == 'Baik')
                                    <span class="badge bg-success">Baik</span>
                                @elseif ($item->kondisi == 'Perlu Servis')
                                    <span class="badge bg-warning text-dark">Perlu Servis</span>
                                @else
                                    <span class="badge bg-danger">Rusak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->status == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-warning text-dark">Perbaikan</span>
                                @endif
                            </td>
                            @auth
                                <td class="text-center">
                                    <a href="{{ route('aset.edit', $item) }}"
                                        class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                    <form action="{{ route('aset.destroy', $item) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>