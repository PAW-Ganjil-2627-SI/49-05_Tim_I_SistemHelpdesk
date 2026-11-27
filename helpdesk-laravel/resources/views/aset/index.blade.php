@extends('layouts.app')

@section('title', 'Manajemen Aset PC - IT Helpdesk System')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="page-title">Manajemen Aset PC</h1>
            <p class="page-subtitle">Kelola data unit kerja dan inventaris PC/laptop per departemen.</p>
        </div>

        @can('manage-aset')
            <a href="{{ route('aset.create') }}" class="btn btn-gold">+ Tambah Aset</a>
        @endcan
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        @if (Auth::check() && Auth::user()->isUser())
            <div class="d-flex align-items-center gap-2">
                <span class="badge-pill-sm badge-outline-gold">
                    Unit Kerja: {{ Auth::user()->departemen?->nama ?? 'Belum Ditentukan' }}
                </span>
            </div>
        @else
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('aset.index', ['q' => request('q')]) }}"
                    @class(['btn-filter', 'active' => !$departemenId])>Semua</a>
                @foreach ($departemenList as $dept)
                    <a href="{{ route('aset.index', ['departemen_id' => $dept->id, 'q' => request('q')]) }}"
                        @class(['btn-filter', 'active' => $departemenId === $dept->id])>{{ $dept->nama }}</a>
                @endforeach
            </div>
        @endif

        <form action="{{ route('aset.index') }}" method="GET" class="d-flex gap-2">
            @if ($departemenId)
                <input type="hidden" name="departemen_id" value="{{ $departemenId }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm search-input"
                placeholder="Cari kode atau nama perangkat...">
            <button type="submit" class="btn btn-sm btn-outline-gold px-3">Cari</button>
            @if (request('q') || $departemenId)
                <a href="{{ route('aset.index') }}" class="btn btn-sm btn-outline-muted">Reset</a>
            @endif
        </form>
    </div>

    @php
        $showActions = Auth::check() && (Gate::allows('manage-aset') || Gate::allows('update-kondisi-aset'));
    @endphp

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-helpdesk align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55px;">No</th>
                        <th>Kode Aset</th>
                        <th>Nama Perangkat</th>
                        <th>Jenis</th>
                        <th>Departemen</th>
                        <th class="text-center">Kondisi</th>
                        <th class="text-center">Status</th>
                        @if ($showActions)
                            <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aset as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $item->kode_aset }}</td>
                            <td>
                                <a href="{{ route('aset.show', $item) }}" class="link-gold">
                                    {{ $item->nama_perangkat }}
                                </a>
                            </td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->departemen?->nama ?? '-' }}</td>
                            <td class="text-center">
                                <span @class([
                                    'badge-pill-sm',
                                    'badge-outline-red' => $item->kondisi === 'Rusak',
                                    'badge-outline-gold' => $item->kondisi !== 'Rusak',
                                ])>
                                    {{ $item->kondisi }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span @class([
                                    'badge-pill-sm',
                                    'badge-status-aktif' => $item->status === 'Aktif',
                                    'badge-status-perbaikan' => $item->status === 'Perbaikan',
                                    'badge-status-rusak' => !in_array($item->status, ['Aktif', 'Perbaikan'], true),
                                ])>
                                    {{ $item->status }}
                                </span>
                            </td>
                            @if ($showActions)
                                <td class="text-center text-nowrap">
                                    @can('manage-aset')
                                        <a href="{{ route('aset.edit', $item) }}"
                                            class="btn btn-sm btn-outline-gold me-1">Edit</a>
                                        <form action="{{ route('aset.destroy', $item) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger-dark">Hapus</button>
                                        </form>
                                    @elsecan('update-kondisi-aset')
                                        <a href="{{ route('aset.kondisi.edit', $item) }}"
                                            class="btn btn-sm btn-outline-gold">Update Kondisi</a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $showActions ? 8 : 7 }}" class="text-center py-4" style="color: var(--muted);">
                                Belum ada data aset PC.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
