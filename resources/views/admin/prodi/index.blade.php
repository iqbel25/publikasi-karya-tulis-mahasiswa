@extends('layouts.admin', ['title' => 'Prodi'])
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Prodi</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Prodi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Tabel ] start -->
    @include('admin.prodi.tabel.index')
    <!-- [ Tabel ] end -->

    <!-- [ Modal Tambah ] start -->
    @include('admin.prodi.modal.tambah')
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Edit ] start -->
    @include('admin.prodi.modal.edit')
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
        $('.edit-prodi').on("click", function() {
            var editProdiId = $(this).attr('data-id');
            $.ajax({
                url: "prodi/"+editProdiId+"/edit/" ,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#edit-id-prodi').val(data.id);
                    $('#edit-nidn').val(data.nidn);
                    $('#edit-name').val(data.user.name);
                    $('#edit-hp').val(data.no_hp);
                    $('#edit-jk').val(data.jenis_kelamin);
                    $('#edit-prodi').val(data.prodi);
                    $('#edit-email').val(data.user.email);
                    document.getElementById("edit-image-prodi").src = "{{ asset('storage/uploads/prodi') }}/"+data.foto;
                    document.getElementById("form-update-prodi").action = "prodi/"+editProdiId;
                    $('#prodiEditModal').modal('show');
                }
            });
        });
        });
</script>
@endsection