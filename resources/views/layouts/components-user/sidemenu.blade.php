<div class="col-md-3">
    <div class="card no-gutters">
        <div class="card-body">
            <div class="card-header text-secondary"><strong>Koleksi</strong></div>
            <div class="card-title">
                <a href="{{ route('koleksi.kkp') }}">Kuliah Kerja Praktek</a>
            </div>
            <div class="card-title">
                <a href="{{ route('koleksi.skripsi') }}">Skripsi</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-header text-warning"><strong>Profile Prodi</strong></div>
            <div class="card-title">
                <a href="#">Elektro</a>
            </div>
            <div class="card-title">
                <a href="#">Industri</a>
            </div>
            <div class="card-title">
                <a href="#">Informatika</a>
            </div>
            <div class="card-title">
                <a href="#">Mesin</a>
            </div>
            <div class="card-title">
                <a href="#">Sipil</a>
            </div>
        </div>
        @yield('sortir')
    </div>
</div>