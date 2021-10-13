@extends('layouts.user', ['title' => 'Upload Skripsi'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Skripsi Anda</h5>
        @if (!$skripsi)     
        <button type="button" class="btn  btn-icon btn-success float-right" data-toggle="modal"
            data-target="#skripsiTambahModal">
            <i class="fa fa-plus"></i>
        </button>
        @endif
    </div>
    @error('nama_penulis')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('judul')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('tahun_lulus')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('prodi')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('abstrak')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('bab1')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('bab2')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('bab3')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('bab4')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('bab5')
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
                        <th>No</th>
                        <th>Nama Penulis</th>
                        <th>Judul</th>
                        <th>Tahun lulus</th>
                        <th>Program Studi</th>
                        <th>Abstrak</th>
                        <th>Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @if ($skripsi)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $skripsi->nama_penulis }}</td>
                        <td>{{ $skripsi->judul }}</td>
                        <td>{{ $skripsi->tahun_lulus }}</td>
                        <td>{{ $skripsi->prodi }}</td>
                        <td>{!! Str::limit($skripsi->abstrak,100,$end='...') !!}</td>
                        <td>
                            Bab 1 : <a href="http://localhost:8000/storage/uploads/skripsi/{{ $skripsi->bab1 }}" download
                                target="_blank">{{ $skripsi->bab1 }}</a>, <br>
                            Bab 2 : <a href="http://localhost:8000/storage/uploads/skripsi/{{ $skripsi->bab2 }}" download
                                target="_blank">{{ $skripsi->bab2 }}</a>, <br>
                            Bab 3 : <a href="http://localhost:8000/storage/uploads/skripsi/{{ $skripsi->bab3 }}" download
                                target="_blank">{{ $skripsi->bab3 }}</a>, <br>
                            Bab 4 : <a href="http://localhost:8000/storage/uploads/skripsi/{{ $skripsi->bab4 }}" download
                                target="_blank">{{ $skripsi->bab4 }}</a>, <br>
                            Bab 5 : <a href="http://localhost:8000/storage/uploads/skripsi/{{ $skripsi->bab5 }}" download
                                target="_blank">{{ $skripsi->bab5 }}</a>
                        </td>
                        <td>
                            @if ($skripsi->status == "Menunggu")
                            <span class="badge badge-warning">Menunggu</span>
                            @elseif ($skripsi->status == "Diterima")
                            <span class="badge badge-success">Diterima</span>
                            @else
                            <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm edit-skripsi" data-toggle="modal" data-target="#skripsiEditModal"
                                data-id="{{ $skripsi->id }}"><i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="9">Belum Ada</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- [ Modal Tambah ] start -->
@include('user.uploads.skripsi.modal.tambah')
<!-- [ Modal Tambah ] end -->

<!-- [ Modal Edit ] start -->
@include('admin.skripsi.modal.edit')
<!-- [ Modal Edit ] end -->

@endsection
{{-- Search Lihat Berdasarkan --}}
@section('sortir')
<div class="card-body">
    <div class="card-header text-secondary"><strong>Lihat Berdasarkan</strong></div>
    <div class="card-title">
        <form action="{{ route('koleksi.skripsi') }}" method="get">
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
            
            // Edit Data Materi
        $('.edit-skripsi').on("click", function() {
            var editSkripsiId = $(this).attr('data-id');
            $.ajax({
                url: "skripsi/"+editSkripsiId+"/edit/" ,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#edit-id-skripsi').val(data.id);
                    $('#edit-nama_penulis').val(data.nama_penulis);
                    $('#edit-judul').val(data.judul);
                    $('#edit-tahun_lulus').val(data.tahun_lulus);
                    $('#edit-prodi').val(data.prodi);
                    tinymce.get("edit-abstrak").setContent(data.abstrak);
                    document.getElementById("edit-bab1").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab1+"";
                    document.getElementById("edit-bab2").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab2+"";
                    document.getElementById("edit-bab3").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab3+"";
                    document.getElementById("edit-bab4").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab4+"";
                    document.getElementById("edit-bab5").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab5+"";
                    document.getElementById("form-update-skripsi").action = "skripsi/"+editSkripsiId;
                    $('#skripsiEditModal').modal('show');
                }
            });
        });
        });
</script>
@endsection