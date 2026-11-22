@extends('layouts.app')

@section('title', 'Edit Artikel FAQ - IT Helpdesk System')
@section('topbar-title', 'Edit Artikel Solusi Teknis')
@section('menu-faq', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom p-4 shadow-sm">
            <div class="mb-4 pb-2 border-bottom border-secondary">
                <h3 class="fw-bold text-gold mb-0">Edit Artikel Solusi</h3>
            </div>

            <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold text-white">Judul Artikel Solusi /
                        Troubleshooting</label>
                    <input type="text" name="judul" id="judul" class="form-control"
                        value="{{ old('judul', $faq->judul) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label fw-semibold text-white">Kategori Masalah</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="Hardware"
                                {{ old('kategori', $faq->kategori) == 'Hardware' ? 'selected' : '' }}>Hardware</option>
                            <option value="Software"
                                {{ old('kategori', $faq->kategori) == 'Software' ? 'selected' : '' }}>Software</option>
                            <option value="Jaringan"
                                {{ old('kategori', $faq->kategori) == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                            <option value="Akses & Akun"
                                {{ old('kategori', $faq->kategori) == 'Akses & Akun' ? 'selected' : '' }}>Akses & Akun
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="penulis" class="form-label fw-semibold text-white">Nama Penulis / Teknisi</label>
                        <input type="text" name="penulis" id="penulis" class="form-control"
                            value="{{ old('penulis', $faq->penulis) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="langkah_troubleshooting" class="form-label fw-semibold text-white">Langkah-Langkah
                        Troubleshooting / Solusi</label>
                    <textarea name="langkah_troubleshooting" id="langkah_troubleshooting" rows="5" class="form-control"
                        required>{{ old('langkah_troubleshooting', $faq->langkah_troubleshooting) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold d-block text-gold">Status Artikel</label>
                    @if (Auth::user()->hasRole('admin'))
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusPublished"
                            value="Published" {{ old('status', $faq->status) == 'Published' ? 'checked' : '' }}>
                        <label class="form-check-label text-white" for="statusPublished">Published</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusDraft" value="Draft"
                            {{ old('status', $faq->status) == 'Draft' ? 'checked' : '' }}>
                        <label class="form-check-label text-white" for="statusDraft">Draft</label>
                    </div>
                    @else
                    <input type="hidden" name="status" value="{{ $faq->status }}">
                    <span class="badge bg-secondary px-3 py-2">{{ $faq->status }}</span>
                    <small class="text-white-50 d-block mt-1">Hanya Admin yang dapat mengubah status menjadi
                        Published.</small>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('faq.daftar') }}" class="btn btn-outline-warning">Batal</a>
                    <button type="submit" class="btn btn-custom-gold px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection