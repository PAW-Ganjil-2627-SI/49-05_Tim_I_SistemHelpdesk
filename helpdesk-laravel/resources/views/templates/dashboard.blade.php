@extends('layouts.app')

@section('title', 'Dashboard - IT Helpdesk System')
@section('topbar-title', 'Dashboard Ringkasan Sistem')
@section('menu-dashboard', 'active')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-1">Selamat Datang di <span class="text-gold">IT Helpdesk System</span></h2>
    <p class="text-github-muted mb-0">Portal pengelolaan layanan infrastruktur IT, teknisi, basis pengetahuan, dan
        inventaris aset PC.</p>
</div>

<div class="row g-4">
    <!-- Modul A -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom h-100 p-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="p-2 rounded bg-dark border border-secondary text-gold">
                    <i class="bi bi-tags fs-4"></i>
                </div>
                <span class="badge bg-dark border border-secondary text-white-50">Individu A</span>
            </div>
            <h5 class="fw-bold text-white">Kategori Masalah IT</h5>
            <p class="text-github-muted small flex-grow-1">Master jenis gangguan IT (Hardware/Software/Network) &
                tingkat prioritas.</p>
            <a href="{{ Route::has('kategori.index') ? route('kategori.index') : '#' }}"
                class="btn btn-sm btn-outline-warning w-100">Buka Modul →</a>
        </div>
    </div>

    <!-- Modul B -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom h-100 p-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="p-2 rounded bg-dark border border-secondary text-gold">
                    <i class="bi bi-person-badge fs-4"></i>
                </div>
                <span class="badge bg-dark border border-secondary text-white-50">Individu B</span>
            </div>
            <h5 class="fw-bold text-white">Teknisi & Support</h5>
            <p class="text-github-muted small flex-grow-1">Data profil teknisi IT, keahlian khusus
                (Network/DB/Hardware), & kontak internal.</p>
            <a href="{{ Route::has('teknisi.index') ? route('teknisi.index') : '#' }}"
                class="btn btn-sm btn-outline-warning w-100">Buka Modul →</a>
        </div>
    </div>

    <!-- Modul C -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom h-100 p-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="p-2 rounded bg-dark border border-secondary text-gold">
                    <i class="bi bi-journal-text fs-4"></i>
                </div>
                <span class="badge bg-dark border border-secondary text-white-50">Individu C</span>
            </div>
            <h5 class="fw-bold text-white">Knowledge Base / FAQ</h5>
            <p class="text-github-muted small flex-grow-1">Pustaka artikel solusi teknis, panduan mandiri, & langkah
                troubleshooting.</p>
            <a href="{{ Route::has('faq.daftar') ? route('faq.daftar') : '#' }}"
                class="btn btn-sm btn-custom-gold w-100">Buka Modul →</a>
        </div>
    </div>

    <!-- Modul D -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom h-100 p-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="p-2 rounded bg-dark border border-secondary text-gold">
                    <i class="bi bi-pc-display fs-4"></i>
                </div>
                <span class="badge bg-dark border border-secondary text-white-50">Individu D</span>
            </div>
            <h5 class="fw-bold text-white">Departemen & Aset PC</h5>
            <p class="text-github-muted small flex-grow-1">Direktori unit kerja pemohon (HRD/Finance/Ops) & inventaris
                aset PC/laptop.</p>
            <a href="{{ Route::has('aset.index') ? route('aset.index') : '#' }}"
                class="btn btn-sm btn-outline-warning w-100">Buka Modul →</a>
        </div>
    </div>
</div>
@endsection