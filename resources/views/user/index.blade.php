@extends('layouts.user', ['title' => 'Home'])
@section('content')
<form class="mb-5" action="{{ route('user') }}" method="get">
    <input class="form-control mr-sm-2 mb-2" name="q" type="text" placeholder="Telusuri" aria-label="Search">
    <button class="btn btn-outline-primary my-2 my-sm-0 justify-content-center mb-5" type="submit">Telusuri</button>
</form>
@forelse ($allRepository as $repository)
<div class="card-body">
    <h5 class="card-text text-warning text-left">{{ $repository->user->name }} |
        @php
        $nim = \App\Models\Mahasiswa::where('id_mahasiswa', $repository->user->id)->first();
        @endphp
        {{ $nim->nim ?? "Admin" }}
    </h5>
    <h5 class="card-text text-primary text-left">
        @if (Route::has('login'))
        @auth
        <a href="http://localhost:8000/storage/uploads/repository/{{ $repository->bab1 }}"
            target="_blank">{{ $repository->judul }}</a>
        @else
        <a href="{{ route('login') }}">{{ $repository->judul }}</a>
        @endauth
        @endif
    </h5>
    <h6 class="card-text text-warning text-left">
        <small>{{ $repository->bab1 }}
            @if (Route::has('login'))
            @auth
            <a href="{{ asset('storage/uploads/repository/'.$repository->bab1) }}" download target="_blank">Download</a>
            @else
            <a href="{{ route('login') }}">Login untuk Download</a>
            @endauth
            @endif
            <br> {{ $repository->prodi }} <br>
            {{ $repository->tahun_lulus }}
        </small>
    </h6>
</div>
@empty
<div class="alert alert-warning">
    <h5>Data Tidak Ditemukan</h5>
</div>
@endforelse
@endsection
@section('sortir')
<div class="card-body">
    <div class="card-header text-secondary"><strong>Lihat Berdasarkan</strong></div>
    <div class="card-title">
        <form action="{{ route('user') }}" method="get">
            <div class="form-group">
                <select class="form-control @error('t') is-invalid @enderror" name="t">
                    <option value="" disabled selected>--Pilih Tahun--</option>
                    @for ($year = date('Y'); 1990 <= $year; $year--) <option value="{{ "$year" }}">
                        {{ $year }}
                        </option>
                        @endfor
                </select>
            </div>
            <div class="form-group">
                <select class="form-control @error('p') is-invalid @enderror" name="p">
                    <option value="" disabled selected>--Pilih Program Studi--</option>
                    <option value="Elektro">Elektro</option>
                    <option value="">Informatika</option>
                    <option value="Industri">Industri</option>
                    <option value="Mesin">Mesin</option>
                    <option value="Sipil">Sipil</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampil</button>
        </form>
    </div>
</div>
@endsection