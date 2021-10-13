<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>List Kkp</h5>
            @if (auth()->user()->level == 1)
            <button type="button" class="btn  btn-icon btn-success float-right" data-toggle="modal"
                data-target="#kkpTambahModal">
                <i class="feather icon-plus"></i>
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
                        @foreach ($semuaKkp as $no => $kkp)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $kkp->nama_penulis }}</td>
                            <td>{{ $kkp->judul }}</td>
                            <td>{{ $kkp->tahun_lulus }}</td>
                            <td>{{ $kkp->prodi }}</td>
                            <td>{!! Str::limit($kkp->abstrak,100,$end='...') !!}</td>
                            <td>
                                Bab 1 : <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab1 }}" download
                                    target="_blank">{{ $kkp->bab1 }}</a>, <br>
                                Bab 2 : <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab2 }}" download
                                    target="_blank">{{ $kkp->bab2 }}</a>, <br>
                                Bab 3 : <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab3 }}" download
                                    target="_blank">{{ $kkp->bab3 }}</a>, <br>
                                Bab 4 : <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab4 }}" download
                                    target="_blank">{{ $kkp->bab4 }}</a>, <br>
                                Bab 5 : <a href="http://localhost:8000/storage/uploads/kkp/{{ $kkp->bab5 }}" download
                                    target="_blank">{{ $kkp->bab5 }}</a>
                            </td>
                            <td>
                                @if ($kkp->status == "Menunggu")
                                <span class="badge badge-warning">Menunggu</span>
                                @elseif ($kkp->status == "Diterima")
                                <span class="badge badge-success">Diterima</span>
                                @else
                                <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            @if (auth()->user()->level == 1)
                            <td>
                                <form action="{{ route('kkp.destroy', $kkp->id) }}" method="POST">
                                    <button type="button" class="btn btn-icon btn-outline-primary edit-kkp"
                                        style="width: 28px; height: 28px;" data-toggle="modal"
                                        data-target="#kkpEditModal" data-id="{{ $kkp->id }}"><i class=" feather
                                        icon-edit"></i>
                                    </button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline-danger"
                                        style="width: 28px; height: 28px;"
                                        onclick="return confirm('Anda Yakin Menghapus Data Kkp : {{ $kkp->nama_penulis }} ?')">
                                        <i class=" feather icon-slash"></i>
                                    </button>
                                </form>
                            </td>
                            @else
                            @if ($kkp->status == 'Menunggu' || $kkp->status == 'Ditolak')
                            <td>
                                <form action="{{ route('kkp.reject', $kkp->id) }}" method="POST">
                                    <button type="button" class="btn btn-icon btn-outline-success show-kkp"
                                        style="width: 28px; height: 28px;" data-toggle="modal"
                                        data-target="#kkpShowModal" data-id="{{ $kkp->id }}"><i class="feather
                                        icon-arrow-up"></i>
                                    </button>
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-icon btn-outline-danger"
                                        style="width: 28px; height: 28px;"
                                        onclick="return confirm('Anda Yakin Menolak Data Kkp : {{ $kkp->nama_penulis }} ?')">
                                        <i class="feather icon-slash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>