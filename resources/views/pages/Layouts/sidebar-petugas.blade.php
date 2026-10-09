{{-- =====================================================
     SIDEBAR PETUGAS SITAFAS
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
         MENU PETUGAS
    ================================================== --}}
    <nav class="sidebar-nav">

        {{-- DASHBOARD --}}
        <a href="{{ route('petugas.dashboard') }}"
           class="sidebar-menu
           {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-house"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- ANTREAN --}}
        <a href="{{ route('petugas.antrean.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('petugas.antrean.*') ? 'active' : '' }}">

            <i class="fa-solid fa-list-ol"></i>

            <span>
                Antrean
            </span>

        </a>


        {{-- KELOLA REGISTRASI PETUGAS --}}
        <a href="{{ route('petugas.registrasi.index') }}"
           class="sidebar-menu
           {{ request()->routeIs('petugas.registrasi.*') ? 'active' : '' }}">

            <i class="fa-solid fa-clipboard-list"></i>

            <span>
                Kelola Registrasi
            </span>

        </a>

    </nav>

</aside>


{{-- =====================================================
     OVERLAY MOBILE
===================================================== --}}
<div
    class="sidebar-overlay"
    id="sidebarOverlay">
</div>


{{-- =====================================================
     CSS SIDEBAR
===================================================== --}}
<style>

    /* =====================================================
       SIDEBAR UTAMA
    ===================================================== */

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;

        width: 335px;
        height: 100vh;

        z-index: 1000;

        transition:
            width 0.35s ease,
            transform 0.35s ease;

        overflow: hidden;

        background: linear-gradient(
            180deg,
            #ff8a00 0%,
            #ffc107 100%
        );
    }


    /* =====================================================
       SIDEBAR CLOSED
    ===================================================== */

    .sidebar.closed {
        width: 0;
    }


    /* =====================================================
       AREA KONTEN UTAMA
    ===================================================== */

    .main-content {
        margin-left: 335px;

        width: calc(100% - 335px);

        min-height: 100vh;

        transition:
            margin-left 0.35s ease,
            width 0.35s ease;
    }


    /* =====================================================
       KETIKA SIDEBAR DITUTUP
    ===================================================== */

    body.sidebar-closed .main-content {

        margin-left: 0;

        width: 100%;
    }


    /* =====================================================
       HAMBURGER BUTTON
    ===================================================== */

    .sidebar-toggle {

        width: 90px;
        height: 90px;

        border: none;
        border-radius: 25px;

        background: #ffffff;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        box-shadow:
            0 10px 30px rgba(0,0,0,0.08);

        transition: 0.25s ease;

        position: relative;

        z-index: 1100;
    }


    .sidebar-toggle:hover {

        transform: scale(1.03);
    }


    .sidebar-toggle i {

        font-size: 38px;

        color: #075985;
    }


    /* =====================================================
       OVERLAY
    ===================================================== */

    .sidebar-overlay {

        display: none;

        position: fixed;

        inset: 0;

        background: rgba(0,0,0,0.35);

        z-index: 999;
    }


    /* =====================================================
       MOBILE
    ===================================================== */

    @media (max-width: 900px) {

        .sidebar {

            width: 280px;

            transform: translateX(0);
        }


        .sidebar.closed {

            width: 280px;

            transform: translateX(-100%);
        }


        .main-content {

            margin-left: 0;

            width: 100%;
        }


        body.sidebar-closed .main-content {

            margin-left: 0;

            width: 100%;
        }


        body.sidebar-open-mobile
        .sidebar-overlay {

            display: block;
        }

    }

</style>


{{-- =====================================================
     JAVASCRIPT SIDEBAR
===================================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');

    const overlay = document.getElementById('sidebarOverlay');

    const toggleButton = document.querySelector('.sidebar-toggle');


    if (!sidebar) {
        console.warn('Sidebar tidak ditemukan.');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | FUNGSI TOGGLE SIDEBAR
    |--------------------------------------------------------------------------
    */

    function toggleSidebar() {

        const isMobile = window.innerWidth <= 900;


        /*
        |--------------------------------------------------------------------------
        | DESKTOP
        |--------------------------------------------------------------------------
        */

        if (!isMobile) {

            sidebar.classList.toggle('closed');

            document.body.classList.toggle(
                'sidebar-closed'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        else {

            sidebar.classList.toggle('closed');

            document.body.classList.toggle(
                'sidebar-open-mobile'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | TOMBOL HAMBURGER
    |--------------------------------------------------------------------------
    */

    if (toggleButton) {

        toggleButton.addEventListener(
            'click',
            toggleSidebar
        );

    }


    /*
    |--------------------------------------------------------------------------
    | OVERLAY MOBILE
    |--------------------------------------------------------------------------
    */

    if (overlay) {

        overlay.addEventListener(
            'click',
            function () {

                if (window.innerWidth <= 900) {

                    sidebar.classList.add('closed');

                    document.body.classList.remove(
                        'sidebar-open-mobile'
                    );

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'resize',
        function () {

            if (window.innerWidth > 900) {

                sidebar.classList.remove('closed');

                document.body.classList.remove(
                    'sidebar-open-mobile'
                );

                document.body.classList.remove(
                    'sidebar-closed'
                );

            }

        }
    );

});

</script>