<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gangguan IT</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar-custom">
        <div class="navbar-container">
            <a class="navbar-brand" href="{{ route('gangguan.daftar') }}">Sistem Laporan Gangguan IT</a>
            <div>
                <span class="user-greeting">Halo, {{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role) }})</span>
                <a href="{{ route('gangguan.daftar') }}" class="btn-light-custom">Lihat Daftar</a>
            </div>
        </div>
    </nav>

    <main class="main-container">
        <div class="form-container">
            <h1>Edit Laporan Gangguan IT</h1>
            <p>Perbarui detail laporan gangguan</p>
            <hr>

            @if ($errors->any())
                <div class="alert-danger-custom">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gangguan.update', $gangguan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jenis_gangguan" class="form-label">Jenis Gangguan</label>
                    <input type="text" class="form-control" id="jenis_gangguan" name="jenis_gangguan" value="{{ old('jenis_gangguan', $gangguan->jenis_gangguan) }}" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label for="tingkat_prioritas" class="form-label">Tingkat Prioritas</label>
                    <select class="form-select" id="tingkat_prioritas" name="tingkat_prioritas" required>
                        <option value="Tinggi" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="Sedang" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Rendah" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_gangguan" class="form-label">Deskripsi Gangguan</label>
                    <textarea class="form-control" id="deskripsi_gangguan" name="deskripsi_gangguan" rows="4" maxlength="200" required>{{ old('deskripsi_gangguan', $gangguan->deskripsi_gangguan) }}</textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    <a href="{{ route('gangguan.daftar') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>