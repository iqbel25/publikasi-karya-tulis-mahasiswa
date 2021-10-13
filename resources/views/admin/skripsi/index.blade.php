@extends('layouts.admin', ['title' => 'Skripsi'])
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Skripsi</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Skripsi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Tabel ] start -->
    @include('admin.skripsi.tabel.index')
    <!-- [ Tabel ] end -->

    <!-- [ Modal Tambah ] start -->
    @include('admin.skripsi.modal.tambah')
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Show ] start -->
    @include('admin.skripsi.modal.show')
    <!-- [ Modal Show ] end -->

    <!-- [ Modal Edit ] start -->
    @include('admin.skripsi.modal.edit')
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

        // Show Data Materi
        $('.show-skripsi').on("click", function() {
            var showSkripsiId = $(this).attr('data-id');
            $.ajax({
                url: "skripsi/"+showSkripsiId,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#show-id-skripsi').val(data.id);
                    $('#show-nama_penulis').val(data.nama_penulis);
                    $('#show-judul').val(data.judul);
                    $('#show-tahun_lulus').val(data.tahun_lulus);
                    $('#show-prodi').val(data.prodi);
                    tinymce.get("show-abstrak").setContent(data.abstrak);
                    document.getElementById("show-bab1").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab1+"";
                    document.getElementById("show-bab2").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab2+"";
                    document.getElementById("show-bab3").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab3+"";
                    document.getElementById("show-bab4").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab4+"";
                    document.getElementById("show-bab5").href = "http://localhost:8000/storage/uploads/skripsi/"+data.bab5+"";
                    document.getElementById("form-accept-skripsi").action = "skripsi/accept/"+showSkripsiId;
                    $('#skripsiShowModal').modal('show');
                }
            });
        });
    });
</script>
@endsection