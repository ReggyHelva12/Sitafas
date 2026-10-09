<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Monitor Antrean - SITAFAS</title>


    {{-- =====================================================
         FONT POPPINS
    ====================================================== --}}

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- =====================================================
         SIDEBAR CSS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/sidebar.css') }}">


    {{-- =====================================================
         MONITOR CSS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/monitor.css') }}">

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('pages.Layouts.sidebar')


    {{-- =====================================================
         OVERLAY
    ====================================================== --}}

    <div class="sidebar-overlay"
         id="sidebarOverlay">
    </div>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main-content">

        <div class="page-container">


            {{-- =================================================
                 PAGE HEADER
            ================================================== --}}

            <div class="page-header">

                <div class="page-header-left">


                    {{-- HAMBURGER --}}

                    <button
                        type="button"
                        class="hamburger-btn"
                        id="mobileMenuButton"
                        aria-label="Buka atau tutup sidebar">

                        <i class="fa-solid fa-bars"></i>

                    </button>


                    {{-- JUDUL --}}

                    <div class="page-title-wrapper">

                        <h1 class="page-title">
                            Monitor Antrean
                        </h1>

                        <p class="page-subtitle">
                            Pantau antrean pelayanan Faswil secara real-time
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     USER HEADER
                ================================================== --}}

                <div class="header-user">

                    <div class="header-user-icon">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div class="header-user-info">

                        <strong>
                            {{ Auth::user()->nama ?? 'Admin Penjamu' }}
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 ALERT SUCCESS
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 ALERT ERROR
            ================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 CARD MONITOR ANTREAN
            ================================================== --}}

            <div class="monitor-card">


                {{-- =================================================
                     CARD HEADER
                ================================================== --}}

                <div class="monitor-card-header">

                    <div>

                        <h2>
                            Monitor Antrean
                        </h2>

                        <p>
                            Pantau status antrean dan pelayanan setiap meja
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     STATISTIK ANTREAN
                ================================================== --}}

                <div class="monitor-statistics">


                    {{-- TOTAL TIKET --}}

                    <div class="monitor-stat-card">

                        <div class="monitor-stat-icon">

                            <i class="fa-solid fa-ticket"></i>

                        </div>

                        <div class="monitor-stat-info">

                            <span>
                                TOTAL TIKET
                            </span>

                            <strong>
                                {{ $totalTiket ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    {{-- MENUNGGU --}}

                    <div class="monitor-stat-card">

                        <div class="monitor-stat-icon">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                        <div class="monitor-stat-info">

                            <span>
                                MENUNGGU
                            </span>

                            <strong>
                                {{ $menunggu ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    {{-- DIPANGGIL --}}

                    <div class="monitor-stat-card">

                        <div class="monitor-stat-icon">

                            <i class="fa-solid fa-bullhorn"></i>

                        </div>

                        <div class="monitor-stat-info">

                            <span>
                                DIPANGGIL
                            </span>

                            <strong>
                                {{ $dipanggil ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    {{-- SELESAI --}}

                    <div class="monitor-stat-card">

                        <div class="monitor-stat-icon">

                            <i class="fa-solid fa-user-check"></i>

                        </div>

                        <div class="monitor-stat-info">

                            <span>
                                SELESAI
                            </span>

                            <strong>
                                {{ $selesai ?? 0 }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FILTER
                ================================================== --}}

                <form
                    method="GET"
                    action="{{ url()->current() }}"
                    id="monitorFilterForm"
                    class="monitor-filter">


                    {{-- =================================================
                         SEARCH
                    ================================================== --}}

                    <div class="monitor-search">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            name="search"
                            id="searchTiket"
                            value="{{ request('search') }}"
                            placeholder="Cari tiket atau nama PT..."
                            autocomplete="off">

                    </div>


                    {{-- =================================================
                         FILTER TANGGAL
                    ================================================== --}}

                    <div class="monitor-date-filter">

                        <i class="fa-regular fa-calendar"></i>

                        <input
                            type="date"
                            name="tanggal"
                            id="filterTanggal"
                            value="{{ $tanggal ?? request('tanggal', now()->format('Y-m-d')) }}"
                            title="Pilih tanggal antrean">

                    </div>


                    {{-- =================================================
                         FILTER STATUS
                    ================================================== --}}

                    <div class="monitor-status-filter">

                        <select
                            name="status"
                            id="filterStatus">

                            <option
                                value="semua"
                                {{ request('status', 'semua') === 'semua' ? 'selected' : '' }}>
                                Semua Status
                            </option>

                            <option
                                value="menunggu"
                                {{ request('status') === 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option
                                value="dilayani"
                                {{ request('status') === 'dilayani' ? 'selected' : '' }}>
                                Dilayani
                            </option>

                            <option
                                value="selesai"
                                {{ request('status') === 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                        <i class="fa-solid fa-chevron-down"></i>

                    </div>


                    {{-- =================================================
                         BUTTON FILTER
                    ================================================== --}}

                    <button
                        type="submit"
                        class="monitor-filter-btn">

                        <i class="fa-solid fa-filter"></i>

                        Filter

                    </button>


                    {{-- =================================================
                         RESET
                    ================================================== --}}

                    @if(request()->hasAny([
                        'search',
                        'status',
                        'tanggal'
                    ]))

                        <a
                            href="{{ url()->current() }}"
                            class="monitor-reset-btn"
                            title="Reset filter">

                            <i class="fa-solid fa-rotate-left"></i>

                            Reset

                        </a>

                    @endif

                </form>


                {{-- =================================================
                     INFORMASI TANGGAL
                ================================================== --}}

                <div class="monitor-date-info">

                    <i class="fa-regular fa-calendar"></i>

                    <span>

                        Menampilkan antrean tanggal

                        <strong>

                            {{ \Carbon\Carbon::parse(
                                $tanggal ?? now()
                            )->format('d-m-Y') }}

                        </strong>

                    </span>

                </div>


                {{-- =================================================
                     TABLE
                ================================================== --}}

                <div class="monitor-table-wrapper">

                    <table
                        class="monitor-table"
                        id="monitorTable">


                        {{-- =================================================
                             TABLE HEADER
                        ================================================== --}}

                        <thead>

                            <tr>

                                <th width="7%">
                                    #
                                </th>

                                <th width="16%">
                                    NO TIKET
                                </th>

                                <th width="25%">
                                    PERGURUAN TINGGI
                                </th>

                                <th width="16%">
                                    FASWIL
                                </th>

                                <th width="13%">
                                    MEJA
                                </th>

                                <th width="13%">
                                    STATUS
                                </th>

                                

                            </tr>

                        </thead>


                        {{-- =================================================
                             TABLE BODY
                        ================================================== --}}

                        <tbody>


                            @forelse($tikets ?? [] as $index => $tiket)

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | REGISTRASI
                                    |--------------------------------------------------------------------------
                                    */

                                    $registrasi = $tiket->registrasi;


                                    /*
                                    |--------------------------------------------------------------------------
                                    | MASTER
                                    |--------------------------------------------------------------------------
                                    |
                                    | Data PT, Faswil dan Meja berasal
                                    | dari tabel masters melalui registrasi.
                                    |
                                    */

                                    $master = $registrasi
                                        ? $registrasi->master
                                        : null;


                                    /*
                                    |--------------------------------------------------------------------------
                                    | NOMOR URUT
                                    |--------------------------------------------------------------------------
                                    */

                                    $nomorUrut = method_exists(
                                        $tikets,
                                        'firstItem'
                                    )
                                        ? $tikets->firstItem() + $index
                                        : $index + 1;

                                @endphp


                                <tr
                                    class="monitor-row"
                                    data-status="{{ strtolower($tiket->status ?? '') }}"
                                    data-tanggal="{{ $tiket->tanggal_antrian
                                        ? \Carbon\Carbon::parse($tiket->tanggal_antrian)->format('Y-m-d')
                                        : '' }}"
                                    data-search="{{ strtolower(
                                        ($tiket->nomor_tiket ?? '') . ' ' .
                                        ($master->nama_pt ?? '') . ' ' .
                                        ($master->nama_faswil ?? '') . ' ' .
                                        ($master->no_meja ?? '')
                                    ) }}">


                                    {{-- =================================================
                                         NOMOR
                                    ================================================== --}}

                                    <td>

                                        <strong>
                                            {{ $nomorUrut }}
                                        </strong>

                                    </td>


                                    {{-- =================================================
                                         NOMOR TIKET
                                    ================================================== --}}

                                    <td>

                                        <div class="tiket-number">

                                            <i class="fa-solid fa-ticket"></i>

                                            <strong>

                                                {{ preg_replace('/^[A-Za-z]+-/', '', $tiket->nomor_tiket) }}

                                            </strong>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         PERGURUAN TINGGI
                                    ================================================== --}}

                                    <td>

                                        @if($master)

                                            <div class="pt-name">

                                                <span>

                                                    {{ $master->nama_pt ?? '-' }}

                                                </span>

                                            </div>

                                        @else

                                            <span class="data-empty">
                                                Data PT tidak ditemukan
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         FASWIL
                                    ================================================== --}}

                                    <td>

                                        @if($master)

                                            <span class="faswil-name">

                                                {{ $master->nama_faswil ?? '-' }}

                                            </span>

                                        @else

                                            <span class="data-empty">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         MEJA
                                    ================================================== --}}

                                    <td>

                                        @if($master)

                                            <span class="meja-name">

                                                {{ $master->no_meja ?? '-' }}

                                            </span>

                                        @else

                                            <span class="data-empty">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         STATUS
                                    ================================================== --}}

                                    <td>

                                        @switch($tiket->status)


                                            {{-- MENUNGGU --}}

                                            @case('menunggu')

                                                <span
                                                    class="status-badge status-menunggu">

                                                    <span class="status-dot"></span>

                                                    Menunggu

                                                </span>

                                                @break


                                            {{-- DIPANGGIL --}}

                                            @case('dipanggil')

                                                <span
                                                    class="status-badge status-dipanggil">

                                                    <span class="status-dot"></span>

                                                    Dipanggil

                                                </span>

                                                @break


                                            {{-- DILAYANI --}}

                                            @case('dilayani')

                                                <span
                                                    class="status-badge status-dilayani">

                                                    <span class="status-dot"></span>

                                                    Dilayani

                                                </span>

                                                @break


                                            {{-- DILEWATI --}}

                                            @case('dilewati')

                                                <span
                                                    class="status-badge status-dilewat">

                                                    <span class="status-dot"></span>

                                                    Dilewati

                                                </span>

                                                @break


                                            {{-- SELESAI --}}

                                            @case('selesai')

                                                <span
                                                    class="status-badge status-selesai">

                                                    <span class="status-dot"></span>

                                                    Selesai

                                                </span>

                                                @break


                                            {{-- DEFAULT --}}

                                            @default

                                                <span
                                                    class="status-badge status-menunggu">

                                                    <span class="status-dot"></span>

                                                    {{ ucfirst(
                                                        $tiket->status ?? 'Menunggu'
                                                    ) }}

                                                </span>

                                        @endswitch

                                    </td>

                                </tr>


                            @empty


                                {{-- =================================================
                                     DATA KOSONG
                                ================================================== --}}

                                <tr>

                                    <td colspan="7">

                                        <div class="empty-monitor">

                                            <div class="empty-monitor-icon">

                                                <i class="fa-solid fa-ticket"></i>

                                            </div>

                                            <h3>
                                                Belum ada antrean
                                            </h3>

                                            <p>

                                                Belum terdapat tiket antrean
                                                pada tanggal

                                                <strong>
                                                    {{ \Carbon\Carbon::parse(
                                                        $tanggal ?? now()
                                                    )->format('d-m-Y') }}
                                                </strong>.

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>


                    {{-- =================================================
                         SEARCH EMPTY
                    ================================================== --}}

                    <div
                        id="searchEmpty"
                        class="search-empty"
                        style="display:none;">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <h3>
                            Data tidak ditemukan
                        </h3>

                        <p>
                            Tidak ada tiket yang sesuai
                            dengan pencarian.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($tikets && $tikets->hasPages())

                    <div class="pagination-wrapper">


                        {{-- INFORMASI DATA --}}

                        <div class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $tikets->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $tikets->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $tikets->total() }}
                            </strong>

                            data antrean

                        </div>


                        {{-- PAGINATION --}}

                        <div class="pagination">


                            {{-- PREVIOUS --}}

                            @if($tikets->onFirstPage())

                                <span class="page-btn disabled">

                                    <i class="fa-solid fa-chevron-left"></i>

                                </span>

                            @else

                                <a
                                    href="{{ $tikets->previousPageUrl() }}"
                                    class="page-btn">

                                    <i class="fa-solid fa-chevron-left"></i>

                                </a>

                            @endif


                            {{-- NOMOR HALAMAN --}}

                            @foreach(
                                $tikets->getUrlRange(
                                    max(
                                        1,
                                        $tikets->currentPage() - 2
                                    ),
                                    min(
                                        $tikets->lastPage(),
                                        $tikets->currentPage() + 2
                                    )
                                ) as $page => $url
                            )

                                @if(
                                    $page ==
                                    $tikets->currentPage()
                                )

                                    <span class="page-btn active">

                                        {{ $page }}

                                    </span>

                                @else

                                    <a
                                        href="{{ $url }}"
                                        class="page-btn">

                                        {{ $page }}

                                    </a>

                                @endif

                            @endforeach


                            {{-- NEXT --}}

                            @if($tikets->hasMorePages())

                                <a
                                    href="{{ $tikets->nextPageUrl() }}"
                                    class="page-btn">

                                    <i class="fa-solid fa-chevron-right"></i>

                                </a>

                            @else

                                <span class="page-btn disabled">

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
         MONITOR JAVASCRIPT
    ====================================================== --}}

    <script src="{{ asset('js/monitor.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>


    {{-- =====================================================
         FILTER JAVASCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const form =
                    document.getElementById(
                        'monitorFilterForm'
                    );

                const tanggal =
                    document.getElementById(
                        'filterTanggal'
                    );

                const status =
                    document.getElementById(
                        'filterStatus'
                    );

                const search =
                    document.getElementById(
                        'searchTiket'
                    );


                /*
                |--------------------------------------------------------------------------
                | FILTER TANGGAL
                |--------------------------------------------------------------------------
                |
                | Ketika tanggal berubah,
                | form langsung dikirim ke controller.
                |
                */

                if (tanggal) {

                    tanggal.addEventListener(
                        'change',
                        function () {

                            form.submit();

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | FILTER STATUS
                |--------------------------------------------------------------------------
                */

                if (status) {

                    status.addEventListener(
                        'change',
                        function () {

                            form.submit();

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | SEARCH
                |--------------------------------------------------------------------------
                |
                | Search menggunakan server-side melalui
                | MonitorController.
                |
                */

                if (search) {

                    search.addEventListener(
                        'keydown',
                        function (event) {

                            if (
                                event.key === 'Enter'
                            ) {

                                event.preventDefault();

                                form.submit();

                            }

                        }
                    );

                }

            }
        );

    </script>


</body>

</html>