@extends('layouts.auth', ['title' => 'Daftar'])
@section('content')
<div class="auth-content">
    <div class="card">
        <div class="row align-items-center text-center">
            <div class="col-md-12">
                <div class="card-body">
                    <img width="30%" src="{{ asset('assets/admin/images/logo.png') }}" alt="" class="img-fluid mb-4">
                    <h4 class="mb-3 f-w-400">Daftar</h4>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="floating-label" for="name">Nama Lengkap</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="floating-label" for="nim">NIM</label>
                            <input name="nim" type="number" class="form-control @error('nim') is-invalid @enderror"
                                id="nim" value="{{ old('nim') }}">
                            @error('nim')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="floating-label" for="no_hp">No. Telp</label>
                            <input name="hp" type="number" min="0" class="form-control @error('no_hp') is-invalid @enderror"
                                id="no_hp" value="{{ old('hp') }}">
                            @error('no_hp')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="floating-label" for="jk">Jenis Kelamin</label>
                            <select class="form-control" name="jk" id="jk">
                                <option value=""></option>
                                <option value="l">Laki-Laki</option>
                                <option value="p">Perempuan</option>
                            </select>
                            @error('jk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="floating-label" for="prodi">Program Studi</label>
                            <select class="form-control" name="prodi" id="prodi">
                                <option value=""></option>
                                <option value="Elektro">Elektro</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Industri">Industri</option>
                                <option value="Mesin">Mesin</option>
                                <option value="Sipil">Sipil</option>
                            </select>
                            @error('prodi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="floating-label" for="Email">Email</label>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                id="Email" value="{{ old('email') }}">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="floating-label" for="Password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                id="Password">
                            @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="floating-label" for="password_confirm">Password Confirm</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirm">
                            @error('password_confirmation')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mb-4">Daftar</button>
                    </form>
                    <p class="mb-0 text-muted">Sudah Punya Akun? <a href="/login"
                            class="f-w-400">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection