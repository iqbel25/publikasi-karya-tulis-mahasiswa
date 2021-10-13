@extends('layouts.admin', ['title' => 'Dashboard'])
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- page statustic card start -->
            <div class="row">
                {{-- @if (auth()->user()->level == 'admin') --}}
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-yellow">{{ $jumlahSkripsi }}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-book f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-yellow">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h6 class="text-white m-b-0">SKRIPSI</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">{{ $jumlahKkp }}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-award f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-green">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h6 class="text-white m-b-0">KKP</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}
                {{-- @if (auth()->user()->level == 'admin' | auth()->user()->level == 'pemateri') --}}
                @if (auth()->user()->level == 1)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-red">{{ $jumlahProdi }}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-red">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h6 class="text-white m-b-0">PRODI</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue">{{ $jumlahDosen }}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h6 class="text-white m-b-0">DOSEN</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-purple">{{ $jumlahMahasiswa }}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-purple">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h6 class="text-white m-b-0">MAHASISWA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}
            </div>
            <!-- page statustic card end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection