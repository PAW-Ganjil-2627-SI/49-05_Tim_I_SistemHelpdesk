@extends('layouts.app')

{{-- 1. UBAH JUDUL HALAMAN & AKTIFKAN MENU SIDEBAR MODUL KAMU --}}
@section('title', 'Nama Modul - IT Helpdesk System')
@section('topbar-title', 'Manajemen Nama Modul')
{{-- Pilih salah satu menu aktif: menu-kategori | menu-teknisi | menu-faq | menu-aset --}}
@section('menu-faq', 'active')

@section('content')
<!-- Header Judul & Tombol Tambah -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Judul Modul Anda</h2>
        <p class="text-github-muted mb-0">Deskripsi singkat pengelolaan data modul ini.</p>
    </div>
    <a href="#" class="btn btn-custom-gold">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data
    </a>
</div>

<!-- Card Tabel -->
<div class="card card-custom shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-github align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        {{-- =====================================================
                   TEMPEL KOLOM <th> DARI KODINGAN LAMA DI BAWAH INI
                   ===================================================== --}}
                        <th>Kolom 1</th>
                        <th>Kolom 2</th>
                        <th>Status / Prioritas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- =======================================================
                 GANTI BLOK CONTOH INI DENGAN @forelse DARI KODINGAN LAMA
                 ======================================================= --}}
                    <tr>
                        <td class="ps-4 fw-semibold">1</td>
                        <td class="fw-bold text-gold">Contoh Data Utama</td>
                        <td>Contoh Keterangan Data</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection