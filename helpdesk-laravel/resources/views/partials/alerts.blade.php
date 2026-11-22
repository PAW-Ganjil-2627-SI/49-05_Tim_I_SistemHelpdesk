@if (session('success'))
<div class="alert alert-success bg-dark text-light border-success alert-dismissible fade show mb-4" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger bg-dark text-danger border-danger alert-dismissible fade show mb-4" role="alert">
    <strong>Gagal!</strong> {{ session('error') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger bg-dark text-danger border-danger mb-4">
    <strong class="d-block mb-1">Periksa kembali inputan Anda:</strong>
    <ul class="mb-0 ps-3 small">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif