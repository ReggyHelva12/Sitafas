<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kelola Registrasi - Petugas - SITAFAS
    </title>


    {{-- =========================================================
        GOOGLE FONT - POPPINS
    ========================================================== --}}

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


    {{-- =========================================================
        FONT AWESOME
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    {{-- =========================================================
        SIDEBAR CSS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/sidebar-petugas.css') }}"
    >


    {{-- =========================================================
        REGISTRASI CSS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/registrasi.css') }}"
    >


    {{-- =========================================================
        CSS KHUSUS HALAMAN PETUGAS
    ========================================================== --}}

    <style>

        /* =========================================================
           GLOBAL
        ========================================================== */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f7fafc;
            color: #29485c;
        }


        /* =========================================================
           MAIN CONTENT
        ========================================================== */

        .petugas-page {
            min-height: 100vh;
        }

        .petugas-page .page-container {
            width: 100%;
            max-width: 100%;
        }

        .petugas-page .data-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e2ebf1;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(34, 74, 96, 0.04);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .page-title-wrapper {
            min-width: 0;
        }

        .page-title {
            margin: 0;
            color: #173f59;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 700;
        }

        .page-subtitle {
            margin: 5px 0 0;
            color: #8aa0ae;
            font-size: 12px;
            font-weight: 400;
        }


        /* =========================================================
           HAMBURGER
        ========================================================== */

        .hamburger-btn {
            width: 42px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #dfe9ef;
            border-radius: 10px;

            background: #ffffff;
            color: #39718d;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .hamburger-btn:hover {
            background: #eef7fb;
            color: #078fc2;
            border-color: #cde2eb;
        }


        /* =========================================================
           USER PETUGAS
        ========================================================== */

        .header-user {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 8px 13px;

            background: #ffffff;

            border: 1px solid #e4edf2;
            border-radius: 12px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);

            flex-shrink: 0;
        }

        .header-user-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #e8f6fa;
            color: #087da3;
        }

        .header-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }

        .header-user-info strong {
            color: #284a5e;
            font-size: 13px;
            font-weight: 700;
        }

        .header-user-info span {
            margin-top: 2px;
            color: #8c9da8;
            font-size: 10px;
        }


        /* =========================================================
           ALERT
        ========================================================== */

        .alert {
            display: flex;
            align-items: center;
            gap: 10px;

            width: 100%;

            padding: 12px 15px;

            margin-bottom: 18px;

            border-radius: 10px;

            font-size: 12px;
            font-weight: 500;
        }

        .alert-success {
            background: #eaf8f0;
            color: #16834a;
            border: 1px solid #cdeedc;
        }

        .alert-danger {
            background: #fff0f0;
            color: #d44747;
            border: 1px solid #f5d2d2;
        }


        /* =========================================================
           CARD HEADER
        ========================================================== */

        .content-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 2px;
        }

        .header-text h2 {
            margin: 0;
            color: #214e69;
            font-size: 18px;
            font-weight: 700;
        }

        .header-text p {
            margin: 5px 0 0;
            color: #91a6b3;
            font-size: 11px;
        }


        /* =========================================================
           FILTER AREA
        ========================================================== */

        .filter-section {
            width: 100%;

            display: grid;

            /*
             * Search lebih besar
             * Meja lebih kecil
             */
            grid-template-columns: minmax(0, 1fr) 220px;

            align-items: end;

            column-gap: 14px;
            row-gap: 12px;

            margin-top: 24px;
            margin-bottom: 20px;

            padding: 0;
        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .search-box {
            position: relative;
            width: 100%;
            min-width: 0;
        }

        .search-box i {
            position: absolute;
            margin-left: 20px;
            left: 16px;
            top: 50%;

            transform: translateY(-50%);

            color: #8ca5b4;

            font-size: 13px;

            pointer-events: none;

            z-index: 2;
        }

        .search-box input {
            width: 100%;
            height: 46px;

            padding: 0 16px 0 43px;

            border: 1px solid #d9e5ec;
            border-radius: 10px;

            background: #ffffff;

            color: #29485c;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .search-box input::placeholder {
            color: #a2b2bd;
            font-weight: 400;
        }

        .search-box input:hover {
            border-color: #c6d8e2;
        }

        .search-box input:focus {
            border-color: #1498c1;

            box-shadow:
                0 0 0 3px rgba(20, 152, 193, 0.10);
        }


        /* =========================================================
           FILTER MEJA
        ========================================================== */

        .status-filter {
            width: 220px;
            max-width: 220px;
        }

        .status-filter select {
            width: 100%;
            height: 46px;

            padding: 0 40px 0 15px;

            border: 1px solid #d9e5ec;
            border-radius: 10px;

            background-color: #ffffff;

            color: #214e69;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;

            outline: none;

            cursor: pointer;

            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;

            /*
             * Panah dropdown
             */
            background-image:
                linear-gradient(
                    45deg,
                    transparent 50%,
                    #7895a5 50%
                ),
                linear-gradient(
                    135deg,
                    #7895a5 50%,
                    transparent 50%
                );

            background-position:
                calc(100% - 18px) 20px,
                calc(100% - 13px) 20px;

            background-size:
                5px 5px,
                5px 5px;

            background-repeat: no-repeat;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .status-filter select:hover {
            border-color: #c6d8e2;
        }

        .status-filter select:focus {
            border-color: #1498c1;

            box-shadow:
                0 0 0 3px rgba(20, 152, 193, 0.10);
        }


        /* =========================================================
           BUTTON AREA
        ========================================================== */

        .filter-actions {
            grid-column: 1 / -1;

            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 12px;

            margin-top: 1px;
        }

        .filter-btn {
            min-width: 88px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 0 16px;

            border-radius: 9px;

            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .filter-btn i {
            font-size: 11px;
        }


        /* =========================================================
           RESET
        ========================================================== */

        .btn-reset {
            background: #f1f5f8;
            border: 1px solid #e1e9ee;
            color: #587589;
        }

        .btn-reset:hover {
            background: #e6edf2;
            border-color: #d5e1e7;
            color: #365d73;

            transform: translateY(-1px);
        }


        /* =========================================================
           CARI
        ========================================================== */

        .btn-search {
            background: #1498c1;
            border: 1px solid #1498c1;
            color: #ffffff;
        }

        .btn-search:hover {
            background: #1087ad;
            border-color: #1087ad;

            box-shadow:
                0 5px 14px rgba(20, 152, 193, 0.20);

            transform: translateY(-1px);
        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
            overflow-y: hidden;

            border: 1px solid #dce7ee;
            border-radius: 12px;

            background: #ffffff;

            /*
             * Supaya scrollbar tidak terlalu dekat
             */
            scrollbar-width: thin;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 7px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f8;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #c4d5df;
            border-radius: 10px;
        }


        /* =========================================================
           TABLE
        ========================================================== */

        .data-table {
            width: 100%;

            min-width: 1250px;

            border-collapse: separate;
            border-spacing: 0;

            font-family: 'Poppins', sans-serif;
        }


        /* =========================================================
           TABLE HEADER
        ========================================================== */

        .data-table thead th {
            height: 50px;

            padding: 0 14px;

            background: #f4f8fb;

            border-bottom: 1px solid #dce7ee;

            color: #56768b;

            font-size: 10px;
            font-weight: 700;

            text-align: left;

            white-space: nowrap;

            vertical-align: middle;
        }

        .data-table thead th:first-child {
            padding-left: 20px;
        }

        .data-table thead th:last-child {
            padding-right: 20px;
        }


        /* =========================================================
           TABLE BODY
        ========================================================== */

        .data-table tbody td {
            min-height: 70px;

            padding: 13px 14px;

            border-bottom: 1px solid #edf2f5;

            color: #38586b;

            font-size: 11px;
            font-weight: 500;

            vertical-align: middle;

            white-space: nowrap;

            background: #ffffff;
        }

        .data-table tbody tr {
            transition: background 0.15s ease;
        }

        .data-table tbody tr:hover td {
            background: #f9fcfd;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody td:first-child {
            padding-left: 20px;
        }

        .data-table tbody td:last-child {
            padding-right: 20px;
        }


        /* =========================================================
           TEXT MUTED
        ========================================================== */

        .text-muted {
            color: #a5b5bf !important;
        }


        /* =========================================================
           NOMOR TIKET
        ========================================================== */

        .ticket-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 76px;

            padding: 7px 10px;

            border-radius: 8px;

            background: #eaf7fc;
            color: #0789bd;

            font-size: 12px;
            font-weight: 700;
        }


        /* =========================================================
           NAMA PERGURUAN TINGGI
        ========================================================== */

        .name-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;

            min-width: 250px;
        }

        .name-icon {
            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #eaf7fc;
            color: #078fc2;
        }

        .name-icon i {
            font-size: 14px;
        }

        .name-content {
            min-width: 180px;
            max-width: 260px;
        }

        .name-content strong {
            display: block;

            color: #124f78;

            font-size: 12px;
            line-height: 1.45;
            font-weight: 700;

            white-space: normal;
        }

        .name-content small {
            display: block;

            margin-top: 3px;

            color: #7da0b8;

            font-size: 10px;
        }


        /* =========================================================
           SESI
        ========================================================== */

        .session-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border-radius: 8px;

            background: #f1f7fb;
            color: #316b8f;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;
        }


        /* =========================================================
           TANGGAL
        ========================================================== */

        .date-wrapper span {
            display: block;

            color: #245b80;

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
        }

        .date-wrapper small {
            display: block;

            margin-top: 3px;

            color: #88a8bc;

            font-size: 9px;
        }


        /* =========================================================
           JAM
        ========================================================== */

        .time-badge {
            display: inline-flex;
            align-items: center;

            gap: 5px;

            color: #2d668b;

            font-size: 10px;
            font-weight: 500;

            white-space: nowrap;
        }

        .time-badge i {
            color: #078fc2;
            font-size: 10px;
        }


        /* =========================================================
           KEBUTUHAN
        ========================================================== */

        .kebutuhan-wrapper {
            max-width: 180px;

            color: #416d89;

            font-size: 10px;
            line-height: 1.55;

            white-space: normal;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status-badge {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            padding: 7px 11px;

            border-radius: 20px;

            white-space: nowrap;

            font-size: 10px;
            font-weight: 600;
        }

        .status-dot {
            width: 7px;
            height: 7px;

            flex-shrink: 0;

            border-radius: 50%;

            background: currentColor;
        }

        .status-registered {
            background: #e7f4ff;
            color: #1686c2;
        }

        .status-processing {
            background: #fff1d9;
            color: #d99000;
        }

        .status-completed {
            background: #e4f7ec;
            color: #159447;
        }

        .status-cancelled {
            background: #fde9e9;
            color: #dc4b4b;
        }


        /* =========================================================
           AKSI
        ========================================================== */

        .btn-view {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #d8ebf3;
            border-radius: 9px;

            background: #e8f5fb;
            color: #078fc2;

            text-decoration: none;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .btn-view:hover {
            background: #078fc2;
            border-color: #078fc2;
            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 4px 10px rgba(7, 143, 194, 0.18);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-state {
            padding: 70px 20px !important;

            text-align: center !important;

            background: #ffffff !important;
        }

        .empty-state-icon {
            width: 65px;
            height: 65px;

            margin: 0 auto 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #eef7fb;
            color: #9ab8ca;

            font-size: 25px;
        }

        .empty-state strong {
            display: block;

            color: #53758c;

            font-size: 15px;
            font-weight: 700;

            margin-bottom: 5px;
        }

        .empty-state span {
            color: #88a8bc;

            font-size: 11px;
        }


        /* =========================================================
           PAGINATION
        ========================================================== */

        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 20px 0 3px;
        }

        .pagination-info {
            color: #7895a7;

            font-size: 11px;

            white-space: nowrap;
        }

        .pagination-info strong {
            color: #245c80;
            font-weight: 700;
        }

        .pagination-nav {
            display: flex;
            align-items: center;

            gap: 5px;
        }

        .pagination-btn {
            min-width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0 9px;

            border: 1px solid #dce7ee;
            border-radius: 8px;

            background: #ffffff;
            color: #547589;

            text-decoration: none;

            font-size: 10px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .pagination-btn:hover {
            background: #eef8fb;
            border-color: #c9e2ec;
            color: #078fc2;
        }

        .pagination-btn.active {
            background: #1498c1;
            border-color: #1498c1;
            color: #ffffff;
        }

        .pagination-btn.disabled {
            opacity: 0.45;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-dots {
            min-width: 28px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: #8da3af;

            font-size: 11px;
        }


        /* =========================================================
           RESPONSIVE TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            .petugas-page .data-card {
                padding: 20px;
            }

            .filter-section {
                grid-template-columns: minmax(0, 1fr) 200px;
            }

            .status-filter {
                width: 200px;
                max-width: 200px;
            }

            .header-user {
                padding: 7px 10px;
            }

            .header-user-info strong {
                font-size: 11px;
            }

            .header-user-info span {
                font-size: 9px;
            }
        }


        /* =========================================================
           RESPONSIVE MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .page-header {
                align-items: flex-start;
            }

            .header-user {
                display: none;
            }

            .page-title {
                font-size: 20px;
            }

            .page-subtitle {
                font-size: 10px;
            }

            .petugas-page .data-card {
                padding: 16px;
                border-radius: 12px;
            }

            .content-header {
                align-items: flex-start;
            }

            .header-text h2 {
                font-size: 16px;
            }

            .filter-section {
                display: flex;
                flex-direction: column;

                gap: 10px;

                margin-top: 20px;
                margin-bottom: 18px;
            }

            .search-box {
                width: 100%;
            }

            .status-filter {
                width: 100%;
                max-width: 100%;
            }

            .filter-actions {
                width: 100%;

                display: grid;
                grid-template-columns: 1fr 1fr;

                gap: 10px;

                margin-top: 2px;
            }

            .filter-btn {
                width: 100%;
            }

            .pagination-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination-nav {
                width: 100%;
                justify-content: flex-start;

                overflow-x: auto;

                padding-bottom: 3px;
            }
        }


        /* =========================================================
           MOBILE KECIL
        ========================================================== */

        @media (max-width: 480px) {

            .page-header-left {
                gap: 9px;
            }

            .hamburger-btn {
                width: 38px;
                height: 38px;
            }

            .page-title {
                font-size: 18px;
            }

            .page-subtitle {
                display: none;
            }

            .petugas-page .data-card {
                padding: 13px;
            }

            .search-box input,
            .status-filter select {
                height: 44px;
            }

            .filter-btn {
                height: 42px;
            }

            .pagination-info {
                white-space: normal;
                line-height: 1.5;
            }
        }

        /* =========================================================
   FIX SEARCH BOX
   ========================================================= */

.petugas-page .search-box {
    position: relative !important;
    width: 100% !important;
    height: 46px !important;

    margin: 0 !important;
    padding: 0 !important;

    border: none !important;
    background: transparent !important;
    box-shadow: none !important;
}

.petugas-page .search-box i {
    position: absolute !important;

    left: 15px !important;
    top: 50% !important;

    transform: translateY(-50%) !important;

    color: #8ca5b4 !important;

    font-size: 13px !important;

    width: auto !important;
    height: auto !important;

    margin: 0 !important;
    padding: 0 !important;

    z-index: 5 !important;
}

.petugas-page .search-box input {
    width: 100% !important;
    height: 46px !important;

    margin: 0 !important;
    padding: 0 16px 0 43px !important;

    border: 1px solid #d9e5ec !important;
    border-radius: 10px !important;

    background: #ffffff !important;

    color: #29485c !important;

    font-family: 'Poppins', sans-serif !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    line-height: normal !important;

    outline: none !important;

    box-shadow: none !important;
}

.petugas-page .search-box input::placeholder {
    color: #a2b2bd !important;

    font-family: 'Poppins', sans-serif !important;
    font-size: 12px !important;
    font-weight: 400 !important;

    opacity: 1 !important;
}

.petugas-page .search-box input:focus {
    border-color: #1498c1 !important;

    box-shadow:
        0 0 0 3px rgba(20, 152, 193, 0.10) !important;
}
    </style>

</head>


<body>


    {{-- =========================================================
        SIDEBAR PETUGAS
    ========================================================== --}}

    @include('pages.Layouts.sidebar-petugas')


    {{-- =========================================================
        OVERLAY MOBILE
    ========================================================== --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <main class="main-content petugas-page">

        <div class="page-container">


            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}

            <div class="page-header">

                <div class="page-header-left">


                    {{-- HAMBURGER --}}

                    <button
                        type="button"
                        id="mobileMenuButton"
                        class="hamburger-btn"
                        aria-label="Buka atau tutup sidebar"
                    >

                        <i class="fa-solid fa-bars"></i>

                    </button>


                    {{-- TITLE --}}

                    <div class="page-title-wrapper">

                        <h1 class="page-title">
                            Kelola Registrasi
                        </h1>

                        <p class="page-subtitle">
                            Data registrasi perguruan tinggi
                        </p>

                    </div>

                </div>


                {{-- =================================================
                    USER PETUGAS
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


            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- =====================================================
                ERROR MESSAGE
            ====================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- =====================================================
                DATA CARD
            ====================================================== --}}

            <div class="data-card">


                {{-- =================================================
                    CARD HEADER
                ================================================== --}}

                <div class="content-header">

                    <div class="header-text">

                        <h2>
                            Kelola Registrasi
                        </h2>

                        <p>
                            Data registrasi pengguna
                        </p>

                    </div>

                </div>


                {{-- =================================================
                    FILTER
                ================================================== --}}

                <form
                    method="GET"
                    action="{{ route('petugas.registrasi.index') }}"
                    class="filter-section"
                >


                    {{-- =================================================
                        SEARCH
                    ================================================== --}}

                    <div class="search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama perguruan tinggi atau nomor tiket..."
                            autocomplete="off"
                        >

                    </div>


                    {{-- =================================================
                        FILTER MEJA
                    ================================================== --}}

                    <div class="status-filter">

                        <select
                            name="meja"
                            id="mejaFilter"
                            aria-label="Filter meja"
                        >

                            <option value="">
                                Semua Meja
                            </option>

                            @foreach($mejas as $meja)

                                <option
                                    value="{{ $meja }}"
                                    {{ (string) request('meja') === (string) $meja ? 'selected' : '' }}
                                >
                                    Meja {{ $meja }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        PERTAHANKAN STATUS
                    ================================================== --}}

                    @if(request('status'))

                        <input
                            type="hidden"
                            name="status"
                            value="{{ request('status') }}"
                        >

                    @endif


                    {{-- =================================================
                        BUTTON ACTION
                    ================================================== --}}

                    <div class="filter-actions">


                        {{-- RESET --}}

                        <a
                            href="{{ route('petugas.registrasi.index') }}"
                            class="filter-btn btn-reset"
                        >

                            <i class="fa-solid fa-rotate-left"></i>

                            Reset

                        </a>


                        {{-- CARI --}}

                        <button
                            type="submit"
                            class="filter-btn btn-search"
                        >

                            <i class="fa-solid fa-magnifying-glass"></i>

                            Cari

                        </button>

                    </div>

                </form>


                {{-- =====================================================
                    TABLE
                ====================================================== --}}

                <div class="table-wrapper">

                    <table class="data-table">

                        <thead>

                            <tr>

                                <th width="55">
                                    #
                                </th>

                                <th>
                                    PERGURUAN TINGGI
                                </th>

                                <th>
                                    NOMOR TIKET
                                </th>

                                <th>
                                    SESI
                                </th>

                                <th>
                                    TANGGAL JADWAL
                                </th>

                                <th>
                                    JAM JADWAL
                                </th>

                                <th>
                                    MEJA
                                </th>

                                <th>
                                    TANGGAL REGISTRASI
                                </th>

                                <th>
                                    Catatan Khusus
                                </th>

                                <th>
                                    STATUS
                                </th>

                                <th width="80">
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($registrasis as $registrasi)

                                @php

                                    $master = $registrasi->master;

                                    $tiket = $registrasi->tiket;

                                @endphp


                                <tr>


                                    {{-- =================================================
                                        NOMOR
                                    ================================================== --}}

                                    <td>

                                        {{
                                            method_exists(
                                                $registrasis,
                                                'firstItem'
                                            )
                                            ? $registrasis->firstItem() + $loop->index
                                            : $loop->iteration
                                        }}

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

                                                    {{
                                                        $master?->nama_pt
                                                        ?? '-'
                                                    }}

                                                </strong>

                                                <small>

                                                    Kode:

                                                    {{
                                                        $master?->kode_pt
                                                        ?? '-'
                                                    }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        NOMOR TIKET
                                    ================================================== --}}

                                    <td>

                                        @if($tiket?->nomor_tiket)

                                            @php

                                                $nomorTiket =
                                                    $tiket->nomor_tiket;

                                                $nomorAngka =
                                                    preg_replace(
                                                        '/^[A-Za-z]+[-\_]?/',
                                                        '',
                                                        $nomorTiket
                                                    );

                                            @endphp


                                            <span class="ticket-badge">

                                                {{ $nomorAngka }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        SESI
                                    ================================================== --}}

                                    <td>

                                        @if($master?->sesi)

                                            <span class="session-badge">

                                                {{ $master->sesi }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        TANGGAL JADWAL
                                    ================================================== --}}

                                    <td>

                                        @if($master?->tanggal)

                                            <div class="date-wrapper">

                                                <span>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $master->tanggal
                                                        )->format('d-m-Y')
                                                    }}

                                                </span>

                                                <small>
                                                    Jadwal
                                                </small>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        JAM JADWAL
                                    ================================================== --}}

                                    <td>

                                        @if(
                                            $master?->jam_mulai &&
                                            $master?->jam_selesai
                                        )

                                            <span class="time-badge">

                                                <i class="fa-regular fa-clock"></i>

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $master->jam_mulai
                                                    )->format('H:i')
                                                }}

                                                -

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $master->jam_selesai
                                                    )->format('H:i')
                                                }}

                                                WIB

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        MEJA
                                    ================================================== --}}

                                    <td>

                                        @if($master?->no_meja)

                                            <span class="session-badge">

                                                Meja {{ $master->no_meja }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        TANGGAL REGISTRASI
                                    ================================================== --}}

                                    <td>

                                        @if($registrasi->tgl_registrasi)

                                            <div class="date-wrapper">

                                                <span>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $registrasi->tgl_registrasi
                                                        )->format('d-m-Y')
                                                    }}

                                                </span>

                                                <small>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $registrasi->tgl_registrasi
                                                        )->format('H:i')
                                                    }}

                                                </small>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        KEBUTUHAN
                                    ================================================== --}}

                                    <td>

                                        <div class="kebutuhan-wrapper">

                                            {{
                                                $registrasi->kebutuhan
                                                ?: '-'
                                            }}

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        STATUS
                                    ================================================== --}}

                                    <td>


                                        @if(
                                            $registrasi->status
                                            === 'terdaftar'
                                        )

                                            <span
                                                class="
                                                    status-badge
                                                    status-registered
                                                "
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                Terdaftar

                                            </span>


                                        @elseif(
                                            $registrasi->status
                                            === 'diproses'
                                        )

                                            <span
                                                class="
                                                    status-badge
                                                    status-processing
                                                "
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                Diproses

                                            </span>


                                        @elseif(
                                            $registrasi->status
                                            === 'selesai'
                                        )

                                            <span
                                                class="
                                                    status-badge
                                                    status-completed
                                                "
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                Selesai

                                            </span>


                                        @elseif(
                                            $registrasi->status
                                            === 'dibatalkan'
                                        )

                                            <span
                                                class="
                                                    status-badge
                                                    status-cancelled
                                                "
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                Dibatalkan

                                            </span>


                                        @else

                                            <span
                                                class="status-badge"
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                {{
                                                    ucfirst(
                                                        $registrasi->status
                                                        ?? '-'
                                                    )
                                                }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        AKSI
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="{{
                                                route(
                                                    'petugas.registrasi.show',
                                                    $registrasi->id_registrasi
                                                )
                                            }}"
                                            class="btn-view"
                                            title="Lihat Detail Registrasi"
                                        >

                                            <i
                                                class="fa-solid fa-eye"
                                            ></i>

                                        </a>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="11"
                                        class="empty-state"
                                    >

                                        <div
                                            class="empty-state-icon"
                                        >

                                            <i
                                                class="fa-solid fa-clipboard-list"
                                            ></i>

                                        </div>

                                        <strong>
                                            Tidak ada registrasi
                                        </strong>

                                        <span>
                                            Belum ada data registrasi yang tersedia.
                                        </span>

                                    </td>

                                </tr>

                            @endforelse


                        </tbody>

                    </table>

                </div>


                {{-- =====================================================
                    PAGINATION
                ====================================================== --}}

                @if(
                    $registrasis instanceof
                    \Illuminate\Pagination\LengthAwarePaginator
                )

                    @if($registrasis->total() > 0)

                        <div class="pagination-wrapper">


                            {{-- INFO DATA --}}

                            <div class="pagination-info">

                                Menampilkan

                                <strong>
                                    {{ $registrasis->firstItem() }}
                                </strong>

                                sampai

                                <strong>
                                    {{ $registrasis->lastItem() }}
                                </strong>

                                dari

                                <strong>
                                    {{ $registrasis->total() }}
                                </strong>

                                registrasi

                            </div>


                            {{-- NAVIGATION --}}

                            @if($registrasis->lastPage() > 1)

                                <nav
                                    class="pagination-nav"
                                    aria-label="Pagination"
                                >


                                    {{-- PREVIOUS --}}

                                    @if($registrasis->onFirstPage())

                                        <span
                                            class="
                                                pagination-btn
                                                disabled
                                            "
                                        >

                                            <i
                                                class="fa-solid fa-chevron-left"
                                            ></i>

                                        </span>

                                    @else

                                        <a
                                            href="{{ $registrasis->previousPageUrl() }}"
                                            class="pagination-btn"
                                            aria-label="Sebelumnya"
                                        >

                                            <i
                                                class="fa-solid fa-chevron-left"
                                            ></i>

                                        </a>

                                    @endif


                                    {{-- =================================================
                                        NOMOR HALAMAN
                                    ================================================== --}}

                                    @php

                                        $current =
                                            $registrasis->currentPage();

                                        $last =
                                            $registrasis->lastPage();

                                        $pages = [];

                                        $pages[] = 1;

                                        if ($current - 1 > 1) {
                                            $pages[] =
                                                $current - 1;
                                        }

                                        if (
                                            $current > 1 &&
                                            $current < $last
                                        ) {
                                            $pages[] =
                                                $current;
                                        }

                                        if (
                                            $current + 1 < $last
                                        ) {
                                            $pages[] =
                                                $current + 1;
                                        }

                                        if ($last > 1) {
                                            $pages[] =
                                                $last;
                                        }

                                        $pages =
                                            array_values(
                                                array_unique($pages)
                                            );

                                        sort($pages);

                                        $previousPage = null;

                                    @endphp


                                    @foreach($pages as $page)


                                        @if(
                                            $previousPage !== null &&
                                            $page > $previousPage + 1
                                        )

                                            <span
                                                class="pagination-dots"
                                            >
                                                ...
                                            </span>

                                        @endif


                                        @if($page == $current)

                                            <span
                                                class="
                                                    pagination-btn
                                                    active
                                                "
                                            >
                                                {{ $page }}
                                            </span>

                                        @else

                                            <a
                                                href="{{ $registrasis->url($page) }}"
                                                class="pagination-btn"
                                            >
                                                {{ $page }}
                                            </a>

                                        @endif


                                        @php
                                            $previousPage = $page;
                                        @endphp

                                    @endforeach


                                    {{-- NEXT --}}

                                    @if($registrasis->hasMorePages())

                                        <a
                                            href="{{ $registrasis->nextPageUrl() }}"
                                            class="pagination-btn"
                                            aria-label="Berikutnya"
                                        >

                                            <i
                                                class="fa-solid fa-chevron-right"
                                            ></i>

                                        </a>

                                    @else

                                        <span
                                            class="
                                                pagination-btn
                                                disabled
                                            "
                                        >

                                            <i
                                                class="fa-solid fa-chevron-right"
                                            ></i>

                                        </span>

                                    @endif

                                </nav>

                            @endif

                        </div>

                    @endif

                @endif


            </div>

        </div>

    </main>


    {{-- =========================================================
        SIDEBAR JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const sidebar =
                    document.getElementById('sidebar');

                const mobileMenuButton =
                    document.getElementById(
                        'mobileMenuButton'
                    );

                const sidebarOverlay =
                    document.getElementById(
                        'sidebarOverlay'
                    );


                /*
                |--------------------------------------------------------------------------
                | CEK SIDEBAR
                |--------------------------------------------------------------------------
                */

                if (!sidebar) {

                    console.warn(
                        'Sidebar tidak ditemukan.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | HAMBURGER
                |--------------------------------------------------------------------------
                */

                if (mobileMenuButton) {

                    mobileMenuButton.addEventListener(
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

                                if (
                                    sidebarOverlay
                                ) {

                                    sidebarOverlay.classList.toggle(
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

                if (sidebarOverlay) {

                    sidebarOverlay.addEventListener(
                        'click',
                        function () {

                            sidebar.classList.remove(
                                'mobile-open'
                            );

                            sidebarOverlay.classList.remove(
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

                            if (
                                sidebarOverlay
                            ) {

                                sidebarOverlay.classList.remove(
                                    'show'
                                );

                            }

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | FILTER MEJA
                |--------------------------------------------------------------------------
                |
                | Ketika meja dipilih, form langsung submit.
                |
                */

                const mejaFilter =
                    document.getElementById(
                        'mejaFilter'
                    );

                if (mejaFilter) {

                    mejaFilter.addEventListener(
                        'change',
                        function () {

                            this.form.submit();

                        }
                    );

                }

            }
        );

    </script>


</body>

</html>