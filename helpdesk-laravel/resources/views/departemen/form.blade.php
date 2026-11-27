@extends('layouts.app')

@section('title', ($departemen->exists ? 'Edit' : 'Tambah') . ' Departemen - IT Helpdesk System')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-md-7 col-lg-5">
            <div class="dark-card">
                <h1 class="dark-card-title">{{ $departemen->exists ? 'Edit Departemen' : 'Tambah Departemen' }}</h1>

                @if ($errors->any())
                    <div class="alert-helpdesk-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $departemen->exists ? route('departemen.update', $departemen) : route('departemen.store') }}"
                    method="POST">
                    @csrf
                    @if ($departemen->exists)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Departemen</label>
                        <input type="text" class="form-control" id="kode" name="kode"
                            value="{{ old('kode', $departemen->kode) }}" placeholder="Mis. HRD, FIN, OPS" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Departemen</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ old('nama', $departemen->nama) }}" placeholder="Mis. Human Resources" required>
                    </div>

                    <div class="mb-3">
                        <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                            value="{{ old('penanggung_jawab', $departemen->penanggung_jawab) }}"
                            placeholder="Nama penanggung jawab unit" required>
                    </div>

                    <div class="mb-4">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                            value="{{ old('lokasi', $departemen->lokasi) }}" placeholder="Mis. Gedung A - Lantai 2" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold">Simpan</button>
                        <a href="{{ route('departemen.index') }}" class="btn btn-outline-muted">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
