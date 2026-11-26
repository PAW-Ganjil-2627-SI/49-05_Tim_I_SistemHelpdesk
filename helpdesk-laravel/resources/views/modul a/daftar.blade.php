@extends('layouts.app')

@section('title', 'Daftar Gangguan IT - IT Helpdesk System')
@section('topbar-title', 'Modul Kategori Masalah IT')
@section('menu-kategori', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Laporan Gangguan IT</h2>
        <p class="text-github-muted mb-0">Monitoring dan pengelolaan laporan kendala teknis perangkat maupun jaringan.</p>
    </div>
    @auth
        <a href="{{ route('home') }}" class="btn btn-custom-gold">
            <i class="bi bi-plus-lg me-1"></i> Ajukan Gangguan
        </a>
    @endauth
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card card-custom shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-github mb-0" style="--bs-table-bg: transparent; --bs-table-color: inherit;">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Jenis Gangguan</th>
                        <th style="width: 150px;">Tingkat Prioritas</th>
                        <th>Deskripsi</th>
                        <th style="width: 170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gangguan as $index => $item)
                        <tr>
                            <td class="text-github-muted">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item->jenis_gangguan }}</td>
                            <td>
                                @if ($item->tingkat_prioritas === 'Tinggi')
                                    <span class="badge bg-danger">Tinggi</span>
                                @elseif ($item->tingkat_prioritas === 'Sedang')
                                    <span class="badge badge-gold">Sedang</span>
                                @else
                                    <span class="badge badge-draft">Rendah</span>
                                @endif
                            </td>
                            <td class="text-github-muted">{{ $item->deskripsi_gangguan }}</td>
                            <td>
                                @auth
                                    <div class="d-flex align-items-center gap-2">
                                        @can('update', $item)
                                            <a href="{{ route('gangguan.edit', $item) }}" class="btn btn-outline-gold btn-sm py-1 px-2">Edit</a>
                                        @endcan

                                        @can('delete', $item)
                                            <form action="{{ route('gangguan.destroy', $item) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm py-1 px-2">Hapus</button>
                                            </form>
                                        @endcan

                                        @if (Auth::user()->role === 'user')
                                            <span class="badge badge-draft">Hanya Lihat</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-github-muted small">Login untuk melapor</span>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-github-muted py-4">Belum ada data laporan gangguan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection