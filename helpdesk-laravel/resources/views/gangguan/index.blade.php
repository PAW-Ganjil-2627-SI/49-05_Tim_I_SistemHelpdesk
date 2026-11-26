@extends('layouts.app')

@section('title', 'Ajukan Gangguan IT - IT Helpdesk System')
@section('topbar-title', 'Modul Kategori Masalah IT')
@section('menu-kategori', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Form Pengajuan Gangguan IT</h2>
        <p class="text-github-muted mb-0">Laporkan kendala teknis perangkat atau jaringan Anda.</p>
    </div>
    <a href="{{ route('gangguan.daftar') }}" class="btn btn-outline-gold">
        <i class="bi bi-list-ul me-1"></i> Lihat Daftar
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

        <form action="{{ route('gangguan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="jenis_gangguan" class="form-label text-github-muted small fw-semibold">Jenis Gangguan</label>
                <input type="text" class="form-control form-control-github" id="jenis_gangguan" name="jenis_gangguan" value="{{ old('jenis_gangguan') }}" placeholder="Contoh: Jaringan Wi-Fi Mati" maxlength="100" required>
            </div>

            <div class="mb-3">
                <label for="tingkat_prioritas" class="form-label text-github-muted small fw-semibold">Tingkat Prioritas</label>
                <select class="form-select form-select-github" id="tingkat_prioritas" name="tingkat_prioritas" required>
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="Tinggi" {{ old('tingkat_prioritas') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    <option value="Sedang" {{ old('tingkat_prioritas') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Rendah" {{ old('tingkat_prioritas') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="deskripsi_gangguan" class="form-label text-github-muted small fw-semibold">Deskripsi Gangguan</label>
                <textarea class="form-control form-control-github" id="deskripsi_gangguan" name="deskripsi_gangguan" rows="4" maxlength="200" placeholder="Jelaskan detail gangguan maksimal 200 karakter" required>{{ old('deskripsi_gangguan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-custom-gold">Kirim Laporan</button>
                <a href="{{ route('gangguan.daftar') }}" class="btn btn-outline-gold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection