@extends('layouts.app')

@section('title', 'Login - IT Helpdesk System')

@section('content')
    <div class="row justify-content-center py-4 py-md-5">
        <div class="col-md-6 col-lg-4">
            <div class="dark-card">
                <h1 class="dark-card-title">Login Pengguna</h1>

                @if ($errors->any())
                    <div class="alert-helpdesk-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember"
                            @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-2">Masuk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
