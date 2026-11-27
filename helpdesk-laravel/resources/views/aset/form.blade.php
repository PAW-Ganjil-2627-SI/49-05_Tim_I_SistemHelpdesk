@extends('layouts.app')

@section('title', ($aset->exists ? 'Edit' : 'Tambah') . ' Aset PC - IT Helpdesk System')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-md-8 col-lg-6">
            <div class="dark-card">
                <h1 class="dark-card-title">{{ $aset->exists ? 'Edit Aset PC' : 'Tambah Aset PC' }}</h1>

                @if ($errors->any())
                    <div class="alert-helpdesk-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $aset->exists ? route('aset.update', $aset) : route('aset.store') }}" method="POST">
                    @csrf
                    @if ($aset->exists)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="kode_aset" class="form-label">Kode Aset</label>
                            <input type="text" class="form-control" id="kode_aset" name="kode_aset"
                                value="{{ old('kode_aset', $aset->kode_aset) }}" placeholder="Mis. AST-HRD-001" required>
                        </div>

                        <div class="col-md-6">
                            <label for="departemen_id" class="form-label">Departemen</label>
                            <select class="form-select" id="departemen_id" name="departemen_id" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach ($departemenList as $dept)
                                    <option value="{{ $dept->id }}"
                                        @selected((string) old('departemen_id', $aset->departemen_id) === (string) $dept->id)>
                                        {{ $dept->nama }} ({{ $dept->kode }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="nama_perangkat" class="form-label">Nama Perangkat</label>
                            <input type="text" class="form-control" id="nama_perangkat" name="nama_perangkat"
                                value="{{ old('nama_perangkat', $aset->nama_perangkat) }}"
                                placeholder="Mis. PC Rekrutmen 01" required>
                        </div>

                        <div class="col-md-6">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                @foreach (['PC', 'Laptop'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('jenis', $aset->jenis) === $opt)>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="merek" class="form-label">Merek</label>
                            <input type="text" class="form-control" id="merek" name="merek"
                                value="{{ old('merek', $aset->merek) }}" placeholder="Mis. Dell OptiPlex 7010" required>
                        </div>

                        <div class="col-md-4">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-select" id="kondisi" name="kondisi" required>
                                @foreach (['Baik', 'Perlu Servis', 'Rusak'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('kondisi', $aset->kondisi) === $opt)>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                @foreach (['Aktif', 'Perbaikan'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('status', $aset->status) === $opt)>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                value="{{ old('tanggal_pembelian', $aset->tanggal_pembelian?->format('Y-m-d')) }}">
                        </div>

                        <div class="col-12">
                            <label for="spesifikasi" class="form-label">Spesifikasi (Opsional)</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                placeholder="Processor, RAM, Storage, dll.">{{ old('spesifikasi', $aset->spesifikasi) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-gold">Simpan</button>
                        <a href="{{ route('aset.index') }}" class="btn btn-outline-muted">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
