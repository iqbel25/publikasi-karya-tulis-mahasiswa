<!-- [ navigation menu ] start -->
<div class="navbar-wrapper  ">
    <div class="navbar-content scroll-div ">
        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="{{ auth()->user()->avatar_url }}" alt="User-Profile-Image">
                <div class="user-details">
                    <div id="more-details">{{ auth()->user()->name }} <i class="fa fa-caret-down"></i></div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-unstyled">
                    <li class="list-group-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="feather icon-log-out m-r-5"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            <li class="nav-item pcoded-menu-caption">
                <label>Menu</label>
            </li>
            @if (auth()->user()->level == 1 | auth()->user()->level == 2)
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link ">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                            class="feather icon-layout"></i></span><span class="pcoded-mtext">Karya Tulis</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="{{ route('skripsi.index') }}">Skripsi</a></li>
                    <li><a href="{{ route('kkp.index') }}">KKP</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('dosen.index') }}" class="nav-link ">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Dosen</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->level == 1)
            <li class="nav-item">
                <a href="{{ route('prodi.index') }}" class="nav-link ">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Prodi</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->level == 1 | auth()->user()->level == 2)
            <li class="nav-item">
                <a href="{{ route('mahasiswa.index') }}" class="nav-link ">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Mahasiswa</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link ">
                    <span class="pcoded-micon"><i class="feather icon-folder"></i></span>
                    <span class="pcoded-mtext">Documentation</span>
                </a>
            </li>
        </ul>

    </div>
</div>
<!-- [ navigation menu ] end -->