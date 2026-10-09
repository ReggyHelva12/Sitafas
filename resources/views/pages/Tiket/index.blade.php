<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kelola Tiket - SITAFAS</title>


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
         TIKET CSS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/tiket.css') }}">

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('pages.Layouts.sidebar')


    {{-- =====================================================
         OVERLAY MOBILE
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

                    <button type="button"
                            id="menuToggle"
                            class="hamburger-btn"
                            aria-label="Buka/Tutup Sidebar">

                        <i class="fa-solid fa-bars"></i>

                    </button>


                    {{-- TITLE --}}

                    <div class="page-title-wrapper">

                        <h1 class="page-title">
                            Kelola Tiket
                        </h1>

                        <p class="page-subtitle">
                            Kelola tiket layanan yang diajukan oleh pengguna
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     USER LOGIN
                ================================================== --}}

                <div class="header-user">

                    <div class="header-user-icon">

                        <i class="fa-solid fa-user"></i>

                    </div>


                    <div class="header-user-info">

                        <strong>
                            {{ Auth::user()->nama ?? 'Admin' }}
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success"
                     id="successAlert">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 ERROR MESSAGE
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
                 VALIDATION ERROR
            ================================================== --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- =================================================
                 DATA CARD
            ================================================== --}}

            <div class="data-card">


                {{-- =================================================
                     CARD HEADER
                ================================================== --}}

                <div class="content-header">

                    <div class="header-text">

                        <h2>
                            Kelola Tiket
                        </h2>

                        <p>
                            Data tiket layanan dari registrasi pengguna
                        </p>

                    </div>


                    {{-- EXPORT --}}

                    <a href="{{ route('admin.tiket.export', request()->query()) }}"
                       class="btn-export">

                        <i class="fa-solid fa-file-excel"></i>

                        <span>
                            Export Excel
                        </span>

                    </a>

                </div>


                {{-- =================================================
                     FILTER
                ================================================== --}}

                <div class="filter-section">


                    {{-- SEARCH --}}

                    <div class="search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text"
                               id="searchTiket"
                               placeholder="Cari nomor tiket atau perguruan tinggi..."
                               autocomplete="off">

                    </div>


                    {{-- =================================================
                         WILAYAH / FASWIL
                    ================================================== --}}

                    <div class="status-filter">

                        <select id="wilayahFilter"
                                name="wilayah">

                            <option value="">
                                Semua Faswil
                            </option>

                            @if(isset($faswils))

                                @foreach($faswils as $faswil)
    <option value="{{ strtolower($faswil->nama_faswil) }}">
        {{ $faswil->nama_faswil }}
    </option>
@endforeach

                            @endif

                        </select>

                    </div>


                    {{-- =================================================
                         STATUS
                    ================================================== --}}

                    <div class="status-filter">

                        <select id="statusFilter">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="menunggu">
                                Menunggu
                            </option>

                            <option value="dilayani">
                                Dilayani
                            </option>

                            <option value="selesai">
                                Selesai
                            </option>

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     TABLE
                ================================================== --}}

                <div class="table-wrapper">

                    <table class="data-table"
                           id="tiketTable">


                        {{-- =================================================
                             TABLE HEADER
                        ================================================== --}}

                        <thead>

                            <tr>

                                <th width="55">
                                    #
                                </th>

                                <th>
                                    NOMOR TIKET
                                </th>

                                <th>
                                    PERGURUAN TINGGI
                                </th>

                                <th>
                                    FASWIL
                                </th>

                                <th>
                                    TANGGAL DAFTAR
                                </th>

                                <th>
                                    MULAI DIPANGGIL
                                </th>

                                <th>
                                    SELESAI
                                </th>

                                <th>
                                    STATUS
                                </th>

                                <th width="110">
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        {{-- =================================================
                             TABLE BODY
                        ================================================== --}}

                        <tbody id="tiketTableBody">

                            @forelse($tikets as $tiket)

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
                                    | SEMUA DATA PT, FASWIL, MEJA, SESI,
                                    | TANGGAL, JAM DAN PENDAMPING
                                    | SEKARANG DIAMBIL DARI MASTER.
                                    |
                                    */

                                    $master = $registrasi->master ?? null;


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATA PERGURUAN TINGGI
                                    |--------------------------------------------------------------------------
                                    */

                                    $namaPt =
                                        $master->nama_pt
                                        ?? '-';


                                    $kodePt =
                                        $master->kode_pt
                                        ?? '-';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATA FASWIL
                                    |--------------------------------------------------------------------------
                                    */

                                    $wilayah =
                                        $master->nama_faswil
                                        ?? '-';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATA MEJA
                                    |--------------------------------------------------------------------------
                                    */

                                    $noMeja =
                                        $master->no_meja
                                        ?? '-';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATA SESI
                                    |--------------------------------------------------------------------------
                                    */

                                    $sesi =
                                        $master->sesi
                                        ?? '-';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATA PENDAMPING
                                    |--------------------------------------------------------------------------
                                    */

                                    $pendamping =
                                        $master->pendamping
                                        ?? '-';

                                @endphp


                                <tr

                                    data-search="{{ strtolower(
                                        ($tiket->nomor_tiket ?? '') . ' ' .
                                        $namaPt . ' ' .
                                        $kodePt
                                    ) }}"

                                    data-wilayah="{{ strtolower($wilayah) }}"

                                    data-status="{{ strtolower($tiket->status ?? '') }}"

                                >


                                    {{-- =================================================
                                         NOMOR
                                    ================================================== --}}

                                    <td>

                                        {{ $tikets->firstItem() + $loop->index }}

                                    </td>


                                    {{-- =================================================
                                         NOMOR TIKET
                                    ================================================== --}}

                                    <td>

                                        <strong class="ticket-number">

                                            {{ preg_replace('/^[A-Za-z]+-/', '', $tiket->nomor_tiket) }}

                                        </strong>

                                    </td>


                                    {{-- =================================================
                                         PERGURUAN TINGGI
                                    ================================================== --}}

                                    <td>

                                        <div class="name-wrapper">

                                            <div class="name-icon">

                                                <i class="fa-solid fa-building-columns"></i>

                                            </div>


                                            <div class="name-content">

                                                <strong>
                                                    {{ $namaPt }}
                                                </strong>

                                                <br>

                                                <small>
                                                    Kode: {{ $kodePt }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         WILAYAH
                                    ================================================== --}}

                                    <td>

                                        <span>

                                            {{ $wilayah }}

                                        </span>

                                        @if($noMeja !== '-')

                                            <br>

                                            <small style="color:#64748b;">

                                                Meja:
                                                <strong>
                                                    {{ $noMeja }}
                                                </strong>

                                            </small>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         TANGGAL DAFTAR
                                    ================================================== --}}

                                    <td>

                                        @if($tiket->waktu_daftar)

                                            <div class="date-wrapper">

                                                <span>

                                                    {{ $tiket->waktu_daftar->format('d-m-Y') }}

                                                </span>

                                                <small>

                                                    {{ $tiket->waktu_daftar->format('H:i') }}

                                                </small>

                                            </div>

                                        @else

                                            <span class="empty-time">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         MULAI DIPANGGIL
                                    ================================================== --}}

                                    <td>

                                        @if($tiket->waktu_mulai)

                                            <div class="date-wrapper">

                                                <span>

                                                    {{ $tiket->waktu_mulai->format('d-m-Y') }}

                                                </span>

                                                <small>

                                                    {{ $tiket->waktu_mulai->format('H:i') }}

                                                </small>

                                            </div>

                                        @else

                                            <span class="empty-time">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         SELESAI
                                    ================================================== --}}

                                    <td>

                                        @if($tiket->waktu_selesai)

                                            <div class="date-wrapper">

                                                <span>

                                                    {{ $tiket->waktu_selesai->format('d-m-Y') }}

                                                </span>

                                                <small>

                                                    {{ $tiket->waktu_selesai->format('H:i') }}

                                                </small>

                                            </div>

                                        @else

                                            <span class="empty-time">
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

                                                <span class="status-badge status-waiting">

                                                    <span class="status-dot"></span>

                                                    Menunggu

                                                </span>

                                            @break


                                            {{-- DIPANGGIL --}}

                                            @case('dipanggil')

                                                <span class="status-badge status-called">

                                                    <span class="status-dot"></span>

                                                    Dipanggil

                                                </span>

                                            @break


                                            {{-- DILAYANI --}}

                                            @case('dilayani')

                                                <span class="status-badge status-called">

                                                    <span class="status-dot"></span>

                                                    Dilayani

                                                </span>

                                            @break


                                            {{-- DILEWATI --}}

                                            @case('dilewati')

                                                <span class="status-badge status-skipped">

                                                    <span class="status-dot"></span>

                                                    Dilewati

                                                </span>

                                            @break


                                            {{-- DILEWAT --}}

                                            @case('dilewat')

                                                <span class="status-badge status-skipped">

                                                    <span class="status-dot"></span>

                                                    Dilewat

                                                </span>

                                            @break


                                            {{-- SELESAI --}}

                                            @case('selesai')

                                                <span class="status-badge status-completed">

                                                    <span class="status-dot"></span>

                                                    Selesai

                                                </span>

                                            @break


                                            {{-- DEFAULT --}}

                                            @default

                                                <span class="status-badge status-waiting">

                                                    <span class="status-dot"></span>

                                                    {{ ucfirst($tiket->status ?? 'Menunggu') }}

                                                </span>

                                        @endswitch

                                    </td>


                                    {{-- =================================================
                                         AKSI
                                    ================================================== --}}

                                    <td>

                                        <div class="action-buttons">


                                            {{-- DETAIL --}}

                                            <a href="{{ route(
                                                'admin.tiket.show',
                                                $tiket->id_tiket
                                            ) }}"
                                               class="btn-action btn-view"
                                               title="Lihat Detail">

                                                <i class="fa-solid fa-eye"></i>

                                            </a>


                                            {{-- HAPUS --}}

                                            <form action="{{ route(
                                                        'admin.tiket.destroy',
                                                        $tiket->id_tiket
                                                    ) }}"
                                                  method="POST"
                                                  class="delete-ticket-form"
                                                  onsubmit="return confirm(
                                                      'Apakah Anda yakin ingin menghapus tiket {{ $tiket->nomor_tiket }}?'
                                                  );">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn-action btn-delete"
                                                        title="Hapus Tiket">

                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>


                                </tr>


                            @empty


                                {{-- =================================================
                                     DATA KOSONG
                                ================================================== --}}

                                <tr id="emptyDatabaseRow">

                                    <td colspan="9"
                                        class="empty-data">

                                        <div class="empty-content">

                                            <i class="fa-solid fa-ticket"></i>

                                            <p>
                                                Belum ada data tiket.
                                            </p>

                                            <small>
                                                Tiket akan muncul setelah pengguna melakukan registrasi.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse


                            {{-- =================================================
                                 HASIL FILTER KOSONG
                            ================================================== --}}

                            <tr id="emptyFilterRow"
                                style="display: none;">

                                <td colspan="9"
                                    class="empty-data">

                                    <div class="empty-content">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                        <p id="emptyFilterText">
                                            Data tiket tidak ditemukan.
                                        </p>

                                    </div>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     FOOTER DATA
                ================================================== --}}

                <div class="table-footer">


                    {{-- =================================================
     PAGINATION
================================================== --}}

@if($tikets->hasPages())

    <div class="pagination-wrapper">

        <div class="pagination-info">

            Menampilkan
            <strong>{{ $tikets->firstItem() }}</strong>
            -
            <strong>{{ $tikets->lastItem() }}</strong>

            dari

            <strong>{{ $tikets->total() }}</strong>

            data tiket

        </div>


        <div class="pagination">

            {{-- PREVIOUS --}}

            @if($tikets->onFirstPage())

                <span class="page-btn disabled">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>

            @else

                <a
                    href="{{ $tikets->previousPageUrl() }}"
                    class="page-btn"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </a>

            @endif


            {{-- NOMOR HALAMAN --}}

            @foreach($tikets->getUrlRange(
                max(1, $tikets->currentPage() - 2),
                min($tikets->lastPage(), $tikets->currentPage() + 2)
            ) as $page => $url)

                @if($page == $tikets->currentPage())

                    <span class="page-btn active">
                        {{ $page }}
                    </span>

                @else

                    <a
                        href="{{ $url }}"
                        class="page-btn"
                    >
                        {{ $page }}
                    </a>

                @endif

            @endforeach


            {{-- NEXT --}}

            @if($tikets->hasMorePages())

                <a
                    href="{{ $tikets->nextPageUrl() }}"
                    class="page-btn"
                >
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

        </div>

    </main>


    {{-- =====================================================
         JAVASCRIPT SIDEBAR
    ====================================================== --}}

    <script src="{{ asset('js/script.js') }}"></script>


    {{-- =====================================================
         SEARCH + FILTER
    ====================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                const searchInput =
                    document.getElementById(
                        'searchTiket'
                    );


                const wilayahFilter =
                    document.getElementById(
                        'wilayahFilter'
                    );


                const statusFilter =
                    document.getElementById(
                        'statusFilter'
                    );


                const tableBody =
                    document.getElementById(
                        'tiketTableBody'
                    );


                const emptyFilterRow =
                    document.getElementById(
                        'emptyFilterRow'
                    );


                const emptyFilterText =
                    document.getElementById(
                        'emptyFilterText'
                    );


                const visibleCount =
                    document.getElementById(
                        'visibleCount'
                    );


                if (
                    !searchInput ||
                    !wilayahFilter ||
                    !statusFilter ||
                    !tableBody
                ) {

                    return;

                }


                /* =====================================================
                   FILTER TIKET
                ====================================================== */

                function filterTiket() {


                    const searchValue =
                        searchInput.value
                            .toLowerCase()
                            .trim();


                    const wilayahValue =
                        wilayahFilter.value
                            .toLowerCase()
                            .trim();


                    const statusValue =
                        statusFilter.value
                            .toLowerCase()
                            .trim();


                    const rows =
                        tableBody.querySelectorAll(
                            'tr[data-search]'
                        );


                    let visibleRows = 0;


                    rows.forEach(
                        function (row) {


                            const searchData =
                                row.dataset.search
                                    .toLowerCase();


                            const rowWilayah =
                                row.dataset.wilayah
                                    .toLowerCase();


                            const rowStatus =
                                row.dataset.status
                                    .toLowerCase();


                            /* =================================================
                               MATCH SEARCH
                            ================================================== */

                            const matchSearch =
                                searchValue === '' ||
                                searchData.includes(
                                    searchValue
                                );


                            /* =================================================
                               MATCH WILAYAH
                            ================================================== */

                            const matchWilayah =
                                wilayahValue === '' ||
                                rowWilayah === wilayahValue;


                            /* =================================================
                               MATCH STATUS
                            ================================================== */

                            const matchStatus =
                                statusValue === '' ||
                                rowStatus === statusValue;


                            /* =================================================
                               TAMPILKAN / SEMBUNYIKAN
                            ================================================== */

                            if (
                                matchSearch &&
                                matchWilayah &&
                                matchStatus
                            ) {

                                row.style.display = '';

                                visibleRows++;

                            } else {

                                row.style.display = 'none';

                            }

                        }
                    );


                    /* =====================================================
                       JUMLAH DATA
                    ====================================================== */

                    if (visibleCount) {

                        visibleCount.textContent =
                            visibleRows;

                    }


                    /* =====================================================
                       DATA TIDAK DITEMUKAN
                    ====================================================== */

                    if (
                        rows.length > 0 &&
                        visibleRows === 0
                    ) {

                        emptyFilterRow.style.display =
                            'table-row';


                        if (
                            searchValue !== ''
                        ) {

                            emptyFilterText.textContent =
                                'Data tiket yang dicari tidak ditemukan.';

                        }

                        else if (
                            wilayahValue !== ''
                        ) {

                            emptyFilterText.textContent =
                                'Tidak ada tiket pada wilayah tersebut.';

                        }

                        else if (
                            statusValue !== ''
                        ) {

                            emptyFilterText.textContent =
                                'Tidak ada tiket dengan status tersebut.';

                        }

                        else {

                            emptyFilterText.textContent =
                                'Data tiket tidak ditemukan.';

                        }

                    }

                    else {

                        emptyFilterRow.style.display =
                            'none';

                    }

                }


                /* =====================================================
                   SEARCH REAL-TIME
                ====================================================== */

                searchInput.addEventListener(
                    'input',
                    filterTiket
                );


                /* =====================================================
                   FILTER WILAYAH
                ====================================================== */

                wilayahFilter.addEventListener(
                    'change',
                    filterTiket
                );


                /* =====================================================
                   FILTER STATUS
                ====================================================== */

                statusFilter.addEventListener(
                    'change',
                    filterTiket
                );


            }
        );

    </script>


</body>

</html>