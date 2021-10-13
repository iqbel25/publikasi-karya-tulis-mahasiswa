@extends('layouts.admin', ['title' => 'Kkp'])
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Kkp</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Kkp</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Tabel ] start -->
    @include('admin.kkp.tabel.index')
    <!-- [ Tabel ] end -->

    <!-- [ Modal Tambah ] start -->
    @include('admin.kkp.modal.tambah')
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Show ] start -->
    @include('admin.kkp.modal.show')
    <!-- [ Modal Show ] end -->

    <!-- [ Modal Edit ] start -->
    @include('admin.kkp.modal.edit')
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
        $('.edit-kkp').on("click", function() {
            var editKkpId = $(this).attr('data-id');
            $.ajax({
                url: "kkp/"+editKkpId+"/edit/" ,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#edit-id-kkp').val(data.id);
                    $('#edit-nama_penulis').val(data.nama_penulis);
                    $('#edit-judul').val(data.judul);
                    $('#edit-tahun_lulus').val(data.tahun_lulus);
                    $('#edit-prodi').val(data.prodi);
                    tinymce.get("edit-abstrak").setContent(data.abstrak);
                    document.getElementById("edit-bab1").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab1+"";
                    document.getElementById("edit-bab2").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab2+"";
                    document.getElementById("edit-bab3").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab3+"";
                    document.getElementById("edit-bab4").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab4+"";
                    document.getElementById("edit-bab5").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab5+"";
                    document.getElementById("form-update-kkp").action = "kkp/"+editKkpId;
                    $('#kkpEditModal').modal('show');
                }
            });
        });

        // Show Data Materi
        $('.show-kkp').on("click", function() {
            var showKkpId = $(this).attr('data-id');
            $.ajax({
                url: "kkp/"+showKkpId,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#show-id-kkp').val(data.id);
                    $('#show-nama_penulis').val(data.nama_penulis);
                    $('#show-judul').val(data.judul);
                    $('#show-tahun_lulus').val(data.tahun_lulus);
                    $('#show-prodi').val(data.prodi);
                    tinymce.get("show-abstrak").setContent(data.abstrak);
                    document.getElementById("show-bab1").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab1+"";
                    document.getElementById("show-bab2").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab2+"";
                    document.getElementById("show-bab3").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab3+"";
                    document.getElementById("show-bab4").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab4+"";
                    document.getElementById("show-bab5").href = "http://localhost:8000/storage/uploads/kkp/"+data.bab5+"";
                    document.getElementById("form-accept-kkp").action = "kkp/accept/"+showKkpId;
                    $('#kkpShowModal').modal('show');
                }
            });
        });
    });
</script>
@endsection