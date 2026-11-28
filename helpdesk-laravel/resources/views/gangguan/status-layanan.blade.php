@extends('layouts.app')

@section('title', 'Status Layanan Eksternal - IT Helpdesk System')
@section('topbar-title', 'Modul Gangguan IT')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Status Layanan Infrastruktur Eksternal ({{ $namaLayanan }})</h2>
        <p class="text-muted mb-0">
            Status Global Saat Ini:
            <span class="badge {{ $statusUmum === 'All Systems Operational' ? 'bg-success' : 'bg-warning text-dark' }} ms-1">
                {{ $statusUmum }}
            </span>
        </p>
    </div>
    <a href="{{ route('gangguan.daftar') }}" class="btn btn-outline-secondary">
        Kembali ke Daftar Gangguan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Komponen / Layanan Jaringan</th>
                        <th style="width: 220px;">Status Operasional</th>
                        <th style="width: 220px;">Terakhir Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarKomponen as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item['name'] }}</td>
                            <td>
                                @if ($item['status'] === 'operational')
                                    <span class="badge bg-success">Operational</span>
                                @elseif ($item['status'] === 'under_maintenance')
                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                @else
                                    <span class="badge bg-danger">{{ ucwords(str_replace('_', ' ', $item['status'])) }}</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ \Carbon\Carbon::parse($item['updated_at'])->format('d M Y, H:i') }} UTC
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Gagal memuat data status layanan dari API.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection