@extends('layouts.app')

@section('title', 'Teknisi & Support Staff - IT Helpdesk System')
@section('topbar-title', 'Modul Teknisi & Support Staff')
@section('menu-teknisi', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Teknisi & Support Staff</h2>
        <p class="text-github-muted mb-0">Pengelolaan data teknisi IT, keahlian khusus (Network/DB/Hardware), dan kontak
            internal.</p>
    </div>
    <a href="#" class="btn btn-custom-gold">
        <i class="bi bi-plus-lg me-1"></i> Tambah Teknisi
    </a>
</div>

<div class="card card-custom shadow-sm">
    <div class="card-body text-center py-5 text-github-muted">
        <i class="bi bi-person-badge fs-1 text-gold d-block mb-2"></i>
        <h5 class="text-white fw-semibold">Halaman Modul Teknisi & Support Staff (Individu B)</h5>
        <p class="small mb-0">Kerangka halaman siap digunakan. Silakan tempel kode tabel modul Teknisi di dalam area
            ini.</p>
    </div>
</div>
@endsection