<div class="modal fade" id="prodiEditModal" tabindex="-1" role="dialog" aria-labelledby="prodiEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prodiEditModalLabel">Edit Prodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-prodi" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nidn" class="col-form-label">NIDN :</label>
                        <input name="nidn" type="number" class="form-control @error('nidn') is-invalid @enderror"
                            id="edit-nidn">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Lengkap :</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="edit-name">
                    </div>
                    <div class="form-group">
                        <label for="hp" class="col-form-label">No HP :</label>
                        <input name="hp" type="number" class="form-control @error('hp') is-invalid @enderror"
                            id="edit-hp">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="edit-jk">
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
                        <img id="edit-image-prodi" width="30%">
                        <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                            id="edit-foto">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email :</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            id="edit-email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password :</label>
                        <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="edit-password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password :</label>
                        <input name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror" id="edit-password_confirmation">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id-prodi">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>