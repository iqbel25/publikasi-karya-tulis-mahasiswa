<div class="modal fade" id="editProfileMahasiswaModal" tabindex="-1" role="dialog"
    aria-labelledby="editProfileMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileMahasiswaLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-mahasiswa" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Lengkap :</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="nim" class="col-form-label">NIM :</label>
                        <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" id="edit-nim-mahasiswa">
                    </div>
                    <div class="form-group">
                        <label for="hp" class="col-form-label">No HP :</label>
                        <input name="hp" type="number" class="form-control @error('hp') is-invalid @enderror"
                            id="edit-hp-mahasiswa">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="edit-jk-mahasiswa">
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
                        <select class="form-control" name="prodi" id="edit-prodi">
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
                        <img id="edit-image-mahasiswa" width="30%">
                        <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                            id="edit-foto-mahasiswa">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email :</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password :</label>
                        <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password
                            :</label>
                        <input name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id-mahasiswa">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>