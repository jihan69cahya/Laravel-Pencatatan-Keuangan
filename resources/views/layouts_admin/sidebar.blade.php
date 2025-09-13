<nav id="sidebar" aria-label="Main Navigation">
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <a class="fw-semibold text-white tracking-wide" href="index.html">
                <span class="smini-visible">
                    P<span class="opacity-75">K</span>
                </span>
                <span class="smini-hidden">
                    Pencatatan
                </span>
            </a>

            <div>
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                    data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                    onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                    data-target="#dark-mode-toggler" data-class="far fa" onclick="Dashmix.layout('dark_mode_toggle');">
                    <i class="far fa-moon" id="dark-mode-toggler"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}"
                        href="{{ route('dashboard.' . Auth::user()->role) }}">
                        <i class="nav-main-link-icon fa fa-rocket"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'pengguna')
                    <li class="nav-main-heading">Keuangan</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                            href="{{ route('transaksi.index') }}">
                            <i class="nav-main-link-icon fa fa-money-bill-transfer"></i>
                            <span class="nav-main-link-name">Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('laporan*') ? 'active' : '' }}"
                            href="{{ route('laporan.index') }}">
                            <i class="nav-main-link-icon fa fa-file-lines"></i>
                            <span class="nav-main-link-name">Laporan</span>
                        </a>
                    </li>
                @else
                    <li class="nav-main-heading">Data</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('pengguna*') ? 'active' : '' }}" href="/pengguna">
                            <i class="nav-main-link-icon fa fa-person"></i>
                            <span class="nav-main-link-name">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('transaksi*') ? 'active' : '' }}" href="/transaksi">
                            <i class="nav-main-link-icon fa fa-money-bill-transfer"></i>
                            <span class="nav-main-link-name">Transaksi Keuangan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
