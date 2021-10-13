<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Dosen</h5>
            @if (auth()->user()->level == 1)
            <button type="button" class="btn  btn-icon btn-success float-right" data-toggle="modal"
                data-target="#dosenTambahModal">
                <i class="feather icon-plus"></i>
            </button>
            @endif
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
                            @if (auth()->user()->level == 1)
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($semuaDosen as $no => $dosen)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->user->email }}</td>
                            <td>{{ $dosen->prodi }}</td>
                            <td>
                                @if ($dosen->jenis_kelamin == 'l')
                                Laki - Laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td>{{ $dosen->no_hp }}</td>
                            <td>
                                @if (!empty($dosen->foto))
                                <img class="img-radius" width="50%"
                                    src="{{ asset('storage/uploads/dosen/'.$dosen->foto)}}">
                                @else
                                <img class="img-radius" width="50%" src="{{ $dosen->user->avatar_url }}">
                                @endif
                            </td>
                            @if (auth()->user()->level == 1)
                            <td>
                                <form action="{{ route('dosen.destroy', $dosen->id_dosen) }}" method="POST">
                                    <button type="button" class="btn btn-icon btn-outline-primary edit-dosen"
                                        style="width: 28px; height: 28px;" data-toggle="modal"
                                        data-target="#dosenEditModal" data-id="{{ ($dosen->id) }}"><i class=" feather
                                        icon-edit"></i>
                                    </button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline-danger"
                                        style="width: 28px; height: 28px;"
                                        onclick="return confirm('Anda Yakin Menghapus Dosen : {{ $dosen->nama }} ?')">
                                        <i class=" feather icon-slash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>