@extends('layouts.app')

@section('title', 'Manajemen Departemen - IT Helpdesk System')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="page-title">Manajemen Departemen</h1>
            <p class="page-subtitle">Kelola data unit kerja pemohon beserta penanggung jawab dan lokasinya.</p>
        </div>

        @can('manage-departemen')
            <a href="{{ route('departemen.create') }}" class="btn btn-gold">+ Tambah Departemen</a>
        @endcan
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <form action="{{ route('departemen.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm search-input"
                placeholder="Cari kode, nama, atau lokasi...">
            <button type="submit" class="btn btn-sm btn-outline-gold px-3">Cari</button>
            @if (request('q'))
                <a href="{{ route('departemen.index') }}" class="btn btn-sm btn-outline-muted">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-helpdesk align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55px;">No</th>
                        <th>Kode</th>
                        <th>Nama Departemen</th>
                        <th>Penanggung Jawab</th>
                        <th>Lokasi</th>
                        <th class="text-center">Jumlah Aset</th>
                        @can('manage-departemen')
                            <th class="text-center">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departemen as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge-pill-sm badge-outline-gold">{{ $item->kode }}</span>
                            </td>
                            <td>
                                @if (Auth::check() && Auth::user()->isUser())
                                    <span class="link-gold">{{ $item->nama }}</span>
                                @else
                                    <a href="{{ route('aset.index', ['departemen_id' => $item->id]) }}" class="link-gold">
                                        {{ $item->nama }}
                                    </a>
                                @endif
                            </td>
                            <td>{{ $item->penanggung_jawab }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td class="text-center">
                                <span class="badge-pill-sm badge-status-aktif">{{ $item->aset_pc_count }} Unit</span>
                            </td>
                            @can('manage-departemen')
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('departemen.edit', $item) }}"
                                        class="btn btn-sm btn-outline-gold me-1">Edit</a>
                                    <form action="{{ route('departemen.destroy', $item) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger-dark">Hapus</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@can('manage-departemen') 7 @else 6 @endcan" class="text-center py-4"
                                style="color: var(--muted);">
                                Belum ada data departemen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
