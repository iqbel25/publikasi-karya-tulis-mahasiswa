@extends('layouts.admin', ['title' => 'Mahasiswa'])
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Mahasiswa</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Mahasiswa</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Tabel ] start -->
    @include('admin.mahasiswa.tabel.index')
    <!-- [ Tabel ] end -->

    <!-- [ Modal Tambah ] start -->
    @include('admin.mahasiswa.modal.tambah')
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Edit ] start -->
    @include('admin.mahasiswa.modal.edit')
    <!-- [ Modal Edit ] end -->
</div>
@endsection
@section('js')
<script>
    $('document').ready(function () {
            setTimeout(function () {
                $("div.alert").remove();
            }, 5000);
            // Edit Data Materi
        $('.edit-mahasiswa').on("click", function() {
            var editMahasiswaId = $(this).attr('data-id');
            $.ajax({
                url: "mahasiswa/"+editMahasiswaId+"/edit/" ,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#edit-id-mahasiswa').val(data.id);
                    $('#edit-nim').val(data.nim);
                    $('#edit-name').val(data.user.name);
                    $('#edit-hp').val(data.no_hp);
                    $('#edit-jk').val(data.jenis_kelamin);
                    $('#edit-prodi').val(data.prodi);
                    $('#edit-email').val(data.user.email);
                    document.getElementById("edit-image-mahasiswa").src = "{{ asset('storage/uploads/mahasiswa') }}/"+data.foto;
                    document.getElementById("form-update-mahasiswa").action = "mahasiswa/"+editMahasiswaId;
                    $('#mahasiswaEditModal').modal('show');
                }
            });
        });
        });
</script>
@endsection