<div class="modal fade" id="kkpTambahModal" tabindex="-1" role="dialog" aria-labelledby="kkpTambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kkpTambahModalLabel">Tambah Kkp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kkp.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_penulis" class="col-form-label">Nama Penulis :</label>
                        <input name="nama_penulis" type="text"
                            class="form-control @error('nama_penulis') is-invalid @enderror" id="nama_penulis" value="{{ old('nama_penulis') }}">
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Judul :</label>
                        <input name="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                            id="judul" value="{{ old('judul') }}">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tahun_lulus" class="col-form-label">Tahun Lulus :</label>
                            <select class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus">
                                <option value="" disabled selected>--Pilih Tahun Lulus--</option>
                                @for ($year = date('Y'); 1990 <= $year; $year--) <option value="{{ $year }}">{{ $year }}
                                    </option>
                                    @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prodi" class="col-form-label">Program Studi :</label>
                            <select class="form-control @error('prodi') is-invalid @enderror" name="prodi">
                                <option value="" disabled selected>--Pilih Program Studi--</option>
                                <option value="Elektro">Elektro</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Industri">Industri</option>
                                <option value="Mesin">Mesin</option>
                                <option value="Sipil">Sipil</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="abstrak" class="col-form-label">Abstrak :</label>
                        <textarea name="abstrak" class="form-control skripsi @error('abstrak') is-invalid @enderror"
                            id="abstrak" cols="30" rows="3">{{ old('abstrak') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bab1" class="col-form-label">Bab 1 :</label>
                        <input name="bab1" type="file" class="form-control @error('bab1') is-invalid @enderror"
                            id="bab1" value="{{ old('bab1') }}">
                    </div>
                    <div class="form-group">
                        <label for="bab2" class="col-form-label">Bab 2 :</label>
                        <input name="bab2" type="file" class="form-control @error('bab2') is-invalid @enderror"
                            id="bab2" value="{{ old('bab2') }}">
                    </div>
                    <div class="form-group">
                        <label for="bab3" class="col-form-label">Bab 3 :</label>
                        <input name="bab3" type="file" class="form-control @error('bab3') is-invalid @enderror"
                            id="bab3" value="{{ old('bab3') }}">
                    </div>
                    <div class="form-group">
                        <label for="bab4" class="col-form-label">Bab 4 :</label>
                        <input name="bab4" type="file" class="form-control @error('bab4') is-invalid @enderror"
                            id="bab4" value="{{ old('bab4') }}">
                    </div>
                    <div class="form-group">
                        <label for="bab5" class="col-form-label">Bab 5 :</label>
                        <input name="bab5" type="file" class="form-control @error('bab5') is-invalid @enderror"
                            id="bab5" value="{{ old('bab5') }}">
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

<script>
    var editor_config = {
        selector: "textarea.skripsi",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | aligntleft aligntcenter alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>