<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Master Data - SITAFAS</title>

    {{-- CSRF --}}
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- FONT --}}
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- FONT AWESOME --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    {{-- CSS SIDEBAR --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/sidebar.css') }}"
    >

    {{-- CSS MASTER --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/master.css') }}"
    >

</head>


<body>


{{-- =====================================================
     SIDEBAR
===================================================== --}}

<aside
    class="sidebar"
    id="sidebar"
>

    {{-- LOGO --}}
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


    {{-- MENU --}}
    <nav class="sidebar-nav">


        {{-- DASHBOARD --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-house"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- KELOLA USER --}}
        <a
            href="{{ route('admin.users.index') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-users"></i>

            <span>
                Kelola User
            </span>

        </a>


        {{-- MASTER DATA --}}
        <a
            href="{{ route('admin.master.index') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.master.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-database"></i>

            <span>
                Master Data
            </span>

        </a>


        {{-- KELOLA REGISTRASI --}}
        <a
            href="{{ route('admin.registrasi.index') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.registrasi.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-clipboard-list"></i>

            <span>
                Kelola Registrasi
            </span>

        </a>


        {{-- KELOLA TIKET --}}
        <a
            href="{{ route('admin.tiket.index') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.tiket.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-ticket"></i>

            <span>
                Kelola Tiket
            </span>

        </a>


        {{-- MONITOR --}}
        <a
            href="{{ route('admin.monitor.index') }}"
            class="sidebar-menu
            {{ request()->routeIs('admin.monitor.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-desktop"></i>

            <span>
                Monitor Antrean
            </span>

        </a>


        {{-- SECTION --}}
        <div class="sidebar-section-title">
            SISTEM
        </div>


        {{-- PENGATURAN --}}
        @php
            $pengaturanAktif =
                request()->routeIs('admin.pengaturan.*');
        @endphp


        <div class="sidebar-menu-group">


            <a
                href="javascript:void(0)"
                id="pengaturanMenu"
                class="sidebar-menu sidebar-menu-parent
                {{ $pengaturanAktif ? 'open' : '' }}"
            >

                <i class="fa-solid fa-gear"></i>

                <span>
                    Pengaturan
                </span>

                <i class="fa-solid fa-chevron-down menu-arrow"></i>

            </a>


            {{-- SUBMENU --}}
            <div
                id="pengaturanSubmenu"
                class="sidebar-submenu
                {{ $pengaturanAktif ? 'show' : '' }}"
            >


                {{-- ANTREAN --}}
                <a
                    href="{{ route('admin.pengaturan.antrian') }}"
                    class="sidebar-submenu-item
                    {{ request()->routeIs('admin.pengaturan.antrian') ? 'active' : '' }}"
                >

                    <i class="fa-solid fa-ticket"></i>

                    <span>
                        Pengaturan Antrean
                    </span>

                </a>


                {{-- NOTIFIKASI --}}
                <a
                    href="{{ route('admin.pengaturan.notifikasi') }}"
                    class="sidebar-submenu-item
                    {{ request()->routeIs('admin.pengaturan.notifikasi') ? 'active' : '' }}"
                >

                    <i class="fa-solid fa-bell"></i>

                    <span>
                        Notifikasi
                    </span>

                </a>

            </div>

        </div>

    </nav>


    {{-- USER BAWAH --}}
    <div class="sidebar-bottom">


        <div class="sidebar-user">

            <div class="sidebar-user-icon">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="sidebar-user-info">

                <strong>
                    {{ Auth::user()->nama ?? 'Admin' }}
                </strong>

                <span>
                    {{ ucfirst(Auth::user()->role ?? 'admin') }}
                </span>

            </div>

        </div>


        {{-- LOGOUT --}}
        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="sidebar-logout"
            >

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>
                    Keluar
                </span>

            </button>

        </form>

    </div>

</aside>


{{-- OVERLAY --}}
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>



{{-- =====================================================
     MAIN CONTENT
===================================================== --}}

<main
    class="main-content"
    id="mainContent"
>


    <div class="master-page">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="master-header">


            <div class="master-header-left">


                {{-- HAMBURGER --}}
                <button
                    type="button"
                    class="master-hamburger"
                    id="sidebarToggle"
                    aria-label="Buka/Tutup Sidebar"
                >

                    <i class="fa-solid fa-bars"></i>

                </button>


                <div>

                    <h1>
                        Master Data
                    </h1>

                    <p>
                        Kelola data Perguruan Tinggi,
                        Faswil, Meja, Sesi, Jadwal
                        dan Pendamping
                    </p>

                </div>

            </div>


            {{-- USER HEADER --}}
            <div class="master-header-user">


                <div class="master-user-icon">

                    <i class="fa-solid fa-user"></i>

                </div>


                <div class="master-user-info">

                    <strong>
                        {{ Auth::user()->nama ?? 'Admin' }}
                    </strong>

                    <span>
                        {{ ucfirst(Auth::user()->role ?? 'admin') }}
                    </span>

                </div>

            </div>

        </div>



        {{-- =================================================
             FLASH SUCCESS
        ================================================== --}}

        @if(session('success'))

            <div class="master-alert master-alert-success">

                <div class="master-alert-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>


                <div class="master-alert-content">

                    <strong>
                        Berhasil
                    </strong>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>


                <button
                    type="button"
                    class="master-alert-close"
                    onclick="this.parentElement.remove()"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

        @endif



        {{-- =================================================
             FLASH ERROR
        ================================================== --}}

        @if(session('error'))

            <div class="master-alert master-alert-error">

                <div class="master-alert-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>


                <div class="master-alert-content">

                    <strong>
                        Gagal
                    </strong>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>


                <button
                    type="button"
                    class="master-alert-close"
                    onclick="this.parentElement.remove()"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

        @endif



        {{-- =================================================
             VALIDATION ERROR
        ================================================== --}}

        @if($errors->any())

            <div class="master-alert master-alert-error">

                <div class="master-alert-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>


                <div class="master-alert-content">

                    <strong>
                        Gagal
                    </strong>

                    @foreach($errors->all() as $error)

                        <span>
                            {{ $error }}
                        </span>

                    @endforeach

                </div>


                <button
                    type="button"
                    class="master-alert-close"
                    onclick="this.parentElement.remove()"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

        @endif



        {{-- =================================================
             UPLOAD DOKUMEN
        ================================================== --}}

        <div class="master-upload-card">


            <div class="master-upload-header">

                <div class="master-upload-title">


                    <div class="master-upload-icon">

                        <i class="fa-solid fa-file-excel"></i>

                    </div>


                    <div>

                        <h2>
                            Upload Dokumen Master
                        </h2>

                        <p>
                            Upload file Excel untuk
                            membuat data master secara otomatis.
                        </p>

                    </div>

                </div>

            </div>



            {{-- FORM UPLOAD --}}

            <form
                action="{{ route('admin.master.upload') }}"
                method="POST"
                enctype="multipart/form-data"
                class="master-upload-form"
            >

                @csrf


                <div class="master-file-wrapper">


                    <label
                        for="masterFile"
                        class="master-file-label"
                    >

                        <i class="fa-solid fa-cloud-arrow-up"></i>

                        <span>
                            Pilih Dokumen Excel
                        </span>

                        <small>
                            .xlsx, .xls atau .csv
                        </small>

                    </label>


                    <input
                        type="file"
                        name="file"
                        id="masterFile"
                        accept=".xlsx,.xls,.csv"
                        required
                    >

                </div>


                <div class="master-upload-actions">

                    <button
                        type="submit"
                        class="master-btn master-btn-primary"
                    >

                        <i class="fa-solid fa-upload"></i>

                        Upload Dokumen

                    </button>

                </div>

            </form>



            {{-- FORMAT EXCEL --}}

            <div class="master-upload-info">


                <div class="master-info-icon">

                    <i class="fa-solid fa-circle-info"></i>

                </div>


                <div>

                    <strong>
                        Format dokumen
                    </strong>

                    <p>
                        Pastikan header Excel memiliki kolom:
                    </p>


                    <div class="master-column-list">

                        <span>No</span>

                        <span>Kode PT</span>

                        <span>Nama PT</span>

                        <span>Nama Faswil</span>

                        <span>No. Meja</span>

                        <span>Sesi</span>

                        <span>Tanggal</span>

                        <span>Jam </span>

                        <span>Pendamping</span>

                    </div>


                    <p class="master-example">

                        Contoh format jam:

                        <strong>
                            08.00 - 10.00
                        </strong>

                    </p>

                </div>

            </div>

        </div>



        {{-- =================================================
             DATA MASTER
        ================================================== --}}

        <div class="master-data-card">


            {{-- HEADER DATA --}}

            <div class="master-data-header">


                <div>

                    <h2>
                        Data Master
                    </h2>


                    <p>

                        Menampilkan

                        <strong>
                            {{ $masters->firstItem() ?? 0 }}
                        </strong>

                        -

                        <strong>
                            {{ $masters->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $masters->total() }}
                        </strong>

                        data

                    </p>

                </div>


                <!-- SEARCH DATA MASTER -->
<div class="master-search">

    <form action="{{ route('admin.master.index') }}" method="GET">

        <div class="search-box">

            <i class="fas fa-search"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama perguruan tinggi..."
                autocomplete="off"
            >

        </div>

        <button type="submit" class="btn-search">
            <i class="fas fa-search"></i>
            Cari
        </button>

        @if(request('search'))
            <a
                href="{{ route('admin.master.index') }}"
                class="btn-reset"
            >
                <i class="fas fa-rotate-left"></i>
                Reset
            </a>
        @endif

    </form>

</div>


                {{-- HAPUS SEMUA --}}
                @if($masters->count() > 0)

                    <form
                        action="{{ route('admin.master.destroyAll') }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus seluruh data master? Data yang sudah dihapus tidak dapat dikembalikan.')"
                    >

                        @csrf

                        @method('DELETE')


                        <button
                            type="submit"
                            class="master-btn master-btn-danger"
                        >

                            <i class="fa-solid fa-trash"></i>

                            Hapus Semua

                        </button>

                    </form>

                @endif

            </div>



            {{-- TABLE --}}

            <div class="master-table-wrapper">


                <table class="master-table">


                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Kode PT
                            </th>

                            <th>
                                Nama Perguruan Tinggi
                            </th>

                            <th>
                                Faswil
                            </th>

                            <th>
                                Meja
                            </th>

                            <th>
                                Sesi
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Jam
                            </th>

                            <th>
                                Pendamping
                            </th>

                            <th width="90">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($masters as $master)

                            <tr>


                                {{-- NO --}}

                                <td class="master-number">

                                    {{ $masters->firstItem() + $loop->index }}

                                </td>


                                {{-- KODE PT --}}

                                <td>

                                    <span class="master-code">

                                        {{ $master->kode_pt }}

                                    </span>

                                </td>


                                {{-- NAMA PT --}}

                                <td>

                                    <div class="master-pt">

                                        <strong>
                                            {{ $master->nama_pt }}
                                        </strong>

                                    </div>

                                </td>


                                {{-- FASWIL --}}

                                <td>

                                    <span class="master-badge master-badge-faswil">

                                        {{ $master->nama_faswil }}

                                    </span>

                                </td>


                                {{-- MEJA --}}

                                <td>

                                    <span class="master-desk">

                                        {{ $master->no_meja }}

                                    </span>

                                </td>


                                {{-- SESI --}}

                                <td>

                                    <span class="master-badge master-badge-sesi">

                                        {{ $master->sesi }}

                                    </span>

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    @if($master->tanggal)

                                        {{ \Carbon\Carbon::parse($master->tanggal)->translatedFormat('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- JAM --}}

                                <td>

                                    <span class="master-time">

                                        @if(
                                            $master->jam_mulai &&
                                            $master->jam_selesai
                                        )

                                            {{ \Carbon\Carbon::parse($master->jam_mulai)->format('H.i') }}

                                            -

                                            {{ \Carbon\Carbon::parse($master->jam_selesai)->format('H.i') }}

                                        @else

                                            -

                                        @endif

                                    </span>

                                </td>


                                {{-- PENDAMPING --}}

                                <td>

                                    <div class="master-pendamping">

                                        <i class="fa-solid fa-user-tie"></i>

                                        <span>
                                            {{ $master->pendamping }}
                                        </span>

                                    </div>

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="master-action">


                                        <form
                                            action="{{ route('admin.master.destroy', $master->id_master) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="master-action-delete"
                                                title="Hapus"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="10"
                                    class="master-empty"
                                >

                                    <div class="master-empty-icon">

                                        <i class="fa-solid fa-database"></i>

                                    </div>


                                    <strong>
                                        Belum ada data master
                                    </strong>


                                    <span>
                                        Silakan upload dokumen Excel
                                        untuk memasukkan data master.
                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>



            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            @if($masters->hasPages())

                <div class="master-pagination">


                    <div class="master-pagination-info">

                        Menampilkan

                        <strong>
                            {{ $masters->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $masters->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $masters->total() }}
                        </strong>

                        data

                    </div>


                    <div class="master-pagination-links">


                        {{-- PREVIOUS --}}

                        @if($masters->onFirstPage())

                            <span class="master-page disabled">

                                <i class="fa-solid fa-chevron-left"></i>

                            </span>

                        @else

                            <a
                                href="{{ $masters->previousPageUrl() }}"
                                class="master-page"
                            >

                                <i class="fa-solid fa-chevron-left"></i>

                            </a>

                        @endif



                        {{-- NOMOR --}}

                        @foreach(
                            $masters->getUrlRange(
                                max(1, $masters->currentPage() - 2),
                                min($masters->lastPage(), $masters->currentPage() + 2)
                            )
                            as $page => $url
                        )

                            @if(
                                $page ==
                                $masters->currentPage()
                            )

                                <span class="master-page active">
                                    {{ $page }}
                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="master-page"
                                >

                                    {{ $page }}

                                </a>

                            @endif

                        @endforeach



                        {{-- NEXT --}}

                        @if($masters->hasMorePages())

                            <a
                                href="{{ $masters->nextPageUrl() }}"
                                class="master-page"
                            >

                                <i class="fa-solid fa-chevron-right"></i>

                            </a>

                        @else

                            <span class="master-page disabled">

                                <i class="fa-solid fa-chevron-right"></i>

                            </span>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

</main>



{{-- =====================================================
     JAVASCRIPT
===================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const sidebar =
            document.getElementById('sidebar');


        const toggleButton =
            document.getElementById('sidebarToggle');


        const overlay =
            document.getElementById('sidebarOverlay');


        /*
        |--------------------------------------------------------------------------
        | TOGGLE SIDEBAR
        |--------------------------------------------------------------------------
        */

        if (
            sidebar &&
            toggleButton
        ) {

            toggleButton.addEventListener(
                'click',
                function () {


                    /*
                    |--------------------------------------------------------------------------
                    | DESKTOP
                    |--------------------------------------------------------------------------
                    */

                    if (
                        window.innerWidth > 768
                    ) {

                        sidebar.classList.toggle(
                            'closed'
                        );


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

                        sidebar.classList.toggle(
                            'mobile-open'
                        );


                        if (overlay) {

                            overlay.classList.toggle(
                                'show'
                            );

                        }

                    }

                }
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

                    sidebar.classList.remove(
                        'mobile-open'
                    );

                    overlay.classList.remove(
                        'show'
                    );

                }
            );

        }



        /*
        |--------------------------------------------------------------------------
        | PENGATURAN
        |--------------------------------------------------------------------------
        */

        const pengaturanMenu =
            document.getElementById(
                'pengaturanMenu'
            );


        const pengaturanSubmenu =
            document.getElementById(
                'pengaturanSubmenu'
            );


        if (
            pengaturanMenu &&
            pengaturanSubmenu
        ) {

            pengaturanMenu.addEventListener(
                'click',
                function () {

                    pengaturanMenu.classList.toggle(
                        'open'
                    );


                    pengaturanSubmenu.classList.toggle(
                        'show'
                    );

                }
            );

        }



        /*
        |--------------------------------------------------------------------------
        | RESIZE
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'resize',
            function () {

                if (
                    window.innerWidth > 768
                ) {

                    sidebar.classList.remove(
                        'mobile-open'
                    );


                    if (overlay) {

                        overlay.classList.remove(
                            'show'
                        );

                    }

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NAMA FILE EXCEL
        |--------------------------------------------------------------------------
        */

        const fileInput =
            document.getElementById(
                'masterFile'
            );


        const fileLabel =
            document.querySelector(
                '.master-file-label span'
            );


        if (
            fileInput &&
            fileLabel
        ) {

            fileInput.addEventListener(
                'change',
                function () {

                    if (
                        this.files &&
                        this.files.length > 0
                    ) {

                        fileLabel.textContent =
                            this.files[0].name;

                    }

                }
            );

        }

    }
);

</script>


</body>

</html>