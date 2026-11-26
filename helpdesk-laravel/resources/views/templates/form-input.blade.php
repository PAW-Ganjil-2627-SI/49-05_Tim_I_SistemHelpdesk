@extends('layouts.app')

{{-- 1. UBAH JUDUL HALAMAN & AKTIFKAN MENU SIDEBAR MODUL KAMU --}}
@section('title', 'Form Data - IT Helpdesk System')
@section('topbar-title', 'Formulir Input / Edit Data')
@section('menu-faq', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom p-4 shadow-sm">
            <div class="mb-4 pb-2 border-bottom border-secondary">
                <h3 class="fw-bold text-gold mb-0">Formulir Tambah / Edit Data</h3>
            </div>

            {{-- ===========================================================
             TEMPEL TAG <form action="..." method="POST"> LAMA DI SINI
             =========================================================== --}}
            <form action="#" method="POST">
                @csrf
                {{-- Jika untuk halaman Edit, tambahkan @method('PUT') --}}

                <div class="mb-3">
                    <label class="form-label fw-semibold text-white">Label Input Teks</label>
                    <input type="text" name="nama_field" class="form-control" placeholder="Masukkan teks..." required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-white">Label Dropdown / Select</label>
                        <select name="pilihan" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Opsi --</option>
                            <option value="opsi1">Opsi 1</option>
                            <option value="opsi2">Opsi 2</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-white">Label Input Kedua</label>
                        <input type="text" name="field_dua" class="form-control" placeholder="Masukkan data...">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-white">Label Textarea / Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="form-control"
                        placeholder="Tuliskan detail..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-outline-warning">Batal</a>
                    <button type="submit" class="btn btn-custom-gold px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection