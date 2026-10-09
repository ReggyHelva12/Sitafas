{{-- =====================================================
     SIDEBAR SITAFAS
===================================================== --}}

<aside class="sidebar" id="sidebar">

    {{-- =================================================
         LOGO / BRAND
    ================================================== --}}
    <div class="sidebar-brand">

        <div class="sidebar-logo">
            <img
                src="{{ asset('images/sitafas-logo.png') }}"
                alt="Logo SITAFAS"
            >
        </div>

        <div class="sidebar-brand-text">

            <div class="brand-name">
                SITAFAS
            </div>

            <div class="brand-description">
                Sistem Ticketing dan<br>
                Antrean Faswil
            </div>

        </div>

    </div>


    {{-- =================================================
         MENU UTAMA
    ================================================== --}}
    <nav class="sidebar-nav">


        {{-- =================================================
             DASHBOARD
        ================================================== --}}
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-menu
           {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-house"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- =================================================
             KELOLA USER
        ================================================== --}}
        <a href="{{ route('admin.users.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

            <i class="fa-solid fa-users"></i>

            <span>
                Kelola User
            </span>

        </a>

        {{-- =================================================
     MASTER DATA
================================================== --}}
<a href="{{ route('admin.master.index') }}"
   class="sidebar-menu
   {{ request()->routeIs('admin.master.*') ? 'active' : '' }}">

    <i class="fa-solid fa-database"></i>

    <span>
        Master Data
    </span>

</a>


        {{-- =================================================
             KELOLA REGISTRASI
        ================================================== --}}
        <a href="{{ route('admin.registrasi.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('admin.registrasi.*') ? 'active' : '' }}">

            <i class="fa-solid fa-clipboard-list"></i>

            <span>
                Kelola Registrasi
            </span>

        </a>


        {{-- =================================================
             KELOLA TIKET
        ================================================== --}}
        <a href="{{ route('admin.tiket.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('admin.tiket.*') ? 'active' : '' }}">

            <i class="fa-solid fa-ticket"></i>

            <span>
                Kelola Tiket
            </span>

        </a>


        {{-- =================================================
             MONITOR ANTREAN
        ================================================== --}}
        <a href="{{ route('admin.monitor.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('admin.monitor.*') ? 'active' : '' }}">

            <i class="fa-solid fa-desktop"></i>

            <span>
                Monitor Antrean
            </span>

        </a>


        {{-- =================================================
             PEMBATAS / SECTION SISTEM
        ================================================== --}}
        <div class="sidebar-section-title">
            SISTEM
        </div>


        {{-- =================================================
             PENGATURAN
        ================================================== --}}

        @php
            $pengaturanAktif = request()->routeIs('admin.pengaturan.*');
        @endphp


        <div class="sidebar-menu-group">

            {{-- PARENT PENGATURAN --}}
            <a href="javascript:void(0)"
               id="pengaturanMenu"
               class="sidebar-menu sidebar-menu-parent
               {{ $pengaturanAktif ? 'open' : '' }}">

                <i class="fa-solid fa-gear"></i>

                <span>
                    Pengaturan
                </span>

                <i class="fa-solid fa-chevron-down menu-arrow"></i>

            </a>


            {{-- =================================================
                 SUBMENU PENGATURAN
            ================================================== --}}
            <div id="pengaturanSubmenu"
                 class="sidebar-submenu
                 {{ $pengaturanAktif ? 'show' : '' }}">


                {{-- PENGATURAN ANTREAN --}}
                <a href="{{ route('admin.pengaturan.antrian') }}"
                   class="sidebar-submenu-item
                   {{ request()->routeIs('admin.pengaturan.antrian') ? 'active' : '' }}">

                    <i class="fa-solid fa-ticket"></i>

                    <span>
                        Pengaturan Antrean
                    </span>

                </a>


                {{-- NOTIFIKASI --}}
                <a href="{{ route('admin.pengaturan.notifikasi') }}"
                   class="sidebar-submenu-item
                   {{ request()->routeIs('admin.pengaturan.notifikasi') ? 'active' : '' }}">

                    <i class="fa-solid fa-bell"></i>

                    <span>
                        Notifikasi
                    </span>

                </a>

            </div>

        </div>

    </nav>


    {{-- =====================================================
         BAGIAN BAWAH SIDEBAR
    ====================================================== --}}
    <div class="sidebar-bottom">


        {{-- =================================================
             USER
        ================================================== --}}
        <div class="sidebar-user">

            <div class="sidebar-user-icon">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="sidebar-user-info">

                <strong>
                    {{ Auth::user()->nama ?? 'Admin Penjamu' }}
                </strong>

                <span>
                    {{ ucfirst(Auth::user()->role ?? 'Admin') }}
                </span>

            </div>

        </div>


        {{-- =================================================
             LOGOUT
        ================================================== --}}
        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="sidebar-logout">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>
                    Keluar
                </span>

            </button>

        </form>

    </div>

</aside>


{{-- =====================================================
     OVERLAY MOBILE
===================================================== --}}
<div class="sidebar-overlay"
     id="sidebarOverlay">
</div>