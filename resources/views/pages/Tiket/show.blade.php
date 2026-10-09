<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Tiket - SITAFAS</title>


    {{-- GOOGLE FONT --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">


    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- SIDEBAR --}}
    <link rel="stylesheet"
          href="{{ asset('css/sidebar.css') }}">


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fa;
            color: #123b59;
            min-height: 100vh;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {

            margin-left: 300px;

            width: calc(100% - 300px);

            min-height: 100vh;

            padding: 35px 45px;

            transition:
                margin-left .3s ease,
                width .3s ease;
        }


        /* =====================================================
           SIDEBAR DITUTUP
        ===================================================== */

        body.sidebar-closed .main-content {

            margin-left: 0;

            width: 100%;
        }


        /* =====================================================
           HEADER
        ===================================================== */

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

            gap: 28px;
        }


        /* =====================================================
           HAMBURGER
        ===================================================== */

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

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .mobile-menu-button:hover {

            background: #138fc1;

            color: #ffffff;

            transform: translateY(-2px);
        }


        /* =====================================================
           TITLE
        ===================================================== */

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

            font-size: 16px;

            color: #7590a5;
        }


        /* =====================================================
           USER HEADER
        ===================================================== */

        .header-user {

            display: flex;

            align-items: center;

            gap: 14px;
        }


        .header-user-icon {

            width: 56px;

            height: 56px;

            border-radius: 50%;

            background: #dff3fb;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #1188b5;

            font-size: 22px;
        }


        .header-user-info {

            display: flex;

            flex-direction: column;
        }


        .header-user-info strong {

            font-size: 16px;

            color: #123b59;
        }


        .header-user-info span {

            font-size: 14px;

            color: #8298aa;
        }


        /* =====================================================
           DETAIL CONTAINER
        ===================================================== */

        .ticket-container {

            max-width: 1100px;

            margin: 0 auto;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .ticket-card {

            background: #ffffff;

            border-radius: 22px;

            border: 1px solid #e5edf3;

            box-shadow:
                0 10px 30px rgba(26, 73, 99, .07);

            overflow: hidden;
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .ticket-card-header {

            padding: 30px 35px;

            border-bottom: 1px solid #edf1f4;

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;
        }


        .card-title {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .card-title-icon {

            width: 52px;

            height: 52px;

            border-radius: 14px;

            background: #e8f6fb;

            color: #138fc1;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;
        }


        .card-title h2 {

            font-size: 23px;

            color: #103c5c;

            font-weight: 700;
        }


        .card-title p {

            margin-top: 3px;

            color: #8298aa;

            font-size: 13px;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 10px 17px;

            border-radius: 30px;

            font-size: 13px;

            font-weight: 600;

            white-space: nowrap;
        }


        .status-dot {

            width: 9px;

            height: 9px;

            border-radius: 50%;
        }


        .status-menunggu {

            background: #eaf5fd;

            color: #1687bd;

            border: 1px solid #cde9f8;
        }


        .status-menunggu .status-dot {

            background: #1687bd;
        }


        .status-dipanggil {

            background: #fff4df;

            color: #d28a00;

            border: 1px solid #f6dba1;
        }


        .status-dipanggil .status-dot {

            background: #d28a00;
        }


        .status-dilayani {

            background: #fff4df;

            color: #d28a00;

            border: 1px solid #f6dba1;
        }


        .status-dilayani .status-dot {

            background: #d28a00;
        }


        .status-dilewati {

            background: #fff5df;

            color: #c98400;

            border: 1px solid #f4d899;
        }


        .status-dilewati .status-dot {

            background: #e09a00;
        }


        .status-selesai {

            background: #eaf9f0;

            color: #159447;

            border: 1px solid #c9ecd7;
        }


        .status-selesai .status-dot {

            background: #20b75b;
        }


        /* =====================================================
           TICKET NUMBER
        ===================================================== */

        .ticket-number-section {

            padding: 35px;

            background:
                linear-gradient(
                    135deg,
                    #f5fbfe,
                    #ffffff
                );

            border-bottom: 1px solid #edf1f4;

            text-align: center;
        }


        .ticket-number-label {

            display: block;

            font-size: 13px;

            color: #8298aa;

            margin-bottom: 8px;

            font-weight: 500;
        }


        .ticket-number {

            font-size: 58px;

            line-height: 1;

            font-weight: 700;

            letter-spacing: 3px;

            color: #0b79aa;
        }


        /* =====================================================
           INFORMATION GRID
        ===================================================== */

        .ticket-info {

            padding: 35px;

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 20px;
        }


        .info-item {

            padding: 20px;

            border: 1px solid #e5edf3;

            border-radius: 15px;

            background: #fbfdfe;
        }


        .info-label {

            display: flex;

            align-items: center;

            gap: 8px;

            color: #8197a8;

            font-size: 12px;

            margin-bottom: 8px;
        }


        .info-label i {

            color: #138fc1;

            width: 16px;

            text-align: center;
        }


        .info-value {

            color: #103c5c;

            font-size: 15px;

            font-weight: 600;

            line-height: 1.5;
        }


        .info-value.normal {

            font-weight: 500;
        }


        /* =====================================================
           KEBUTUHAN
        ===================================================== */

        .kebutuhan-section {

            margin: 0 35px 35px;

            padding: 22px;

            background: #f8fbfd;

            border-radius: 15px;

            border: 1px solid #e5edf3;
        }


        .kebutuhan-title {

            color: #8197a8;

            font-size: 12px;

            margin-bottom: 8px;

            display: flex;

            align-items: center;

            gap: 8px;
        }


        .kebutuhan-title i {

            color: #138fc1;
        }


        .kebutuhan-text {

            color: #103c5c;

            font-size: 15px;

            font-weight: 500;

            line-height: 1.6;
        }


        /* =====================================================
           FOOTER ACTION
        ===================================================== */

        .ticket-actions {

            padding: 22px 35px;

            border-top: 1px solid #edf1f4;

            display: flex;

            justify-content: flex-end;

            gap: 12px;
        }


        .btn-back {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-width: 140px;

            padding: 12px 20px;

            border-radius: 11px;

            text-decoration: none;

            background: #eef5f8;

            color: #52748a;

            font-size: 13px;

            font-weight: 600;

            transition: .2s ease;
        }


        .btn-back:hover {

            background: #dfecef;

            color: #123b59;
        }


        /* =====================================================
           DESKTOP
        ===================================================== */

        @media (min-width: 1200px) {

            .ticket-container {

                max-width: 1150px;
            }
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            .main-content {

                padding: 30px;
            }

            .ticket-container {

                max-width: 100%;
            }
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .main-content {

                margin-left: 0;

                width: 100%;

                padding: 20px 16px;
            }


            body.sidebar-closed .main-content {

                margin-left: 0;

                width: 100%;
            }


            .page-header {

                align-items: flex-start;

                margin-bottom: 22px;
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


            .ticket-card-header {

                padding: 22px;

                align-items: flex-start;

                flex-direction: column;
            }


            .card-title h2 {

                font-size: 19px;
            }


            .ticket-number-section {

                padding: 30px 20px;
            }


            .ticket-number {

                font-size: 45px;
            }


            .ticket-info {

                padding: 22px;

                grid-template-columns: 1fr;

                gap: 14px;
            }


            .kebutuhan-section {

                margin: 0 22px 22px;
            }


            .ticket-actions {

                padding: 20px 22px;

                justify-content: stretch;
            }


            .btn-back {

                width: 100%;
            }
        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 480px) {

            .page-title {

                font-size: 22px;
            }


            .page-subtitle {

                font-size: 11px;
            }


            .ticket-card {

                border-radius: 16px;
            }


            .card-title-icon {

                width: 45px;

                height: 45px;

                font-size: 18px;
            }


            .ticket-number {

                font-size: 40px;
            }


            .info-item {

                padding: 16px;
            }

        }

    </style>

</head>


<body>


{{-- =====================================================
     SIDEBAR
===================================================== --}}

@include('pages.Layouts.sidebar')

<div class="sidebar-overlay"
     id="sidebarOverlay">
</div>


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
                aria-label="Buka/Tutup Sidebar"
            >

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1 class="page-title">
                    Detail Tiket
                </h1>

                <p class="page-subtitle">
                    Informasi lengkap tiket layanan pengguna
                </p>

            </div>


        </div>


        {{-- USER --}}

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
         DETAIL TICKET
    ================================================== --}}

    <div class="ticket-container">


        <div class="ticket-card">


            {{-- =================================================
                 CARD HEADER
            ================================================== --}}

            <div class="ticket-card-header">


                <div class="card-title">


                    <div class="card-title-icon">

                        <i class="fa-solid fa-ticket"></i>

                    </div>


                    <div>

                        <h2>
                            Informasi Tiket
                        </h2>

                        <p>
                            Detail data layanan pengguna
                        </p>

                    </div>


                </div>


                {{-- =================================================
                     STATUS
                ================================================== --}}

                @php

                    $status = $tiket->status ?? '';

                @endphp


                @if($status === 'menunggu')

                    <span class="status-badge status-menunggu">

                        <span class="status-dot"></span>

                        Menunggu

                    </span>


                @elseif($status === 'dipanggil')

                    <span class="status-badge status-dipanggil">

                        <span class="status-dot"></span>

                        Dipanggil

                    </span>


                @elseif($status === 'dilayani')

                    <span class="status-badge status-dilayani">

                        <span class="status-dot"></span>

                        Dilayani

                    </span>


                @elseif($status === 'dilewati')

                    <span class="status-badge status-dilewati">

                        <span class="status-dot"></span>

                        Dilewati

                    </span>


                @elseif($status === 'selesai')

                    <span class="status-badge status-selesai">

                        <span class="status-dot"></span>

                        Selesai

                    </span>


                @else

                    <span class="status-badge status-menunggu">

                        <span class="status-dot"></span>

                        {{ ucfirst($status ?: '-') }}

                    </span>

                @endif


            </div>



            {{-- =================================================
                 NOMOR TIKET
            ================================================== --}}

            <div class="ticket-number-section">

                <span class="ticket-number-label">
                    Nomor Tiket
                </span>

                <div class="ticket-number">

                    {{ $tiket->nomor_tiket ?? '-' }}

                </div>

            </div>



            {{-- =================================================
                 INFORMASI
            ================================================== --}}

            <div class="ticket-info">


                {{-- PERGURUAN TINGGI --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-building-columns"></i>

                        Perguruan Tinggi

                    </div>

                    <div class="info-value">

                        {{ $tiket->registrasi?->perguruanTinggi?->nama_pt ?? '-' }}

                    </div>

                </div>


                {{-- KODE PT --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-barcode"></i>

                        Kode Perguruan Tinggi

                    </div>

                    <div class="info-value">

                        {{ $tiket->registrasi?->perguruanTinggi?->kode_pt ?? '-' }}

                    </div>

                </div>


                {{-- FASWIL --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-location-dot"></i>

                        Faswil

                    </div>

                    <div class="info-value">

                        {{ $tiket->registrasi?->faswil?->nama_faswil ?? '-' }}

                    </div>

                </div>


                {{-- TANGGAL DAFTAR --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-regular fa-calendar"></i>

                        Tanggal Daftar

                    </div>

                    <div class="info-value normal">

                        @if($tiket->waktu_daftar)

                            {{ \Carbon\Carbon::parse($tiket->waktu_daftar)->translatedFormat('d F Y') }}

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- WAKTU DAFTAR --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-regular fa-clock"></i>

                        Waktu Daftar

                    </div>

                    <div class="info-value normal">

                        @if($tiket->waktu_daftar)

                            {{ \Carbon\Carbon::parse($tiket->waktu_daftar)->format('H:i:s') }}

                            WIB

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- WAKTU MULAI --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-play"></i>

                        Mulai Dipanggil

                    </div>

                    <div class="info-value normal">

                        @if($tiket->waktu_mulai)

                            {{ \Carbon\Carbon::parse($tiket->waktu_mulai)->translatedFormat('d F Y') }}

                            <br>

                            {{ \Carbon\Carbon::parse($tiket->waktu_mulai)->format('H:i:s') }}

                            WIB

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- WAKTU SELESAI --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-flag-checkered"></i>

                        Selesai

                    </div>

                    <div class="info-value normal">

                        @if($tiket->waktu_selesai)

                            {{ \Carbon\Carbon::parse($tiket->waktu_selesai)->translatedFormat('d F Y') }}

                            <br>

                            {{ \Carbon\Carbon::parse($tiket->waktu_selesai)->format('H:i:s') }}

                            WIB

                        @else

                            -

                        @endif

                    </div>

                </div>


                {{-- ID REGISTRASI --}}

                <div class="info-item">

                    <div class="info-label">

                        <i class="fa-solid fa-link"></i>

                        ID Registrasi

                    </div>

                    <div class="info-value normal">

                        #{{ $tiket->id_registrasi ?? '-' }}

                    </div>

                </div>


            </div>



            {{-- =================================================
                 KEBUTUHAN
            ================================================== --}}

            <div class="kebutuhan-section">


                <div class="kebutuhan-title">

                    <i class="fa-solid fa-clipboard-list"></i>

                    Kebutuhan Layanan

                </div>


                <div class="kebutuhan-text">

                    {{ $tiket->registrasi?->kebutuhan ?? 'Tidak ada kebutuhan yang dicantumkan.' }}

                </div>


            </div>



            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="ticket-actions">


                <a
                    href="{{ url()->previous() }}"
                    class="btn-back"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>


            </div>


        </div>


    </div>


</main>



{{-- =====================================================
     SIDEBAR JAVASCRIPT
===================================================== --}}

<script src="{{ asset('js/sidebar.js') }}"></script>


</body>

</html>