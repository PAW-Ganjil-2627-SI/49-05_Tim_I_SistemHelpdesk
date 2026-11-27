@extends('layouts.app')

@section('title', 'Update Kondisi Aset - IT Helpdesk System')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-md-7 col-lg-5">
            <div class="dark-card">
                <h1 class="dark-card-title">Update Kondisi Aset PC</h1>

                @if ($errors->any())
                    <div class="alert-helpdesk-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-4 p-3 rounded" style="background-color: var(--bg); border: 1px solid var(--border);">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="detail-label">Kode Aset</div>
                            <div class="detail-value">{{ $aset->kode_aset }}</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Departemen</div>
                            <div class="detail-value">{{ $aset->departemen?->nama ?? '-' }}</div>
                        </div>
                        <div class="col-12">
                            <div class="detail-label">Nama Perangkat</div>
                            <div class="detail-value" style="color: var(--gold);">{{ $aset->nama_perangkat }}</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Jenis</div>
                            <div class="detail-value">{{ $aset->jenis }}</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Merek</div>
                            <div class="detail-value">{{ $aset->merek }}</div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('aset.kondisi.update', $aset) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi Perangkat</label>
                        <select class="form-select" id="kondisi" name="kondisi" required>
                            @foreach (['Baik', 'Perlu Servis', 'Rusak'] as $opt)
                                <option value="{{ $opt }}" @selected(old('kondisi', $aset->kondisi) === $opt)>
                                    {{ $opt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status Operasional</label>
                        <select class="form-select" id="status" name="status" required>
                            @foreach (['Aktif', 'Perbaikan'] as $opt)
                                <option value="{{ $opt }}" @selected(old('status', $aset->status) === $opt)>
                                    {{ $opt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold">Simpan Perubahan</button>
                        <a href="{{ route('aset.index') }}" class="btn btn-outline-muted">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
