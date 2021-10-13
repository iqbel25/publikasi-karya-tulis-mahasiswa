<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Prodi</h5>
            <button type="button" class="btn  btn-icon btn-success float-right" data-toggle="modal"
                data-target="#prodiTambahModal">
                <i class="feather icon-plus"></i>
            </button>
        </div>
        @error('name')
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
        @error('nidn')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
        @error('prodi')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
        @error('jk')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
        @error('no_hp')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
        @error('foto')
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
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($semuaProdi as $no => $prodi)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $prodi->nidn }}</td>
                            <td>{{ $prodi->nama }}</td>
                            <td>{{ $prodi->user->email }}</td>
                            <td>{{ $prodi->prodi }}</td>
                            <td>
                                @if ($prodi->jenis_kelamin == 'l')
                                Laki - Laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td>{{ $prodi->no_hp }}</td>
                            <td>
                                @if (!empty($prodi->foto))
                                <img class="img-radius" width="50%"
                                    src="{{ asset('storage/uploads/prodi/'.$prodi->foto)}}">
                                @else
                                <img class="img-radius" width="50%" src="{{ $prodi->user->avatar_url }}">
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('prodi.destroy', $prodi->id_prodi) }}" method="POST">
                                    <button type="button" class="btn btn-icon btn-outline-primary edit-prodi"
                                        style="width: 28px; height: 28px;" data-toggle="modal"
                                        data-target="#prodiEditModal" data-id="{{ ($prodi->id) }}"><i class=" feather
                                        icon-edit"></i>
                                    </button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline-danger"
                                        style="width: 28px; height: 28px;"
                                        onclick="return confirm('Anda Yakin Menghapus Prodi : {{ $prodi->nama }} ?')">
                                        <i class=" feather icon-slash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>