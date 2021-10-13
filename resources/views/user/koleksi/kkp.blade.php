@extends('layouts.user', ['title' => 'Kkp'])

@section('content')
<form class="mb-5" action="{{ route('koleksi.kkp') }}" method="get">
    <input class="form-control mr-sm-2 mb-2" name="q" type="text" placeholder="Telusuri" aria-label="Search">
    <button class="btn btn-outline-primary my-2 my-sm-0 justify-content-center mb-5" type="submit">Telusuri</button>
</form>
@forelse ($semuaKkp as $kkp)
<div class="card-body">
    <h5 class="card-text text-warning text-left">{{ $kkp->user->name }} |
        @php
        $nim = \App\Models\Mahasiswa::where('id_mahasiswa', $kkp->user->id)->first();
        @endphp
        {{ $nim->nim ?? "Admin" }}
    </h5>
    <h5 class="card-text text-primary text-left">
        <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab1 }}" target="_blank">{{ $kkp->judul }}</a>
    </h5>
    <h6 class="card-text text-warning text-left">
        <small>{{ $kkp->bab1 }}
            @if (Route::has('login'))
            @auth
            <a href="{{ asset('storage/uploads/kkp/'.$kkp->bab1) }}" download target="_blank">Download</a>
            @else
            <a href="{{ route('login') }}">Login untuk Download</a>
            @endauth
            @endif
            <br> {{ $kkp->prodi }} <br>
            {{ $kkp->tahun_lulus }}
        </small>
    </h6>
</div>
@empty
<div class="alert alert-warning">
    <h5>Data Tidak Ditemukan</h5>
</div>
@endforelse
{{ $semuaKkp->links('vendor.pagination.tailwind') }}
@endsection
{{-- Search Lihat Berdasarkan --}}
@section('sortir')
<div class="card-body">
    <div class="card-header text-secondary"><strong>Lihat Berdasarkan</strong></div>
    <div class="card-title">
        <form action="{{ route('koleksi.kkp') }}" method="get">
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
                    <option value="Informatika">Informatika</option>
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