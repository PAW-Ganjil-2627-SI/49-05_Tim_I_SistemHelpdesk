<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Gangguan IT</title>
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
                <h4>Daftar Akun Baru</h4>
                <p>Buat akun user untuk melaporkan gangguan IT</p>
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

                <form action="{{ route('register.proses') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                    <button type="submit" class="btn-submit">DAFTAR</button>
                </form>

                <p style="text-align: center; margin-top: 18px; font-size: 13px; color: #9ca3af;">
                    Sudah punya akun? <a href="{{ route('login') }}" style="color: #facc15; text-decoration: none; font-weight: bold;">Masuk di sini</a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>