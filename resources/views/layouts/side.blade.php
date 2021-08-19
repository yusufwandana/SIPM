<nav class="pcoded-navbar menupos-fixed menu-light brand-blue">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <img src="{{asset('lite/assets/images/logo.svg')}}" alt="" class="logo images">
                <img src="{{asset('lite/assets/images/logo-icon.svg')}}" alt="" class="logo-thumb images">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Utama</label>
                </li>
                <li class="nav-item">                    
                    <a href="@if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas') {{route('dashboard.admin')}} @elseif(Auth::user()->role == 'masyarakat') {{route('dashboard.masyarakat')}} @endif" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Menu Kelola Pengguna</label>
                </li> --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-database"></i></span>
                        <span class="pcoded-mtext">Data Pengguna</span>
                    </a>
                    <ul class="pcoded-submenu">
                        {{-- @if (Auth::user()->role == 'admin')
                            <li><a href="{{route('user.index')}}">Akun</a></li>
                            <li><a href="">Log Aktivitas</a></li>
                        @endif --}}
                        <li><a href="{{route('masyarakat.index')}}">Masyarakat</a></li>
                        <li><a href="{{route('petugas.index')}}">Petugas</a></li>
                    </ul>
                </li>
                @endif
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Menu Pengaduan</label>
                </li> --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-scroll"></i></span>
                        <span class="pcoded-mtext">Data Pengaduan</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (Auth::user()->role == 'masyarakat')
                        <li><a href="{{route('pengaduan.ajukan')}}">Ajukan Pengaduan</a></li>
                        @endif
                        <li><a href="{{route('pengaduan.index')}}">Pengaduan</a></li>
                        <li><a href="{{route('pengaduan.riwayat')}}">Riwayat</a></li>
                    </ul>
                </li>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                <li class="nav-item">
                    <a href="{{route('pengaduan.laporan')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-file-alt"></i></span>
                        <span class="pcoded-mtext">Laporan</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
