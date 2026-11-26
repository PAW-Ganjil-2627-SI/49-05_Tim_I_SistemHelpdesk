@extends('layouts.app')

@section('title', 'Edit Gangguan IT - IT Helpdesk System')
@section('topbar-title', 'Modul Kategori Masalah IT')
@section('menu-kategori', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Edit Laporan Gangguan IT</h2>
        <p class="text-github-muted mb-0">Perbarui detail laporan gangguan perangkat atau jaringan.</p>
    </div>
    <a href="{{ route('gangguan.daftar') }}" class="btn btn-outline-gold">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
</div>

<div class="card card-custom shadow-sm">
    <div class="card-body p-4">
        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
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
                <label for="jenis_gangguan" class="form-label text-github-muted small fw-semibold">Jenis Gangguan</label>
                <input type="text" class="form-control form-control-github" id="jenis_gangguan" name="jenis_gangguan" value="{{ old('jenis_gangguan', $gangguan->jenis_gangguan) }}" maxlength="100" required>
            </div>

            <div class="mb-3">
                <label for="tingkat_prioritas" class="form-label text-github-muted small fw-semibold">Tingkat Prioritas</label>
                <select class="form-select form-select-github" id="tingkat_prioritas" name="tingkat_prioritas" required>
                    <option value="Tinggi" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    <option value="Sedang" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Rendah" {{ old('tingkat_prioritas', $gangguan->tingkat_prioritas) === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="deskripsi_gangguan" class="form-label text-github-muted small fw-semibold">Deskripsi Gangguan</label>
                <textarea class="form-control form-control-github" id="deskripsi_gangguan" name="deskripsi_gangguan" rows="4" maxlength="200" required>{{ old('deskripsi_gangguan', $gangguan->deskripsi_gangguan) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-custom-gold">Simpan Perubahan</button>
                <a href="{{ route('gangguan.daftar') }}" class="btn btn-outline-gold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection