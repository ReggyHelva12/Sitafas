<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Antrean - SITAFAS</title>


    {{-- =====================================================
         GOOGLE FONT
    ====================================================== --}}

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- =====================================================
         SIDEBAR PETUGAS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/sidebar-petugas.css') }}">


    {{-- =====================================================
         SWEET ALERT
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>

        /* =====================================================
   PAGINATION ANTREAN
===================================================== */

.pagination-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 20px 24px;
    border-top: 1px solid #e8eef3;
    background: #ffffff;
}

.pagination-info {
    font-size: 14px;
    color: #7890a5;
}

.pagination-info strong {
    color: #164b70;
    font-weight: 700;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 6px;
}

.page-btn {
    min-width: 36px;
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 10px;

    border: 1px solid #dce8ef;
    border-radius: 8px;

    background: #ffffff;
    color: #164b70;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition: all 0.2s ease;
}

.page-btn:hover {
    background: #eaf7fc;
    border-color: #1498c5;
    color: #078bb8;
}

.page-btn.active {
    background: #119bc7;
    border-color: #119bc7;
    color: #ffffff;
}

.page-btn.disabled {
    background: #f5f7f9;
    border-color: #e5ebef;
    color: #b7c2ca;
    cursor: not-allowed;
}

        /* =====================================================
           RESET
        ====================================================== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        html,
        body {
            min-height: 100%;
        }


        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fa;
            color: #123b59;
        }


        /* =====================================================
           MAIN CONTENT
        ====================================================== */

        .main-content {

            margin-left: 300px;

            width: calc(100% - 300px);

            min-height: 100vh;

            padding: 35px 45px;

            transition:
                margin-left .3s ease,
                width .3s ease;

        }


        body.sidebar-closed .main-content {

            margin-left: 0;

            width: 100%;

        }


        /* =====================================================
           HEADER
        ====================================================== */

        .page-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;

            margin-bottom: 30px;

        }


        .header-left {

            display: flex;

            align-items: center;

            gap: 25px;

        }


        /* =====================================================
           HAMBURGER
        ====================================================== */

        .mobile-menu-button {

            width: 68px;

            height: 68px;

            border: none;

            border-radius: 16px;

            background: #ffffff;

            color: #0b5878;

            font-size: 28px;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 8px 25px rgba(0,0,0,.08);

            transition: .2s ease;

        }


        .mobile-menu-button:hover {

            background: #138fc1;

            color: #ffffff;

            transform: translateY(-2px);

        }


        /* =====================================================
           TITLE
        ====================================================== */

        .page-title-wrapper {

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .page-title {

            font-size: 36px;

            font-weight: 700;

            color: #103c5c;

            line-height: 1.2;

        }


        .page-subtitle {

            font-size: 15px;

            color: #7590a5;

        }


        /* =====================================================
           HEADER PETUGAS
        ====================================================== */

        .header-user {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 10px 16px;

            background: #ffffff;

            border-radius: 14px;

            box-shadow:
                0 6px 20px rgba(0,0,0,.05);

        }


        .header-user-icon {

            width: 45px;

            height: 45px;

            border-radius: 12px;

            background: #e5f5fb;

            color: #1089b7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 19px;

        }


        .header-user-info {

            display: flex;

            flex-direction: column;

        }


        .header-user-info strong {

            font-size: 14px;

            color: #173f5d;

        }


        .header-user-info span {

            font-size: 11px;

            color: #8196a7;

        }

        /* =====================================================
   FILTER MULTI MEJA
===================================================== */

.meja-filter {
    position: relative;
    width: 190px;
}


/* BUTTON */

.meja-filter-button {

    width: 100%;

    min-height: 44px;

    padding: 0 14px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    background: #ffffff;

    border: 1px solid #d8e3ec;

    border-radius: 10px;

    color: #17486b;

    font-family: 'Poppins', sans-serif;

    font-size: 14px;

    cursor: pointer;

    transition: 0.2s ease;

}


.meja-filter-button:hover {

    border-color: #159ac4;

}


.meja-filter-button i {

    font-size: 12px;

}


/* DROPDOWN */

.meja-dropdown {

    position: absolute;

    top: calc(100% + 6px);

    left: 0;

    width: 100%;

    max-height: 400px;

    overflow-y: auto;

    background: #ffffff;

    border: 1px solid #d8e3ec;

    border-radius: 10px;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.12);

    padding: 8px;

    z-index: 9999;

    display: none;

}


.meja-dropdown.show {

    display: block;

}


/* OPTION */

.meja-option {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 9px 10px;

    border-radius: 7px;

    cursor: pointer;

    color: #17486b;

    font-size: 13px;

}


.meja-option:hover {

    background: #eef8fc;

}


.meja-option input {

    width: 16px;

    height: 16px;

    cursor: pointer;

    accent-color: #159ac4;

}


/* DIVIDER */

.meja-divider {

    height: 1px;

    background: #e5edf2;

    margin: 6px 0;

}


/* FOOTER */

.meja-filter-footer {

    position: sticky;

    bottom: 0;

    background: #ffffff;

    display: flex;

    gap: 8px;

    padding: 10px 4px 4px;

    border-top: 1px solid #e5edf2;

}


/* BUTTON RESET */

.btn-reset-meja {

    flex: 1;

    border: 1px solid #d8e3ec;

    background: #ffffff;

    color: #607d94;

    padding: 8px;

    border-radius: 7px;

    cursor: pointer;

}


/* BUTTON TERAPKAN */

.btn-apply-meja {

    flex: 1;

    border: none;

    background: #159ac4;

    color: #ffffff;

    padding: 8px;

    border-radius: 7px;

    cursor: pointer;

}


.btn-apply-meja:hover {

    background: #0d8bad;

}


        /* =====================================================
           CONTAINER
        ====================================================== */

        .petugas-antrean-container {

            width: 100%;

        }


        /* =====================================================
           CARD DAFTAR ANTREAN
        ====================================================== */

        .antrean-list-card {

            background: #ffffff;

            border: 1px solid #e6edf2;

            border-radius: 18px;

            box-shadow:
                0 8px 25px rgba(26,73,99,.06);

            overflow: hidden;

        }


        /* =====================================================
           CARD HEADER
        ====================================================== */

        .section-title {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 25px 30px;

            border-bottom: 1px solid #edf1f4;

        }


        .section-title h2 {

            font-size: 21px;

            font-weight: 700;

            color: #123b59;

            margin-bottom: 4px;

        }


        .section-title p {

            font-size: 14px;

            color: #8297a8;

        }


        /* =====================================================
           LIVE
        ====================================================== */

        .live-badge {

            display: flex;

            align-items: center;

            gap: 7px;

            padding: 7px 13px;

            border-radius: 20px;

            background: #e7f8ef;

            color: #22965c;

            font-size: 12px;

            font-weight: 700;

        }


        .live-badge span {

            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: #2fbd72;

            animation: pulse 1.5s infinite;

        }


        @keyframes pulse {

            0% {
                opacity: 1;
            }

            50% {
                opacity: .35;
            }

            100% {
                opacity: 1;
            }

        }


        /* =====================================================
           FILTER
        ====================================================== */

        .filter-area {

            display: grid;

            grid-template-columns:
                190px
                1fr
                95px;

            gap: 12px;

            padding: 15px;

            border-bottom: 1px solid #edf1f4;

            background: #ffffff;

        }


        .filter-area select,
        .filter-area input {

            width: 100%;

            height: 50px;

            border: 1px solid #d9e5ec;

            border-radius: 10px;

            padding: 0 15px;

            background: #ffffff;

            color: #173f5d;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            outline: none;

        }


        .filter-area select:focus,
        .filter-area input:focus {

            border-color: #1397c8;

            box-shadow:
                0 0 0 3px rgba(19,151,200,.08);

        }


        .btn-search {

            height: 50px;

            border: none;

            border-radius: 10px;

            background: #1397c8;

            color: #ffffff;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            transition: .2s ease;

        }


        .btn-search:hover {

            background: #087eaa;

        }


        /* =====================================================
           TABLE WRAPPER
        ====================================================== */

        .antrean-table-wrapper {

            width: 100%;

            overflow-x: auto;

        }


        /* =====================================================
           TABLE
        ====================================================== */

        .antrean-table {

            width: 100%;

            border-collapse: collapse;

            min-width: 1050px;

        }


        .antrean-table th {

            padding: 17px 20px;

            background: #f7fafc;

            color: #6f8799;

            font-size: 11px;

            font-weight: 700;

            text-align: left;

            white-space: nowrap;

        }


        .antrean-table td {

            padding: 16px 20px;

            border-top: 1px solid #edf1f4;

            color: #385d75;

            font-size: 13px;

            vertical-align: middle;

        }


        .antrean-table tbody tr {

            transition:
                background .2s ease;

        }


        .antrean-table tbody tr:hover {

            background: #f9fcfd;

        }


        /* =====================================================
           ROW SEDANG DILAYANI
        ====================================================== */

        .antrean-table tbody tr.row-serving {

            background: #f8fcfe;

        }


        .antrean-table tbody tr.row-serving:hover {

            background: #f2fafc;

        }


        /* =====================================================
           NOMOR TIKET
        ====================================================== */

        .ticket-number {

            font-size: 16px;

            font-weight: 800;

            color: #0787b5;

        }


        /* =====================================================
           PT
        ====================================================== */

        .pt-name {

            display: flex;

            align-items: flex-start;

            gap: 9px;

            max-width: 320px;

        }


        .pt-name i {

            color: #148db8;

            margin-top: 3px;

            flex-shrink: 0;

        }


        .pt-name span {

            font-weight: 500;

            line-height: 1.45;

        }


        /* =====================================================
           MEJA
        ====================================================== */

        .desk-number {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 10px;

            border-radius: 8px;

            background: #edf7fb;

            color: #087fae;

            font-size: 12px;

            font-weight: 700;

        }


        /* =====================================================
           STATUS MENUNGGU
        ====================================================== */

        .status-waiting {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 20px;

            background: #fff6df;

            color: #b67b00;

            font-size: 12px;

            font-weight: 600;

            white-space: nowrap;

        }


        .status-waiting .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #e1a000;

        }


        /* =====================================================
           STATUS DILAYANI
        ====================================================== */

        .status-serving {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 20px;

            background: #e7f8ef;

            color: #22965c;

            font-size: 12px;

            font-weight: 700;

            white-space: nowrap;

        }


        .status-serving .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #2fbd72;

            animation: pulse 1.5s infinite;

        }


        /* =====================================================
           STATUS HABIS
        ====================================================== */

        .status-expired {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 20px;

            background: #fdecec;

            color: #c94747;

            font-size: 12px;

            font-weight: 700;

        }


        .status-expired .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #c94747;

        }


        /* =====================================================
           WAKTU LAYANAN
        ====================================================== */

        .service-time-cell {

            min-width: 170px;

        }


        .waiting-text {

            color: #879aa8;

            font-size: 12px;

        }


        /* =====================================================
           TIMER
        ====================================================== */

        .row-timer {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            min-width: 145px;

            padding: 9px 12px;

            border-radius: 10px;

            background: #eaf7fc;

            color: #108abd;

            font-size: 17px;

            font-weight: 800;

            font-variant-numeric: tabular-nums;

            letter-spacing: .5px;

        }


        .row-timer i {

            font-size: 13px;

        }


        .row-timer.paused {

            background: #fff4dd;

            color: #b27a00;

        }


        .row-timer.warning {

            background: #fff0d7;

            color: #d27c00;

        }


        .row-timer.expired {

            background: #fdecec;

            color: #c94747;

        }


        .timer-info {

            display: block;

            margin-top: 4px;

            font-size: 10px;

            color: #8298aa;

        }


        /* =====================================================
           ACTION
        ====================================================== */

        .action-cell {

            min-width: 300px;

        }


        .waiting-action {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .btn-call-small {

            border: none;

            background: #eaf7fc;

            color: #0784b1;

            padding: 9px 14px;

            border-radius: 8px;

            font-family: 'Poppins', sans-serif;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            transition: .2s ease;

        }


        .btn-call-small:hover {

            background: #d5eef7;

            transform: translateY(-1px);

        }


        /* =====================================================
           ACTIVE ACTION
        ====================================================== */

        .active-actions {

            display: flex;

            align-items: center;

            flex-wrap: wrap;

            gap: 6px;

        }


        .active-actions form {

            margin: 0;

        }


        .btn-action {

            height: 36px;

            padding: 0 10px;

            border: none;

            border-radius: 8px;

            font-family: 'Poppins', sans-serif;

            font-size: 10px;

            font-weight: 700;

            cursor: pointer;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            white-space: nowrap;

            transition: .2s ease;

        }


        .btn-action:hover {

            transform: translateY(-1px);

        }


        .btn-action:disabled {

            opacity: .5;

            cursor: not-allowed;

            transform: none;

        }


        /* PAUSE */

        .btn-pause {

            background: #fff4dd;

            color: #b27a00;

        }


        .btn-pause:hover {

            background: #ffe8b7;

        }


        /* RESUME */

        .btn-resume {

            background: #e7f7ed;

            color: #218b55;

        }


        .btn-resume:hover {

            background: #d5f0df;

        }


        /* RESET */

        .btn-reset {

            background: #f0eafb;

            color: #7050a8;

        }


        .btn-reset:hover {

            background: #e4daf5;

        }


        /* PANGGIL ULANG */

        .btn-ulangi {

            background: #e7f5fb;

            color: #087fae;

        }


        .btn-ulangi:hover {

            background: #d3edf7;

        }


        /* LEWATI */

        .btn-lewati {

            background: #fff4dd;

            color: #b27a00;

        }


        .btn-lewati:hover {

            background: #ffe8b7;

        }


        /* SELESAI */

        .btn-selesai {

            background: #e8f7ed;

            color: #218b55;

        }


        .btn-selesai:hover {

            background: #d5f0df;

        }


        /* =====================================================
           EMPTY
        ====================================================== */

        .empty-table {

            padding: 70px 20px !important;

            text-align: center;

            color: #879aa8 !important;

        }


        .empty-table i {

            display: block;

            font-size: 35px;

            color: #a9bdc9;

            margin-bottom: 12px;

        }


        .empty-table strong {

            display: block;

            color: #60798a;

            margin-bottom: 5px;

        }


        .empty-table span {

            font-size: 12px;

        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1100px) {

            .main-content {

                padding: 30px;

            }


            .filter-area {

                grid-template-columns:
                    170px
                    1fr
                    90px;

            }

        }


        @media (max-width: 768px) {

            .main-content {

                margin-left: 0;

                width: 100%;

                padding: 20px 15px;

            }


            body.sidebar-closed .main-content {

                margin-left: 0;

                width: 100%;

            }


            .page-header {

                align-items: flex-start;

            }


            .header-left {

                gap: 14px;

            }


            .mobile-menu-button {

                width: 52px;

                height: 52px;

                font-size: 22px;

                flex-shrink: 0;

            }


            .page-title {

                font-size: 25px;

            }


            .page-subtitle {

                font-size: 12px;

            }


            .header-user {

                display: none;

            }


            .section-title {

                padding: 20px;

            }


            .section-title h2 {

                font-size: 18px;

            }


            .section-title p {

                font-size: 11px;

            }


            .filter-area {

                grid-template-columns: 1fr;

            }


            .filter-area select,
            .filter-area input,
            .btn-search {

                width: 100%;

            }

        }

        /* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 768px) {

    .pagination-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }

    .pagination {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }

}


    </style>

</head>


<body>


{{-- =====================================================
     SIDEBAR PETUGAS
===================================================== --}}

@include('pages.Layouts.sidebar-petugas')



{{-- =====================================================
     MAIN CONTENT
===================================================== --}}

<main class="main-content">


    {{-- =================================================
         HEADER
    ================================================== --}}

    <div class="page-header">


        <div class="header-left">


            {{-- HAMBURGER --}}

            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Buka menu">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1 class="page-title">
                    Antrean
                </h1>

                <p class="page-subtitle">
                    Kelola dan layani antrean Faswil
                </p>

            </div>

        </div>


        {{-- =================================================
             PETUGAS
        ================================================== --}}

        <div class="header-user">

            <div class="header-user-icon">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="header-user-info">

                <strong>
                    Petugas Meja
                </strong>

                <span>
                    Pendamping
                </span>

            </div>

        </div>


    </div>



    {{-- =================================================
         ALERT SUCCESS
    ================================================== --}}

    @if(session('success'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil',

                        text: @json(session('success')),

                        confirmButtonColor: '#168fc1',

                        timer: 2200,

                        timerProgressBar: true

                    });

                }
            );

        </script>

    @endif



    {{-- =================================================
         ALERT ERROR
    ================================================== --}}

    @if(session('error'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    Swal.fire({

                        icon: 'warning',

                        title: 'Perhatian',

                        text: @json(session('error')),

                        confirmButtonColor: '#d89a00'

                    });

                }
            );

        </script>

    @endif



    {{-- =================================================
         CONTENT
    ================================================== --}}

    <div class="petugas-antrean-container">


        <section class="antrean-list-card">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="section-title">

                <div>

                    <h2>
                        Daftar Antrean
                    </h2>

                    <p>
                        Setiap petugas dapat memanggil antrean secara bersamaan
                    </p>

                </div>


                <span class="live-badge">

                    <span></span>

                    LIVE

                </span>

            </div>



            {{-- =================================================
                 FILTER
            ================================================== --}}

            <form
                method="GET"
                action="{{ route('petugas.antrean.index') }}"
                class="filter-area"
                id="filterAntreanForm"
            >


                {{-- MEJA --}}

                <div class="meja-filter">

    <button type="button" class="meja-filter-button" id="mejaFilterButton">
        <span id="mejaFilterText">Semua Meja</span>
        <i class="fa-solid fa-chevron-down"></i>
    </button>

    <div class="meja-dropdown" id="mejaDropdown">

        <label class="meja-option select-all">
            <input
                type="checkbox"
                id="checkAllMeja"
            >
            <span>Semua Meja</span>
        </label>

        <div class="meja-divider"></div>

        @php
    $selectedMeja = request()->input('meja', []);
    if (!is_array($selectedMeja)) {
        $selectedMeja = [$selectedMeja];
    }
    $selectedMeja = array_map('strval', $selectedMeja);
@endphp

        @foreach($daftarMeja as $meja)

            <label class="meja-option">

                <input
                    type="checkbox"
                    name="meja[]"
                    value="{{ $meja }}"
                    class="meja-checkbox"
                    {{ in_array((string) $meja, $selectedMeja, true) ? 'checked' : '' }}
                >

                <span>Meja {{ $meja }}</span>

            </label>

        @endforeach

        <div class="meja-filter-footer">

            <button
                type="button"
                id="resetMeja"
                class="btn-reset-meja"
            >
                Reset
            </button>

            <button
                type="button"
                id="applyMeja"
                class="btn-apply-meja"
            >
                Terapkan
            </button>

        </div>

    </div>

</div>



                {{-- SEARCH --}}

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nomor tiket atau nama perguruan tinggi..."
                >



                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="btn-search"
                >

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Cari

                </button>


            </form>



            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div class="antrean-table-wrapper">


                <table class="antrean-table">


                    <thead>

                        <tr>

                            <th>
                                NO
                            </th>

                            <th>
                                NOMOR TIKET
                            </th>

                            <th>
                                PERGURUAN TINGGI
                            </th>

                            <th>
                                MEJA
                            </th>

                            <th>
                                STATUS
                            </th>

                            <th>
                                WAKTU LAYANAN
                            </th>

                            <th>
                                AKSI
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | GABUNGKAN TIKET DILAYANI + MENUNGGU
                        |--------------------------------------------------------------------------
                        |
                        | Dengan cara ini:
                        |
                        | 001 = Dilayani
                        | 002 = Menunggu
                        | 003 = Menunggu
                        |
                        | Semuanya berada dalam tabel yang sama.
                        |
                        */

                        $semuaAntrean = collect();

                        if ($antreanSaatIni) {

                            $semuaAntrean =
                                $semuaAntrean->concat(
                                    $antreanSaatIni
                                );

                        }

                        if ($antrean) {

                            $semuaAntrean =
                                $semuaAntrean->concat(
                                    $antrean
                                );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | URUTKAN
                        |--------------------------------------------------------------------------
                        |
                        | Tiket yang sedang dilayani tampil lebih dahulu,
                        | kemudian tiket menunggu.
                        |
                        */

                        $semuaAntrean = $semuaAntrean
                            ->sortBy(function ($item) {

                                if ($item->status === 'dilayani') {
                                    return 0;
                                }

                                return 1;

                            })
                            ->values();

                    @endphp



                    @forelse($semuaAntrean as $item)


                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | CEK STATUS
                            |--------------------------------------------------------------------------
                            */

                            $sedangDilayani =
                                $item->status === 'dilayani';


                            /*
                            |--------------------------------------------------------------------------
                            | DATA MASTER
                            |--------------------------------------------------------------------------
                            */

                            $master =
                                optional(
                                    optional(
                                        $item->registrasi
                                    )->master
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | TIMER
                            |--------------------------------------------------------------------------
                            */

                            $statusTimer =
                                $item->status_timer
                                ?? 'belum_mulai';


                            $timerSisa =
                                (int) (
                                    $item->timer_sisa
                                    ?? 0
                                );


                            $durasiTimer =
                                (int) (
                                    $item->durasi_timer
                                    ?? 15
                                );


                            $timerBerakhir =
                                $item->timer_berakhir
                                ? $item->timer_berakhir
                                    ->toIso8601String()
                                : '';


                        @endphp



                        {{-- =================================================
                             ROW TIKET
                        ================================================== --}}

                        <tr
                            class="{{ $sedangDilayani ? 'row-serving' : '' }}"
                            data-ticket-id="{{ $item->id_tiket }}"
                        >


                            {{-- =================================================
                                 NO
                            ================================================== --}}

                            <td>

                                {{ $antrean->firstItem() + $loop->index }}

                            </td>



                            {{-- =================================================
                                 NOMOR TIKET
                            ================================================== --}}

                            <td>

                                <strong class="ticket-number">

                                    {{ preg_replace('/\D/', '', $item->nomor_tiket) }}

                                </strong>

                            </td>



                            {{-- =================================================
                                 PERGURUAN TINGGI
                            ================================================== --}}

                            <td>

                                <div class="pt-name">

                                    <i class="fa-solid fa-building-columns"></i>

                                    <span>

                                        {{ optional(
                                            optional(
                                                $item->registrasi
                                            )->master
                                        )->nama_pt ?? '-' }}

                                    </span>

                                </div>

                            </td>



                            {{-- =================================================
                                 MEJA
                            ================================================== --}}

                            <td>

                                <span class="desk-number">

                                    <i class="fa-solid fa-table"></i>

                                    {{ $master->no_meja ?? '-' }}

                                </span>

                            </td>



                            {{-- =================================================
                                 STATUS
                            ================================================== --}}

                            <td>


                                @if($sedangDilayani)

                                    @if($statusTimer === 'habis')

                                        <span class="status-expired">

                                            <span class="status-dot"></span>

                                            Waktu Habis

                                        </span>

                                    @else

                                        <span class="status-serving">

                                            <span class="status-dot"></span>

                                            Dilayani

                                        </span>

                                    @endif


                                @else

                                    <span class="status-waiting">

                                        <span class="status-dot"></span>

                                        Menunggu

                                    </span>

                                @endif


                            </td>



                            {{-- =================================================
                                 WAKTU LAYANAN
                            ================================================== --}}

                            <td class="service-time-cell">


                                @if($sedangDilayani)


                                    <div
                                        class="row-timer
                                        {{ $statusTimer === 'pause' ? 'paused' : '' }}
                                        {{ $statusTimer === 'habis' ? 'expired' : '' }}"
                                        id="timer-{{ $item->id_tiket }}"

                                        data-ticket-id="{{ $item->id_tiket }}"

                                        data-status="{{ $statusTimer }}"

                                        data-end="{{ $timerBerakhir }}"

                                        data-remaining="{{ $timerSisa }}"

                                        data-duration="{{ $durasiTimer }}"
                                    >

                                        <i class="fa-solid fa-clock"></i>

                                        <span>
                                            00:00
                                        </span>

                                    </div>


                                    <span class="timer-info"
                                          id="timer-info-{{ $item->id_tiket }}">

                                        @if($statusTimer === 'pause')

                                            Timer dijeda

                                        @elseif($statusTimer === 'habis')

                                            Waktu layanan habis

                                        @else

                                            Durasi:
                                            {{ $durasiTimer }}
                                            menit

                                        @endif

                                    </span>


                                @else


                                    <span class="waiting-text">

                                        Belum dipanggil

                                    </span>


                                @endif


                            </td>



                            {{-- =================================================
                                 AKSI
                            ================================================== --}}

                            <td class="action-cell">


                                {{-- =================================================
                                     JIKA MENUNGGU
                                ================================================== --}}

                                @if(!$sedangDilayani)


                                    <div class="waiting-action">


                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'petugas.antrean.panggil',
                                                $item->id_tiket
                                            ) }}"
                                        >

                                            @csrf


                                            <button
                                                type="submit"
                                                class="btn-call-small"
                                            >

                                                <i class="fa-solid fa-volume-high"></i>

                                                Panggil

                                            </button>

                                        </form>


                                    </div>


                                @else


                                    {{-- =================================================
                                         JIKA SEDANG DILAYANI
                                    ================================================== --}}

                                    <div class="active-actions">


                                        {{-- =================================================
                                             PAUSE / RESUME
                                        ================================================== --}}

                                        @if($statusTimer === 'pause')


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'petugas.antrean.resume-timer',
                                                    $item->id_tiket
                                                ) }}"
                                            >

                                                @csrf


                                                <button
                                                    type="submit"
                                                    class="btn-action btn-resume"
                                                >

                                                    <i class="fa-solid fa-play"></i>

                                                    Lanjutkan

                                                </button>

                                            </form>


                                        @elseif($statusTimer === 'berjalan')


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'petugas.antrean.pause-timer',
                                                    $item->id_tiket
                                                ) }}"
                                            >

                                                @csrf


                                                <button
                                                    type="submit"
                                                    class="btn-action btn-pause"
                                                >

                                                    <i class="fa-solid fa-pause"></i>

                                                    Pause

                                                </button>

                                            </form>


                                        @else


                                            <button
                                                type="button"
                                                class="btn-action btn-pause"
                                                disabled
                                            >

                                                <i class="fa-solid fa-pause"></i>

                                                Pause

                                            </button>


                                        @endif



                                        {{-- =================================================
                                             RESET
                                        ================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'petugas.antrean.reset-timer',
                                                $item->id_tiket
                                            ) }}"
                                            class="form-reset-timer"
                                        >

                                            @csrf


                                            <button
                                                type="submit"
                                                class="btn-action btn-reset"
                                            >

                                                <i class="fa-solid fa-rotate-right"></i>

                                                Reset

                                            </button>

                                        </form>



                                        {{-- =================================================
                                             PANGGIL ULANG
                                        ================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'petugas.antrean.panggil-ulang',
                                                $item->id_tiket
                                            ) }}"
                                        >

                                            @csrf

                                        </form>



                                        {{-- =================================================
                                             SELESAI
                                        ================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'petugas.antrean.selesai',
                                                $item->id_tiket
                                            ) }}"
                                            class="form-selesai"
                                        >

                                            @csrf


                                            <button
                                                type="submit"
                                                class="btn-action btn-selesai"
                                            >

                                                <i class="fa-solid fa-check"></i>

                                                Selesai

                                            </button>

                                        </form>


                                    </div>


                                @endif


                            </td>


                        </tr>


                    @empty


                        {{-- =================================================
                             TIDAK ADA ANTREAN
                        ================================================== --}}

                        <tr>

                            <td
                                colspan="7"
                                class="empty-table"
                            >

                                <i class="fa-solid fa-ticket"></i>


                                <strong>
                                    Tidak ada antrean
                                </strong>


                                <span>
                                    Saat ini tidak ada peserta yang menunggu.
                                </span>

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>


                {{-- =================================================
     PAGINATION DAFTAR ANTREAN
================================================== --}}

@if($antrean->hasPages())

    <div class="pagination-wrapper">

        {{-- INFORMASI DATA --}}
        <div class="pagination-info">

            Menampilkan

            <strong>
                {{ $antrean->firstItem() }}
            </strong>

            -

            <strong>
                {{ $antrean->lastItem() }}
            </strong>

            dari

            <strong>
                {{ $antrean->total() }}
            </strong>

            antrean

        </div>


        {{-- NAVIGASI --}}
        <div class="pagination">

            {{-- PREVIOUS --}}
            @if($antrean->onFirstPage())

                <span class="page-btn disabled">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>

            @else

                <a
                    href="{{ $antrean->previousPageUrl() }}"
                    class="page-btn"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </a>

            @endif


            {{-- NOMOR HALAMAN --}}
            @foreach($antrean->getUrlRange(
                max(1, $antrean->currentPage() - 2),
                min($antrean->lastPage(), $antrean->currentPage() + 2)
            ) as $page => $url)

                @if($page == $antrean->currentPage())

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
            @if($antrean->hasMorePages())

                <a
                    href="{{ $antrean->nextPageUrl() }}"
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


        </section>


    </div>


</main>



{{-- =====================================================
     SIDEBAR JAVASCRIPT
===================================================== --}}

<script src="{{ asset('js/sidebar-petugas.js') }}"></script>



{{-- =====================================================
     JAVASCRIPT ANTREAN
===================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =====================================================
           TIMER PER TIKET
        ===================================================== */

        const timerElements =
            document.querySelectorAll(
                '.row-timer'
            );


        const intervals = {};


        /* =====================================================
           FORMAT TIMER
        ===================================================== */

        function formatTimer(seconds)
        {

            seconds =
                Math.max(
                    0,
                    Math.floor(seconds)
                );


            const minutes =
                Math.floor(
                    seconds / 60
                );


            const secs =
                seconds % 60;


            return String(minutes)
                .padStart(2, '0')
                +
                ':'
                +
                String(secs)
                    .padStart(2, '0');

        }



        /* =====================================================
           STOP TIMER
        ===================================================== */

        function stopTimer(ticketId)
        {

            if (
                intervals[ticketId]
            ) {

                clearInterval(
                    intervals[ticketId]
                );

                delete intervals[ticketId];

            }

        }



        /* =====================================================
           UPDATE TIMER
        ===================================================== */

        function startTimer(
            element
        )
        {

            const ticketId =
                element.dataset.ticketId;


            const status =
                element.dataset.status
                || 'belum_mulai';


            const endTime =
                element.dataset.end
                || '';


            const remaining =
                parseInt(
                    element.dataset.remaining
                    || '0',
                    10
                );


            const display =
                element.querySelector(
                    'span'
                );


            const info =
                document.getElementById(
                    'timer-info-' + ticketId
                );


            stopTimer(ticketId);



            /* =================================================
               PAUSE
            ================================================= */

            if (
                status === 'pause'
            ) {

                display.textContent =
                    formatTimer(
                        remaining
                    );


                element.classList.remove(
                    'warning',
                    'expired'
                );


                element.classList.add(
                    'paused'
                );


                if (info) {

                    info.textContent =
                        'Timer dijeda';

                }


                return;

            }



            /* =================================================
               HABIS
            ================================================= */

            if (
                status === 'habis'
            ) {

                display.textContent =
                    '00:00';


                element.classList.remove(
                    'paused',
                    'warning'
                );


                element.classList.add(
                    'expired'
                );


                if (info) {

                    info.textContent =
                        'Waktu layanan habis';

                }


                return;

            }



            /* =================================================
               BELUM DIMULAI
            ================================================= */

            if (
                status !== 'berjalan'
                ||
                !endTime
            ) {

                display.textContent =
                    '00:00';


                if (info) {

                    info.textContent =
                        'Belum dimulai';

                }


                return;

            }



            /* =================================================
               TIMER BERJALAN
            ================================================= */

            function updateTimer()
            {

                const now =
                    Date.now();


                const end =
                    new Date(
                        endTime
                    ).getTime();


                const seconds =
                    Math.max(
                        0,
                        Math.floor(
                            (
                                end - now
                            ) / 1000
                        )
                    );


                display.textContent =
                    formatTimer(
                        seconds
                    );


                element.classList.remove(
                    'paused',
                    'expired'
                );



                /* =================================================
                   WARNING < 5 MENIT
                ================================================= */

                if (
                    seconds <= 300
                    &&
                    seconds > 0
                ) {

                    element.classList.add(
                        'warning'
                    );

                }
                else {

                    element.classList.remove(
                        'warning'
                    );

                }



                /* =================================================
                   TIMER HABIS
                ================================================= */

                if (
                    seconds <= 0
                ) {

                    display.textContent =
                        '00:00';


                    element.classList.remove(
                        'warning',
                        'paused'
                    );


                    element.classList.add(
                        'expired'
                    );


                    if (info) {

                        info.textContent =
                            'Waktu layanan habis';

                    }


                    stopTimer(
                        ticketId
                    );


                    return;

                }



                if (info) {

                    info.textContent =
                        'Sedang berjalan';

                }

            }


            updateTimer();


            intervals[ticketId] =
                setInterval(
                    updateTimer,
                    1000
                );

        }



        /* =====================================================
           JALANKAN SEMUA TIMER AKTIF
        ===================================================== */

        timerElements.forEach(
            function (element) {

                startTimer(
                    element
                );

            }
        );



        /* =====================================================
           KONFIRMASI RESET
        ===================================================== */

        document
            .querySelectorAll(
                '.form-reset-timer'
            )
            .forEach(
                function (form) {


                    form.addEventListener(
                        'submit',
                        function (event) {


                            event.preventDefault();


                            Swal.fire({

                                title:
                                    'Reset timer?',

                                text:
                                    'Timer akan kembali ke durasi awal yang diatur admin.',

                                icon:
                                    'question',

                                showCancelButton:
                                    true,

                                confirmButtonColor:
                                    '#7050a8',

                                cancelButtonColor:
                                    '#6c757d',

                                confirmButtonText:
                                    'Ya, Reset',

                                cancelButtonText:
                                    'Batal'

                            }).then(
                                function (result) {


                                    if (
                                        result.isConfirmed
                                    ) {

                                        form.submit();

                                    }

                                }
                            );

                        }
                    );

                }
            );



        /* =====================================================
           KONFIRMASI LEWATI
        ===================================================== */

        document
            .querySelectorAll(
                '.form-lewati'
            )
            .forEach(
                function (form) {


                    form.addEventListener(
                        'submit',
                        function (event) {


                            event.preventDefault();


                            Swal.fire({

                                title:
                                    'Lewati antrean?',

                                text:
                                    'Antrean ini akan ditandai sebagai dilewati.',

                                icon:
                                    'warning',

                                showCancelButton:
                                    true,

                                confirmButtonColor:
                                    '#d89a00',

                                cancelButtonColor:
                                    '#6c757d',

                                confirmButtonText:
                                    'Ya, Lewati',

                                cancelButtonText:
                                    'Batal'

                            }).then(
                                function (result) {


                                    if (
                                        result.isConfirmed
                                    ) {

                                        form.submit();

                                    }

                                }
                            );

                        }
                    );

                }
            );



        /* =====================================================
           KONFIRMASI SELESAI
        ===================================================== */

        document
            .querySelectorAll(
                '.form-selesai'
            )
            .forEach(
                function (form) {


                    form.addEventListener(
                        'submit',
                        function (event) {


                            event.preventDefault();


                            Swal.fire({

                                title:
                                    'Selesaikan antrean?',

                                text:
                                    'Antrean ini akan ditandai sebagai selesai.',

                                icon:
                                    'question',

                                showCancelButton:
                                    true,

                                confirmButtonColor:
                                    '#218b55',

                                cancelButtonColor:
                                    '#6c757d',

                                confirmButtonText:
                                    'Ya, Selesai',

                                cancelButtonText:
                                    'Batal'

                            }).then(
                                function (result) {


                                    if (
                                        result.isConfirmed
                                    ) {

                                        form.submit();

                                    }

                                }
                            );

                        }
                    );

                }
            );


    }
);

</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.getElementById('filterAntreanForm');
    const filterButton = document.getElementById('mejaFilterButton');
    const dropdown = document.getElementById('mejaDropdown');
    const filterText = document.getElementById('mejaFilterText');
    const checkAll = document.getElementById('checkAllMeja');
    const checkboxes = document.querySelectorAll('.meja-checkbox');
    const resetButton = document.getElementById('resetMeja');
    const applyButton = document.getElementById('applyMeja');

    if (filterButton && dropdown) {
        filterButton.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });
        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
        document.addEventListener('click', function () {
            dropdown.classList.remove('show');
        });
    }

    function updateText() {
        const selected = [];
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) selected.push(checkbox.value);
        });
        if (selected.length === 0) {
            filterText.textContent = 'Semua Meja';
            if (checkAll) checkAll.checked = true;
            return;
        }
        if (checkAll) checkAll.checked = false;
        if (selected.length === 1) {
            filterText.textContent = 'Meja ' + selected[0];
            return;
        }
        filterText.textContent = selected.length + ' meja dipilih';
    }

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            if (this.checked) {
                checkboxes.forEach(function (checkbox) { checkbox.checked = false; });
            }
            updateText();
        });
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked && checkAll) checkAll.checked = false;
            updateText();
        });
    });

    if (resetButton) {
        resetButton.addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = "{{ route('petugas.antrean.index') }}";
        });
    }

    if (applyButton && filterForm) {
        applyButton.addEventListener('click', function (e) {
            e.preventDefault();
            filterForm.submit();
        });
    }

    updateText();
});

</script>

</script>



</body>

</html>