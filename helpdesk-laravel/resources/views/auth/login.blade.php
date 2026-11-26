<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IT Helpdesk System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card card-custom p-4 shadow">
                    <div class="text-center mb-4 pb-3 border-bottom border-secondary">
                        <i class="bi bi-shield-lock-fill text-gold fs-1"></i>
                        <h3 class="fw-bold text-gold mt-2 mb-1">Login Sistem IT</h3>
                        <p class="text-white-50 small mb-0">Masuk ke Portal IT Support & Helpdesk</p>
                    </div>

                    @include('partials.alerts')

                    <form action="{{ Route::has('login.proses') ? route('login.proses') : '#' }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold text-white">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-white">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password" required>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label text-white small">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-custom-gold w-100 py-2 mb-3">Login</button>
                    </form>

                    <div class="text-center small">
                        <span class="text-white-50">Belum punya akun?</span>
                        <a href="{{ Route::has('register') ? route('register') : '#' }}"
                            class="text-gold text-decoration-none fw-semibold">Daftar Akun</a>
                        <br>
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none mt-2 d-inline-block">←
                            Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>