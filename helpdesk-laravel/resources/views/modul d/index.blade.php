@extends('layouts.app')

@section('title', 'Departemen & Aset PC - IT Helpdesk System')
@section('topbar-title', 'Modul Departemen & Aset PC')
@section('menu-aset', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Departemen & Aset PC</h2>
        <p class="text-github-muted mb-0">Pengelolaan unit kerja pemohon (HRD/Finance/Ops) dan inventaris aset PC/laptop
            per unit.</p>
    </div>
    <a href="#" class="btn btn-custom-gold">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data Aset
    </a>
</div>

<div class="card card-custom shadow-sm">
    <div class="card-body text-center py-5 text-github-muted">
        <i class="bi bi-pc-display fs-1 text-gold d-block mb-2"></i>
        <h5 class="text-white fw-semibold">Halaman Modul Departemen & Aset PC (Individu D)</h5>
        <p class="small mb-0">Kerangka halaman siap digunakan. Silakan tempel kode tabel modul Departemen & Aset di
            dalam area ini.</p>
    </div>
</div>
@endsection