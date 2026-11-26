@extends('layouts.app')

@section('title', 'Knowledge Base & FAQ - IT Helpdesk System')
@section('topbar-title', 'Modul Knowledge Base & FAQ')
@section('menu-faq', 'active')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Knowledge Base & FAQ</h2>
        <p class="text-github-muted mb-0">Kelola master artikel solusi teknis, panduan mandiri, dan langkah
            troubleshooting.</p>
    </div>
    @can('kelola-faq-baru')
    <a href="{{ route('faq.create') }}" class="btn btn-custom-gold">
        <i class="bi bi-plus-lg me-1"></i> Tambah Artikel
    </a>
    @endcan
</div>

<div class="card card-custom shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-github align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">No</th>
                        <th scope="col">Judul Artikel Solusi</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Langkah Troubleshooting</th>
                        <th scope="col">Status</th>
                        @if (Auth::check() && Auth::user()->hasRole('admin', 'teknisi'))
                        <th scope="col" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faqs as $item)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-gold">{{ $item->judul }}</td>
                        <td>
                            @switch($item->kategori)
                            @case('Hardware')
                            <span class="badge bg-primary text-white px-3 py-2">{{ $item->kategori }}</span>
                            @break
                            @case('Software')
                            <span class="badge bg-info text-dark fw-semibold px-3 py-2">{{ $item->kategori }}</span>
                            @break
                            @case('Jaringan')
                            <span class="badge bg-warning text-dark fw-semibold px-3 py-2">{{ $item->kategori }}</span>
                            @break
                            @case('Akses & Akun')
                            <span class="badge bg-secondary text-white px-3 py-2">{{ $item->kategori }}</span>
                            @break
                            @default
                            <span class="badge bg-dark text-white px-3 py-2">{{ $item->kategori }}</span>
                            @endswitch
                        </td>
                        <td>{{ $item->penulis }}</td>
                        <td style="max-width: 250px;" class="text-github-muted">{{ $item->langkah_troubleshooting }}
                        </td>
                        <td>
                            @if ($item->status === 'Published')
                            <span class="badge bg-success">Published</span>
                            @else
                            <span class="badge badge-draft">Draft</span>
                            @endif
                        </td>
                        @if (Auth::check() && Auth::user()->hasRole('admin', 'teknisi'))
                        <td class="text-center">
                            @can('update', $item)
                            <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                            @endcan

                            @can('delete', $item)
                            <form action="{{ route('faq.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
                            </form>
                            @endcan

                            @if ($item->status === 'Published' && !Auth::user()->hasRole('admin'))
                            <span class="text-github-muted small fst-italic">Terkunci (Published)</span>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ (Auth::check() && Auth::user()->hasRole('admin', 'teknisi')) ? '7' : '6' }}"
                            class="text-center py-4 text-github-muted">
                            Belum ada data artikel.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection