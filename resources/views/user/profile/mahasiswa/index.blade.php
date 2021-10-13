@extends('layouts.user', ['title' => 'Profile'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Profile Anda</h5>
    </div>
    @error('name')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('nim')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('hp')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('jk')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('prodi')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('foto')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="card-body table-border-style">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable2">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Jenis Kelamin</th>
                        <th>No HP</th>
                        <th>Foto</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ auth()->user()->name }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>{{ $mahasiswa->prodi }}</td>
                        <td>
                            @if ($mahasiswa->jenis_kelamin == 'l')
                            Laki - Laki
                            @else
                            Perempuan
                            @endif
                        </td>
                        <td>{{ $mahasiswa->no_hp }}</td>
                        <td>
                            @if (!empty($mahasiswa->foto))
                            <img class="img-radius" width="50%" src="{{ asset('storage/uploads/mahasiswa/'.$mahasiswa->foto)}}">
                            @else
                            <img class="img-radius" width="50%" src="{{ $mahasiswa->user->avatar_url }}">
                            @endif
                        </td>
                        <td>{{ auth()->user()->email }}</td>
                        @if (auth()->user()->level == 4)
                        <td>Mahasiswa</td>
                        @endif
                        <td>
                            <button type="button" class="btn btn-warning btn-sm edit-profile-mahasiswa" data-toggle="modal"
                                data-target="#editProfileMahasiswaModal" data-id="{{ auth()->user()->id }}"><i
                                    class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- [ Modal Edit ] start -->
@include('user.profile.mahasiswa.edit')
<!-- [ Modal Edit ] end -->

@endsection
{{-- Search Lihat Berdasarkan --}}
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
@section('js')
<script>
    $('document').ready(function () {
            setTimeout(function () {
                $("div.alert").remove();
            }, 5000);
            // Edit Data
        $('.edit-profile-mahasiswa').on("click", function() {
            var editMahasiswaId = $(this).attr('data-id');
            $.ajax({
                url: "mahasiswa/"+editMahasiswaId,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#edit-id-mahasiswa').val(data.id);
                    $('#edit-nim-mahasiswa').val(data.nim);
                    $('#edit-hp-mahasiswa').val(data.no_hp);
                    $('#edit-jk-mahasiswa').val(data.jenis_kelamin);
                    $('#edit-prodi').val(data.prodi);
                    document.getElementById("edit-image-mahasiswa").src = "{{ asset('storage/uploads/mahasiswa') }}/"+data.foto;
                    document.getElementById("form-update-mahasiswa").action = "mahasiswa/"+editMahasiswaId;
                    $('#editProfileMahasiswaModal').modal('show');
                }
            });
        });
        });
</script>
@endsection