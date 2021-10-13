<div class="card-header bg-primary">
    <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('user') }}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Tentang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Browse</a>
        </li>
        @if (Route::has('login'))
        @auth
        @if (auth()->user()->level == 4)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">Upload</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('upload.skripsi') }}">Skripsi</a>
                <a class="dropdown-item" href="{{ route('upload.kkp') }}">Kkp</a>
            </div>
        </li>
        @elseif(auth()->user()->level == 1 || auth()->user()->level == 2)
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @endif
        @endauth
        @endif
    </ul>
</div>