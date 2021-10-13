<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <a class="navbar-brand" href="{{ route('user') }}">Repository</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            @if (Route::has('login'))
            @auth

            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endauth
            @endif
        </ul>
    </div>
    @if (Route::has('login'))
    @auth
    <div class="dropdown">
        <a class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            {{ auth()->user()->name }} - @php
            $dosen = \App\Models\Dosen::where('id_dosen', auth()->user()->id)->first();
            $prodi = \App\Models\Prodi::where('id_prodi', auth()->user()->id)->first();
            $mahasiswa = \App\Models\Mahasiswa::where('id_mahasiswa', auth()->user()->id)->first();
            @endphp
            @if (auth()->user()->level == 1)
            Admin
            @else
            {{ $dosen->nidn ?? $mahasiswa->nim ?? $prodi->nidn }}
            @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if ($mahasiswa)
            @if ($mahasiswa->foto)
            <img src="{{ asset('storage/uploads/mahasiswa/'.$mahasiswa->foto) }}" class="dropdown-item rounded" alt="">
            @else
            <img src="{{ auth()->user()->avatar_url }}" class="dropdown-item rounded" alt="">
            @endif
            @elseif($dosen)
            @if ($dosen->foto)
            <img src="{{ asset('storage/uploads/dosen/'.$dosen->foto)}}" class="dropdown-item rounded" alt="">
            @else
            <img src="{{ auth()->user()->avatar_url }}" class="dropdown-item rounded" alt="">
            @endif
            @elseif($prodi)
            @if ($prodi->foto)
            <img src="{{ asset('storage/uploads/prodi/'.$prodi->foto)}}" class="dropdown-item rounded" alt="">
            @else
            <img src="{{ auth()->user()->avatar_url }}" class="dropdown-item rounded" alt="">
            @endif
            @else
            <img src="{{ auth()->user()->avatar_url }}" class="dropdown-item rounded" alt="">
            @endif
            @if(auth()->user()->level == 1)
            <a class="dropdown-item" href="{{ route('profile.admin') }}">Profile</a>
            @elseif (auth()->user()->level == 2)
            <a class="dropdown-item" href="{{ route('profile.prodi') }}">Profile</a>
            @elseif(auth()->user()->level == 3)
            <a class="dropdown-item" href="{{ route('profile.dosen') }}">Profile</a>
            @elseif(auth()->user()->level == 4)
            <a class="dropdown-item" href="{{ route('profile.mahasiswa') }}">Profile</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <i class="feather icon-log-out m-r-5"></i>Logout
            </a>
        </div>
    </div>
    @endauth
    @endif
    </div>
</nav>
