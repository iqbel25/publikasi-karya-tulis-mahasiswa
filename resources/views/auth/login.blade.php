@extends('layouts.auth', ['title' => 'Login'])
@section('content')
<div class="auth-content">
    <div class="card">
        <div class="row align-items-center text-center">
            <div class="col-md-12">
                <div class="card-body">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" alt="" width="40%" class="img-fluid mb-4">
                    <h4 class="mb-3 f-w-400">Login</h4>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="floating-label" for="Email">Email</label>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                id="Email">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="floating-label" for="Password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="Password">
                            @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mb-4">Masuk</button>
                    </form>
                    {{-- <p class="mb-2 text-muted">Forgot password? <a href="/forgot-password" class="f-w-400">Reset</a></p> --}}
                    <p class="mb-0 text-muted">Tidak Punya Akun? <a href="/register" class="f-w-400">Daftar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection