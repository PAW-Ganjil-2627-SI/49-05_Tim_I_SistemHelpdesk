<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $aset->exists ? 'Edit' : 'Tambah' }} Aset PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-sm p-4">
                    <h3 class="fw-bold mb-3 border-bottom pb-2">{{ $aset->exists ? 'Edit' : 'Tambah' }} Aset PC</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ $aset->exists ? route('aset.update', $aset) : route('aset.store') }}" method="POST">
                        @csrf
                        @if ($aset->exists)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Aset</label>
                            <input type="text" class="form-control" name="kode"
                                value="{{ old('kode', $aset->kode) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Perangkat</label>
                            <input type="text" class="form-control" name="nama"
                                value="{{ old('nama', $aset->nama) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Unit Kerja</label>
                            <select class="form-select" name="unit" required>
                                @foreach (['HRD', 'Finance', 'OPS'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('unit', $aset->unit) == $opt)>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kondisi</label>
                            <select class="form-select" name="kondisi" required>
                                @foreach (['Baik', 'Perlu Servis', 'Rusak'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('kondisi', $aset->kondisi) == $opt)>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status" required>
                                @foreach (['Aktif', 'Perbaikan'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('status', $aset->status) == $opt)>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('aset.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>