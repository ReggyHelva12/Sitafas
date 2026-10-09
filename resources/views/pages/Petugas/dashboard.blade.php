<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas - SITAFAS</title>


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
         SIDEBAR CSS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/sidebar-petugas.css') }}">


    {{-- =====================================================
         CSS DASHBOARD PETUGAS
    ====================================================== --}}

    <style>

        /* =====================================================
           RESET
        ====================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            font-family: 'Poppins', sans-serif;

            background: #f5f8fa;

            color: #243b4a;

            min-height: 100vh;

            overflow-x: hidden;

            transition:
                margin-left 0.3s ease;

        }


        /* =====================================================
           MAIN CONTENT
        ====================================================== */

        .main-content {

            margin-left: 240px;

            min-height: 100vh;

            padding: 25px 30px 40px;

            transition:
                margin-left 0.3s ease;

        }


        /* =====================================================
           SIDEBAR CLOSED
        ====================================================== */

        body.sidebar-closed .main-content {

            margin-left: 0;

        }


        /* =====================================================
           HEADER
        ====================================================== */

        .page-header {

            width: 100%;

            min-height: 70px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;

        }


        /* =====================================================
           HEADER LEFT
        ====================================================== */

        .header-left {

            display: flex;

            align-items: center;

            gap: 16px;

            min-width: 0;

        }


        /* =====================================================
           HAMBURGER
        ====================================================== */

        .mobile-menu-button {

            width: 42px;

            height: 42px;

            border: none;

            border-radius: 10px;

            background: #ffffff;

            color: #07536b;

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            font-size: 18px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.06);

            transition:
                all 0.2s ease;

            flex-shrink: 0;

        }


        .mobile-menu-button:hover {

            background: #07536b;

            color: #ffffff;

            transform: translateY(-1px);

        }


        /* =====================================================
           TITLE
        ====================================================== */

        .page-title-wrapper {

            min-width: 0;

        }


        .page-title {

            font-size: 25px;

            font-weight: 700;

            color: #173f55;

            line-height: 1.3;

        }


        .page-subtitle {

            margin-top: 4px;

            font-size: 13px;

            color: #8295a2;

        }


        /* =====================================================
           HEADER USER
        ====================================================== */

        .header-user {

            display: flex;

            align-items: center;

            gap: 11px;

            padding: 8px 13px;

            background: #ffffff;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.05);

            flex-shrink: 0;

        }


        .header-user-icon {

            width: 38px;

            height: 38px;

            border-radius: 10px;

            background: #e8f6fa;

            color: #087da3;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .header-user-info {

            display: flex;

            flex-direction: column;

        }


        .header-user-info strong {

            font-size: 13px;

            font-weight: 700;

            color: #284a5e;

        }


        .header-user-info span {

            font-size: 11px;

            color: #8c9da8;

        }


        /* =====================================================
           WELCOME CARD
        ====================================================== */

        .welcome-card {

            background:
                linear-gradient(
        145deg,
        #FF8A00 0%,
        #FE9D2A 40%,
        #F9DA00 100% );

            border-radius: 18px;

            padding: 27px 30px;

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;

            box-shadow:
                0 10px 25px rgba(7, 83, 107, 0.14);

        }


        .welcome-content h2 {

            font-size: 21px;

            font-weight: 700;

            margin-bottom: 6px;

        }


        .welcome-content p {

            font-size: 13px;

            color: rgba(255,255,255,0.82);

            line-height: 1.6;

        }


        .welcome-icon {

            width: 68px;

            height: 68px;

            border-radius: 18px;

            background: rgba(255,255,255,0.12);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 30px;

            flex-shrink: 0;

        }


        /* =====================================================
           STATISTIC CARDS
        ====================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 18px;

            margin-bottom: 25px;

        }


        .stat-card {

            background: #ffffff;

            border-radius: 16px;

            padding: 20px;

            display: flex;

            align-items: center;

            gap: 15px;

            border: 1px solid #edf1f4;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.04);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;

        }


        .stat-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 9px 25px rgba(0,0,0,0.07);

        }


        .stat-icon {

            width: 48px;

            height: 48px;

            border-radius: 13px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            flex-shrink: 0;

        }


        .stat-card.waiting .stat-icon {

            background: #fff4df;

            color: #d58b00;

        }


        .stat-card.served .stat-icon {

            background: #e7f8ee;

            color: #29945c;

        }


        .stat-card.skipped .stat-icon {

            background: #fdebec;

            color: #d64d55;

        }


        .stat-card.total .stat-icon {

            background: #e8f4f8;

            color: #087da3;

        }


        .stat-info {

            min-width: 0;

        }


        .stat-info span {

            display: block;

            font-size: 12px;

            color: #8b9aa5;

            margin-bottom: 4px;

        }


        .stat-info strong {

            display: block;

            font-size: 24px;

            font-weight: 800;

            color: #25485b;

            line-height: 1;

        }


        /* =====================================================
           DASHBOARD TWO COLUMN
        ====================================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                minmax(350px, 1.5fr);

            gap: 20px;

            align-items: stretch;

        }


        /* =====================================================
           GENERAL CARD
        ====================================================== */

        .dashboard-card {

            background: #ffffff;

            border-radius: 17px;

            border: 1px solid #e8eef2;

            box-shadow:
                0 7px 22px rgba(0,0,0,0.04);

            overflow: hidden;

        }


        /* =====================================================
           CARD HEADER
        ====================================================== */

        .card-header {

            padding: 20px 22px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            border-bottom: 1px solid #edf1f4;

        }


        .card-header h3 {

            font-size: 17px;

            color: #25495c;

            font-weight: 700;

        }


        .card-header p {

            font-size: 11px;

            color: #91a0aa;

            margin-top: 3px;

        }


        .card-header > span {

            font-size: 11px;

            color: #d18a00;

            background: #fff6e5;

            padding: 7px 11px;

            border-radius: 20px;

            white-space: nowrap;

        }


        /* =====================================================
           CURRENT QUEUE
        ====================================================== */

        .current-queue {

            padding: 25px;

            min-height: 270px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

        }


        .current-label {

            font-size: 12px;

            color: #92a1aa;

            margin-bottom: 8px;

        }


        .current-number {

            font-size: 48px;

            line-height: 1;

            font-weight: 800;

            color: #087da3;

            margin-bottom: 9px;

            letter-spacing: 1px;

        }


        .current-pt {

            font-size: 14px;

            font-weight: 600;

            color: #385667;

            max-width: 90%;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .current-status {

            margin-top: 15px;

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 13px;

            border-radius: 20px;

            background: #e8f8ef;

            color: #29935a;

            font-size: 11px;

            font-weight: 600;

        }


        .current-status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #2fb56d;

        }


        /* =====================================================
           EMPTY CURRENT
        ====================================================== */

        .empty-current {

            padding: 40px 20px;

            text-align: center;

            color: #9aabb5;

        }


        .empty-current i {

            font-size: 38px;

            margin-bottom: 12px;

            color: #bfd0d8;

        }


        .empty-current p {

            font-size: 13px;

        }


        /* =====================================================
           NEXT QUEUE
        ====================================================== */

        .next-queue-body {

            padding: 0;

        }


        .next-list {

            width: 100%;

        }


        .next-item {

            display: grid;

            grid-template-columns:
                35px
                120px
                minmax(180px, 1fr)
                80px
                100px;

            align-items: center;

            gap: 13px;

            padding: 15px 20px;

            border-bottom: 1px solid #edf1f4;

            transition:
                background 0.2s ease;

        }


        .next-item:last-child {

            border-bottom: none;

        }


        .next-item:hover {

            background: #f8fbfc;

        }


        .next-index {

            width: 31px;

            height: 31px;

            border-radius: 9px;

            background: #edf7fa;

            color: #087da3;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 11px;

            font-weight: 700;

        }


        .next-ticket
        {

            min-width: 0;

            display: flex;

            flex-direction: column;

            gap: 3px;

        }

        .next-pt
        {

            min-width: 0;

            display: flex;

            flex-direction: column;
            position: relative;
            gap: 3px;
            right: 50px;
        }

        .next-time{
            min-width: 0;

            display: flex;

            flex-direction: column;
            position: relative;
            gap: 3px;
            left: 20px;
        }


        .ticket-label,
        .pt-label,
        .time-label {

            font-size: 9px;

            color: #9aa9b2;

            text-transform: uppercase;

            letter-spacing: .2px;

        }


        .next-ticket strong {

            font-size: 16px;

            color: #087da3;

            font-weight: 800;

        }


        .next-pt strong {

            display: block;

    font-size: 12px;
    color: #07566b;

    white-space: normal;
    overflow: visible;
    text-overflow: clip;

    line-height: 1.4;

    /* Nama boleh turun ke baris berikutnya */
    overflow-wrap: break-word;

        }


        .next-time span:last-child {

            font-size: 11px;

            color: #637b89;

        }


        .next-status {

            display: flex;
            margin-left: 40px;
            justify-content: flex-end;

        }


        .status-waiting {

            display: inline-flex;

            align-items: center;
             position: relative;
            right: 30px;
            gap: 5px;

            padding: 6px 9px;

            border-radius: 20px;

            background: #e9f8ef;

            color: #29935b;

            font-size: 10px;

            font-weight: 600;

            white-space: nowrap;

        }


        .status-dot {

            width: 6px;

            height: 6px;
            
            border-radius: 50%;

            background: #2eb66d;

        }


        /* =====================================================
           EMPTY QUEUE
        ====================================================== */

        .empty-queue {

            min-height: 240px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            padding: 30px 20px;

        }


        .empty-icon {

            width: 58px;

            height: 58px;

            border-radius: 50%;

            background: #edf6f9;

            color: #8faab6;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 23px;

            margin-bottom: 12px;

        }


        .empty-queue h4 {

            color: #536d7c;

            font-size: 15px;

            margin-bottom: 5px;

        }


        .empty-queue p {

            color: #9aa9b2;

            font-size: 11px;

        }


        /* =====================================================
           QUICK INFORMATION
        ====================================================== */

        .dashboard-info {

            margin-top: 20px;

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;

        }


        .info-card {

            background: #ffffff;

            border: 1px solid #e8eef2;

            border-radius: 15px;

            padding: 18px 20px;

            display: flex;

            align-items: center;

            gap: 13px;

        }


        .info-icon {

            width: 42px;

            height: 42px;

            border-radius: 11px;

            background: #eef7fa;

            color: #087da3;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

        }


        .info-card span {

            display: block;

            font-size: 11px;

            color: #8d9da7;

        }


        .info-card strong {

            display: block;

            margin-top: 2px;

            font-size: 17px;

            color: #365667;

        }


        /* =====================================================
           TABLET
        ====================================================== */

        @media (max-width: 1100px) {

            .stats-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }


            .dashboard-grid {

                grid-template-columns: 1fr;

            }


            .next-item {

                grid-template-columns:
                    35px
                    120px
                    minmax(200px, 1fr)
                    100px;

            }


            .next-time {

                display: none;

            }

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 768px) {

            .main-content {

                margin-left: 0;

                padding: 18px 15px 30px;

            }


            body.sidebar-closed .main-content {

                margin-left: 0;

            }


            .page-header {

                min-height: 55px;

                margin-bottom: 18px;

            }


            .page-title {

                font-size: 19px;

            }


            .page-subtitle {

                font-size: 11px;

            }


            .header-user {

                padding: 6px;

            }


            .header-user-info {

                display: none;

            }


            .header-user-icon {

                width: 35px;

                height: 35px;

            }


            .welcome-card {

                padding: 20px;

                border-radius: 15px;

            }


            .welcome-content h2 {

                font-size: 18px;
                font-weight: 800px;

            }


            .welcome-content p {

                font-size: 11px;
                font-weight: 600;

            }


            .welcome-icon {

                width: 52px;

                height: 52px;

                font-size: 23px;

            }


            .stats-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 12px;

            }


            .stat-card {

                padding: 14px;

                gap: 10px;

            }


            .stat-icon {

                width: 40px;

                height: 40px;

                font-size: 16px;

            }


            .stat-info strong {

                font-size: 19px;

            }


            .dashboard-info {

                grid-template-columns: 1fr;

            }


            .next-item {

                grid-template-columns:
                    32px
                    1fr
                    auto;

                gap: 10px;

                padding: 14px 16px;

            }


            .next-index {

                grid-column: 1;

                grid-row: 1;

            }


            .next-ticket {

                grid-column: 2;

                grid-row: 1;

            }


            .next-status {

                grid-column: 3;

                grid-row: 1;

            }


            .next-pt {

                grid-column: 2 / 4;

                grid-row: 2;

            }


            .next-ticket strong {

                font-size: 15px;

            }


            .next-pt strong {

                font-size: 11px;

            }

        }


        /* =====================================================
           MOBILE SMALL
        ====================================================== */

        @media (max-width: 480px) {

            .page-header {

                align-items: flex-start;

            }


            .header-left {

                gap: 9px;

            }


            .mobile-menu-button {

                width: 38px;

                height: 38px;

                font-size: 16px;

            }


            .page-title {

                font-size: 17px;

            }


            .page-subtitle {

                display: none;

            }


            .stats-grid {

                grid-template-columns: 1fr;

            }


            .stat-card {

                padding: 15px;

            }


            .welcome-icon {

                display: none;

            }


            .card-header {

                padding: 16px;

            }


            .card-header h3 {

                font-size: 15px;

            }


            .current-number {

                font-size: 42px;

            }


            .waiting-badge {

                font-size: 9px;

            }

        }

    </style>

</head>


<body>


{{-- =====================================================
     SIDEBAR PETUGAS
====================================================== --}}

@include('pages.Layouts.sidebar-petugas')


{{-- =====================================================
     MAIN CONTENT
====================================================== --}}

<main class="main-content">


    {{-- =================================================
         PAGE HEADER
    ================================================== --}}

    <header class="page-header">


        <div class="header-left">


            {{-- HAMBURGER --}}

            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Buka/Tutup Sidebar">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1 class="page-title">
                    Dashboard Petugas
                </h1>

                <p class="page-subtitle">
                    Monitoring dan pengelolaan antrean pelayanan SITAFAS
                </p>

            </div>

        </div>


        {{-- =================================================
             USER
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

    </header>



    {{-- =================================================
         WELCOME
    ================================================== --}}

    <section class="welcome-card">

        <div class="welcome-content">

            <h2>
                Selamat Datang, {{ Auth::user()->nama ?? 'Petugas' }} 👋
            </h2>

            <p>
                Pantau antrean pelayanan dan pastikan setiap peserta
                mendapatkan pelayanan sesuai urutan.
            </p>

        </div>


        <div class="welcome-icon">

            <i class="fa-solid fa-headset"></i>

        </div>

    </section>



    {{-- =================================================
         STATISTIK
    ================================================== --}}

    <section class="stats-grid">


        {{-- MENUNGGU --}}

        <div class="stat-card waiting">

            <div class="stat-icon">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div class="stat-info">

                <span>
                    Menunggu
                </span>

                <strong>
                    {{ $jumlahMenunggu ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- DILAYANI --}}

        <div class="stat-card served">

            <div class="stat-icon">

                <i class="fa-solid fa-user-check"></i>

            </div>

            <div class="stat-info">

                <span>
                    Sudah Dilayani
                </span>

                <strong>
                    {{ $jumlahDilayani ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- TOTAL --}}

        <div class="stat-card total">

            <div class="stat-icon">

                <i class="fa-solid fa-ticket"></i>

            </div>

            <div class="stat-info">

                <span>
                    Total Tiket
                </span>

                <strong>
                    {{ $totalTiket ?? 0 }}
                </strong>

            </div>

        </div>


    </section>



    {{-- =================================================
         DASHBOARD CONTENT
    ================================================== --}}

    <section class="dashboard-grid">


        {{-- =================================================
             ANTREAN SEKARANG
        ================================================== --}}

        <div class="dashboard-card">


            <div class="card-header">

                <div>

                    <h3>
                        Antrean Saat Ini
                    </h3>

                    <p>
                        Peserta yang sedang dilayani
                    </p>

                </div>


                <span>
                    Sedang Dilayani
                </span>

            </div>


            @if(isset($antreanSekarang) && $antreanSekarang)

                <div class="current-queue">


                    <span class="current-label">
                        Nomor Antrean
                    </span>


                    <div class="current-number">

                        @if(!empty($antreanSekarang?->nomor_tiket))

        {{ preg_replace('/\D/', '', $antreanSekarang->nomor_tiket) }}

    @else

        -

    @endif

                    </div>


                    <div class="current-pt">

                        {{ $antreanSekarang->nama_pt ?? 'Perguruan Tinggi' }}

                    </div>


                    <div class="current-status">

                        <span class="current-status-dot"></span>

                        Sedang Dilayani

                    </div>


                </div>

            @else

                <div class="empty-current">

                    <i class="fa-solid fa-user-clock"></i>

                    <p>
                        Belum ada antrean yang sedang dilayani.
                    </p>

                </div>

            @endif

        </div>



        {{-- =================================================
             ANTREAN BERIKUTNYA
        ================================================== --}}

        <div class="dashboard-card">


            <div class="card-header">

                <div>

                    <h3>
                        Antrean Berikutnya
                    </h3>

                    <p>
                        Peserta yang menunggu untuk dilayani
                    </p>

                </div>


                <span>

                    <i class="fa-solid fa-clock"></i>

                    {{ $jumlahMenunggu ?? 0 }} Menunggu

                </span>

            </div>


            <div class="next-queue-body">


                @if(isset($antreanBerikutnya) &&
                    $antreanBerikutnya->count() > 0)


                    <div class="next-list">


                        @foreach($antreanBerikutnya as $index => $antrean)


                            <div class="next-item">


                                {{-- NOMOR URUT --}}

                                <div class="next-index">

                                    {{ $index + 1 }}

                                </div>


                                {{-- NOMOR TIKET --}}

                                <div class="next-ticket">

                                    <span class="ticket-label">
                                        Nomor
                                    </span>

                                    <strong>

                                        {{ $antrean->nomor_tiket ?? '-' }}

                                    </strong>

                                </div>


                                {{-- PERGURUAN TINGGI --}}

                                <div class="next-pt">

                                    <span class="pt-label">
                                        Perguruan Tinggi
                                    </span>

                                    <strong>

                                        {{ $antrean->nama_pt ?? '-' }}

                                    </strong>

                                </div>


                                {{-- WAKTU --}}

                                <div class="next-time">

                                    <span class="time-label">
                                        Daftar
                                    </span>

                                    <span>

                                        @if($antrean->waktu_daftar)

                                            {{ \Carbon\Carbon::parse($antrean->waktu_daftar)->format('H:i') }}

                                        @else

                                            -

                                        @endif

                                    </span>

                                </div>


                                {{-- STATUS --}}

                                <div class="next-status">

                                    <span class="status-waiting">

                                        <span class="status-dot"></span>

                                        Menunggu

                                    </span>

                                </div>


                            </div>


                        @endforeach


                    </div>


                @else


                    <div class="empty-queue">

                        <div class="empty-icon">

                            <i class="fa-solid fa-users"></i>

                        </div>

                        <h4>
                            Belum Ada Antrean
                        </h4>

                        <p>
                            Saat ini belum ada peserta yang menunggu.
                        </p>

                    </div>


                @endif


            </div>

        </div>


    </section>



    {{-- =================================================
         INFORMASI TAMBAHAN
    ================================================== --}}

    <section class="dashboard-info">


        {{-- TOTAL REGISTRASI --}}

        <div class="info-card">

            <div class="info-icon">

                <i class="fa-solid fa-clipboard-list"></i>

            </div>

            <div>

                <span>
                    Total Registrasi
                </span>

                <strong>
                    {{ $totalRegistrasi ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- TOTAL TIKET --}}

        <div class="info-card">

            <div class="info-icon">

                <i class="fa-solid fa-ticket"></i>

            </div>

            <div>

                <span>
                    Total Tiket Terdaftar
                </span>

                <strong>
                    {{ $totalTiket ?? 0 }}
                </strong>

            </div>

        </div>


    </section>


</main>



{{-- =====================================================
     SIDEBAR JAVASCRIPT
====================================================== --}}

<script src="{{ asset('js/sidebar-petugas.js') }}"></script>


</body>

</html>