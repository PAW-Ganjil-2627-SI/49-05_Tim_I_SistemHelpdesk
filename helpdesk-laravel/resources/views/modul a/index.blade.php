@extends('layouts.app')

@section('title', 'Kategori Masalah IT - IT Helpdesk System')
@section('topbar-title', 'Modul Kategori Masalah IT')
@section('menu-kategori', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Kategori Masalah IT</h2>
        <p class="text-github-muted mb-0">Pengelolaan master jenis gangguan IT (Hardware/Software/Network) dan tingkat
            prioritas.</p>
    </div>
    <a href="#" class="btn btn-custom-gold">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

<div class="card card-custom shadow-sm">
    <div class="card-body text-center py-5 text-github-muted">
        <i class="bi bi-tags fs-1 text-gold d-block mb-2"></i>
        <h5 class="text-white fw-semibold">Halaman Modul Kategori Masalah IT (Individu A)</h5>
        <p class="small mb-0">Kerangka halaman siap digunakan. Silakan tempel kode tabel modul Kategori di dalam area
            ini.</p>
    </div>
</div>
@endsection