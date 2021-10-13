<div class="modal fade" id="mahasiswaTambahModal" tabindex="-1" role="dialog" aria-labelledby="mahasiswaTambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mahasiswaTambahModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nim" class="col-form-label">NIM :</label>
                        <input name="nim" type="number" class="form-control @error('nim') is-invalid @enderror"
                            value="{{ 'nim' }}" id="nim">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Lengkap :</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ 'name' }}" id="name">
                    </div>
                    <div class="form-group">
                        <label for="hp" class="col-form-label">No HP :</label>
                        <input name="hp" type="number" class="form-control @error('hp') is-invalid @enderror"
                            value="{{ 'hp' }}" id="hp">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" value="{{ 'jk' }}" id="jk">
                            <option value="" selected disabled>--Pilih Jenis Kelamin--</option>
                            <option value="l">Laki-Laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                        @error('jk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control" name="prodi" value="{{ 'prodi' }}" id="prodi">
                            <option value="" selected disabled>--Pilih Prodi--</option>
                            <option value="Elektro">Elektro</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Industri">Industri</option>
                            <option value="Mesin">Mesin</option>
                            <option value="Sipil">Sipil</option>
                        </select>
                        @error('prodi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-form-label">Foto :</label>
                        <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                            value="{{ 'foto' }}" id="foto">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email :</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ 'email' }}" id="email" placeholder="example@ft-umt.ac.id">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password :</label>
                        <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password :</label>
                        <input name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>