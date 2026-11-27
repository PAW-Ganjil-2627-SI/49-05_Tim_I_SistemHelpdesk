@extends('layouts.app')

@section('title', 'Detail Aset PC - IT Helpdesk System')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-md-8 col-lg-6">
            <div class="dark-card">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
                    style="border-color: var(--border) !important;">
                    <div>
                        <div class="detail-label">{{ $aset->kode_aset }}</div>
                        <h1 class="h5 fw-bold mb-0" style="color: var(--gold);">{{ $aset->nama_perangkat }}</h1>
                    </div>
                    <span @class([
                        'badge-pill-sm',
                        'badge-status-aktif' => $aset->status === 'Aktif',
                        'badge-status-perbaikan' => $aset->status === 'Perbaikan',
                        'badge-status-rusak' => !in_array($aset->status, ['Aktif', 'Perbaikan'], true),
                    ])>
                        {{ $aset->status }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="detail-label">Jenis</div>
                        <div class="detail-value">{{ $aset->jenis }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Merek</div>
                        <div class="detail-value">{{ $aset->merek }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Departemen</div>
                        <div class="detail-value">
                            {{ $aset->departemen?->nama ?? '-' }}
                            @if ($aset->departemen)
                                <span style="color: var(--muted);">({{ $aset->departemen->kode }})</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Kondisi</div>
                        <div>
                            <span @class([
                                'badge-pill-sm',
                                'badge-outline-red' => $aset->kondisi === 'Rusak',
                                'badge-outline-gold' => $aset->kondisi !== 'Rusak',
                            ])>
                                {{ $aset->kondisi }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Penanggung Jawab Unit</div>
                        <div class="detail-value">{{ $aset->departemen?->penanggung_jawab ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Tanggal Pembelian</div>
                        <div class="detail-value">
                            {{ $aset->tanggal_pembelian ? $aset->tanggal_pembelian->format('d/m/Y') : '-' }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="detail-label">Spesifikasi</div>
                        <div class="detail-value">{{ $aset->spesifikasi ?: 'Tidak ada catatan spesifikasi.' }}</div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top" style="border-color: var(--border) !important;">
                    @can('manage-aset')
                        <a href="{{ route('aset.edit', $aset) }}" class="btn btn-outline-gold">Edit</a>
                    @elsecan('update-kondisi-aset')
                        <a href="{{ route('aset.kondisi.edit', $aset) }}" class="btn btn-outline-gold">Update Kondisi</a>
                    @endcan
                    <a href="{{ route('aset.index') }}" class="btn btn-outline-muted">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
