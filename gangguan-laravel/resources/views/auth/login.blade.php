<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gangguan IT</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar-custom">
        <div class="navbar-container">
            <a class="navbar-brand" href="{{ route('gangguan.daftar') }}">Sistem Laporan Gangguan IT</a>
            <div>
                <a href="{{ route('gangguan.daftar') }}" class="btn-light-custom">Lihat Daftar</a>
            </div>
        </div>
    </nav>

    <main class="main-container-center">
        <div class="login-card">
            <div class="login-header">
                <h4>Masuk ke Sistem</h4>
                <p>Silakan login menggunakan akun Anda</p>
            </div>
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert-danger-custom">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn-submit">MASUK</button>
                </form>

                <p style="text-align: center; margin-top: 18px; font-size: 13px; color: #9ca3af;">
                    Belum punya akun? <a href="{{ route('register') }}" style="color: #facc15; text-decoration: none; font-weight: bold;">Daftar di sini</a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>