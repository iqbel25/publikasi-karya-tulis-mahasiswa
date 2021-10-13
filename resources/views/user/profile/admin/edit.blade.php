<div class="modal fade" id="editProfileShowModal" tabindex="-1" role="dialog"
    aria-labelledby="editProfileShowModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileShowModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.admin.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Lengkap :</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ auth()->user()->name }}">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>