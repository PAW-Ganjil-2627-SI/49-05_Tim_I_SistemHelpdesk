<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Gangguan IT</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar-custom">
        <div class="navbar-container">
            <a class="navbar-brand" href="{{ route('gangguan.daftar') }}">Sistem Laporan Gangguan IT</a>
            <div>
                @auth
                    <span class="user-greeting">Halo, {{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role) }})</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-danger-custom">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-primary-custom" style="margin-right: 8px;">Login</a>
                    <a href="{{ route('register') }}" class="btn-light-custom">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-container">
        @if (session('success'))
            <div style="background-color: #064e3b; border: 1px solid #047857; color: #a7f3d0; padding: 12px; border-radius: 4px; font-size: 13px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-custom">
            <div class="card-header-custom">
                <h5>Daftar Laporan Gangguan IT</h5>
                @auth
                    <a href="{{ route('home') }}" class="btn-primary-custom">+ Ajukan Gangguan</a>
                @endauth
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Gangguan</th>
                        <th>Tingkat Prioritas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gangguan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->jenis_gangguan }}</td>
                            <td>
                                @if ($item->tingkat_prioritas === 'Tinggi')
                                    <span class="badge-tinggi">Tinggi</span>
                                @elseif ($item->tingkat_prioritas === 'Sedang')
                                    <span class="badge-sedang">Sedang</span>
                                @else
                                    <span class="badge-rendah">Rendah</span>
                                @endif
                            </td>
                            <td>{{ $item->deskripsi_gangguan }}</td>
                            <td>
                                @auth
                                    @can('update', $item)
                                        <a href="{{ route('gangguan.edit', $item) }}" class="btn-warning-custom">Edit</a>
                                    @endcan

                                    @can('delete', $item)
                                        <form action="{{ route('gangguan.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-custom">Hapus</button>
                                        </form>
                                    @endcan

                                    @if (Auth::user()->role === 'user')
                                        <span style="color: #8c9ba5; font-size: 12px;">Hanya Lihat</span>
                                    @endif
                                @else
                                    <span style="color: #8c9ba5; font-size: 12px;">Login untuk melapor</span>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #8c9ba5;">Belum ada data laporan gangguan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>