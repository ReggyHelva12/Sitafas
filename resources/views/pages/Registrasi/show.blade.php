<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Registrasi - SITAFAS</title>


    {{-- =====================================================
         GOOGLE FONT
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


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f8fc;
            color: #123f66;
            min-height: 100vh;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            padding: 30px 35px;
            transition: margin-left 0.3s ease;
        }


        /*
        | Ketika sidebar ditutup
        */

        body.sidebar-closed .main-content {
            margin-left: 85px;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }


        .page-header-left {
            display: flex;
            align-items: center;
            gap: 25px;
        }


        /* =====================================================
           HAMBURGER
        ===================================================== */

        .hamburger-btn {
            width: 70px;
            height: 70px;

            border: none;
            border-radius: 22px;

            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            box-shadow: 0 8px 25px rgba(25, 75, 115, 0.08);

            transition: all 0.3s ease;
        }


        .hamburger-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(25, 75, 115, 0.13);
        }


        .hamburger-btn i {
            font-size: 28px;
            color: #0c5b88;
        }


        /* =====================================================
           TITLE
        ===================================================== */

        .page-title-wrapper h1 {
            font-size: 32px;
            font-weight: 700;
            color: #064f82;
            margin-bottom: 5px;
        }


        .page-title-wrapper p {
            font-size: 16px;
            color: #7fa4c5;
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
            width: 60px;
            height: 60px;

            border-radius: 50%;

            background: #e3f4fc;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .header-user-icon i {
            font-size: 27px;
            color: #0b91c4;
        }


        .header-user-info {
            display: flex;
            flex-direction: column;
        }


        .header-user-info strong {
            color: #075083;
            font-size: 18px;
        }


        .header-user-info span {
            color: #82a5c4;
            font-size: 14px;
            margin-top: 2px;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            padding: 15px 20px;
            border-radius: 12px;

            display: flex;
            align-items: center;
            gap: 12px;

            margin-bottom: 25px;

            font-size: 14px;
        }


        .alert-success {
            background: #e9f9ef;
            color: #168047;
            border: 1px solid #bce8cd;
        }


        .alert-danger {
            background: #fff0f0;
            color: #c63b3b;
            border: 1px solid #f0c1c1;
        }


        /* =====================================================
           DETAIL CARD
        ===================================================== */

        .detail-card {
            background: #ffffff;

            border-radius: 25px;

            box-shadow: 0 10px 35px rgba(30, 80, 120, 0.08);

            overflow: hidden;
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .detail-card-header {
            padding: 30px 35px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid #e3edf5;
        }


        .detail-card-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }


        .detail-card-title-icon {
            width: 55px;
            height: 55px;

            border-radius: 16px;

            background: #e7f5fc;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .detail-card-title-icon i {
            font-size: 25px;
            color: #1597c9;
        }


        .detail-card-title h2 {
            font-size: 23px;
            color: #075083;
            margin-bottom: 3px;
        }


        .detail-card-title p {
            font-size: 14px;
            color: #8aaac5;
        }


        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .btn-back {
            text-decoration: none;

            padding: 12px 20px;

            border-radius: 10px;

            background: #edf5fa;
            color: #12628f;

            font-size: 14px;
            font-weight: 600;

            display: inline-flex;
            align-items: center;
            gap: 8px;

            transition: all 0.2s ease;
        }


        .btn-back:hover {
            background: #dcecf5;
        }


        /* =====================================================
           DETAIL BODY
        ===================================================== */

        .detail-body {
            padding: 35px;
        }


        /* =====================================================
           TICKET CARD
        ===================================================== */

        .ticket-highlight {
            background: linear-gradient(
                135deg,
                #083d70,
                #0d6295
            );

            border-radius: 18px;

            padding: 25px 30px;

            color: white;

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 30px;
        }


        .ticket-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }


        .ticket-icon {
            width: 58px;
            height: 58px;

            border-radius: 15px;

            background: rgba(255,255,255,0.14);

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .ticket-icon i {
            font-size: 25px;
            color: #ffffff;
        }


        .ticket-label {
            font-size: 13px;
            opacity: .8;
            margin-bottom: 3px;
        }


        .ticket-number {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .ticket-status {
            text-align: right;
        }


        .ticket-status-label {
            font-size: 12px;
            opacity: .8;
            margin-bottom: 7px;
        }


        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 8px 14px;

            border-radius: 30px;

            font-size: 13px;
            font-weight: 600;
        }


        .status-terdaftar {
            background: #e9f3ff;
            color: #2874c6;
        }


        .status-diproses {
            background: #fff5dc;
            color: #b87600;
        }


        .status-selesai {
            background: #e8f8ee;
            color: #178044;
        }


        .status-dibatalkan {
            background: #ffebeb;
            color: #c13d3d;
        }


        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }


        /* =====================================================
           SECTION TITLE
        ===================================================== */

        .section-title {
            font-size: 18px;
            color: #075083;

            margin-bottom: 18px;

            display: flex;
            align-items: center;
            gap: 9px;
        }


        .section-title i {
            color: #1597c9;
        }


        /* =====================================================
           DETAIL GRID
        ===================================================== */

        .detail-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;

            margin-bottom: 30px;
        }


        .detail-item {
            padding: 20px;

            border: 1px solid #e0ebf3;

            border-radius: 14px;

            background: #fbfdff;
        }


        .detail-label {
            display: block;

            font-size: 12px;

            color: #8baac2;

            margin-bottom: 7px;

            text-transform: uppercase;

            font-weight: 600;

            letter-spacing: .3px;
        }


        .detail-value {
            font-size: 16px;

            font-weight: 600;

            color: #164f76;

            line-height: 1.5;
        }


        .detail-value i {
            color: #1597c9;
            margin-right: 7px;
        }


        /* =====================================================
           KEBUTUHAN
        ===================================================== */

        .needs-box {
            border: 1px solid #e0ebf3;

            border-radius: 14px;

            padding: 20px;

            background: #fbfdff;

            margin-bottom: 30px;
        }


        .needs-box p {
            color: #557d9d;

            line-height: 1.7;

            font-size: 15px;
        }


        /* =====================================================
           TICKET TIME
        ===================================================== */

        .timeline {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 15px;
        }


        .timeline-item {
            border: 1px solid #e0ebf3;

            border-radius: 14px;

            padding: 18px;

            background: #ffffff;
        }


        .timeline-icon {
            width: 40px;
            height: 40px;

            border-radius: 10px;

            background: #eaf6fc;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 12px;
        }


        .timeline-icon i {
            color: #1494c6;
        }


        .timeline-label {
            font-size: 12px;
            color: #8baac2;
            margin-bottom: 5px;
        }


        .timeline-value {
            font-size: 14px;
            color: #315f7e;
            font-weight: 600;
        }


        /* =====================================================
           ACTION
        ===================================================== */

        .detail-actions {
            display: flex;
            justify-content: flex-end;

            gap: 12px;

            margin-top: 30px;

            padding-top: 25px;

            border-top: 1px solid #e4edf4;
        }


        .btn-status {
            border: none;

            padding: 12px 20px;

            border-radius: 10px;

            background: #0d689b;

            color: white;

            font-family: inherit;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            display: inline-flex;

            align-items: center;

            gap: 8px;
        }


        .btn-status:hover {
            background: #095780;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            .main-content {
                margin-left: 0;
                padding: 25px 20px;
            }


            body.sidebar-closed .main-content {
                margin-left: 0;
            }


            .detail-grid {
                grid-template-columns: 1fr;
            }


            .timeline {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 700px) {

            .main-content {
                padding: 20px 15px;
            }


            .page-header {
                align-items: flex-start;
            }


            .header-user {
                display: none;
            }


            .page-header-left {
                gap: 15px;
            }


            .hamburger-btn {
                width: 55px;
                height: 55px;
                border-radius: 16px;
            }


            .page-title-wrapper h1 {
                font-size: 23px;
            }


            .page-title-wrapper p {
                font-size: 13px;
            }


            .detail-card-header {
                padding: 22px;

                align-items: flex-start;

                flex-direction: column;

                gap: 18px;
            }


            .detail-body {
                padding: 22px;
            }


            .ticket-highlight {
                padding: 20px;

                flex-direction: column;

                align-items: flex-start;

                gap: 20px;
            }


            .ticket-status {
                text-align: left;
            }


            .ticket-number {
                font-size: 26px;
            }


            .detail-actions {
                flex-direction: column;
            }


            .btn-back,
            .btn-status {
                justify-content: center;
                width: 100%;
            }

        }

    </style>

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

<main class="main-content"
      id="mainContent">


    {{-- =================================================
         HEADER
    ================================================== --}}

    <header class="page-header">


        <div class="page-header-left">


            {{-- HAMBURGER --}}

            <button
                type="button"
                class="hamburger-btn"
                id="sidebarToggle">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1>
                    Detail Registrasi
                </h1>

                <p>
                    Informasi lengkap registrasi perguruan tinggi
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
                    {{ Auth::user()->nama ?? 'Admin Penjamu' }}
                </strong>

                <span>
                    {{ ucfirst(Auth::user()->role ?? 'Administrator') }}
                </span>

            </div>

        </div>

    </header>


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
         DETAIL CARD
    ================================================== --}}

    <section class="detail-card">


        {{-- =================================================
             CARD HEADER
        ================================================== --}}

        <div class="detail-card-header">


            <div class="detail-card-title">

                <div class="detail-card-title-icon">

                    <i class="fa-solid fa-file-lines"></i>

                </div>


                <div>

                    <h2>
                        Detail Registrasi
                    </h2>

                    <p>
                        Data pendaftaran layanan SITAFAS
                    </p>

                </div>

            </div>


            {{-- KEMBALI --}}

            <a href="{{ route('admin.registrasi.index') }}"
               class="btn-back">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- =================================================
             BODY
        ================================================== --}}

        <div class="detail-body">


            {{-- =================================================
                 TICKET
            ================================================== --}}

            <div class="ticket-highlight">


                <div class="ticket-left">

                    <div class="ticket-icon">

                        <i class="fa-solid fa-ticket"></i>

                    </div>


                    <div>

                        <div class="ticket-label">
                            NOMOR TIKET
                        </div>

                        <div class="ticket-number">

                            {{ preg_replace('/^[A-Za-z]+-/', '', $registrasi->tiket->nomor_tiket) }}

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="ticket-status">

                    <div class="ticket-status-label">
                        STATUS REGISTRASI
                    </div>


                    @php

                        $status = $registrasi->status;

                    @endphp


                    @if($status === 'terdaftar')

                        <span class="status-badge status-terdaftar">

                            <span class="status-dot"></span>

                            Terdaftar

                        </span>

                    @elseif($status === 'diproses')

                        <span class="status-badge status-diproses">

                            <span class="status-dot"></span>

                            Diproses

                        </span>

                    @elseif($status === 'selesai')

                        <span class="status-badge status-selesai">

                            <span class="status-dot"></span>

                            Selesai

                        </span>

                    @elseif($status === 'dibatalkan')

                        <span class="status-badge status-dibatalkan">

                            <span class="status-dot"></span>

                            Dibatalkan

                        </span>

                    @else

                        <span class="status-badge">

                            {{ ucfirst($status ?? '-') }}

                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 INFORMASI REGISTRASI
            ================================================== --}}

            <h3 class="section-title">

                <i class="fa-solid fa-circle-info"></i>

                Informasi Registrasi

            </h3>


            <div class="detail-grid">

                {{-- PERGURUAN TINGGI --}}

                <div class="detail-item">

        <span class="detail-label">
            Perguruan Tinggi
        </span>

        <div class="detail-value">

            <i class="fa-solid fa-building-columns"></i>

            {{ $registrasi->master->nama_pt ?? '-' }}

        </div>

    </div>


                {{-- KODE PT --}}

                <div class="detail-item">

        <span class="detail-label">
            Kode Perguruan Tinggi
        </span>

        <div class="detail-value">

            {{ $registrasi->master->kode_pt ?? '-' }}

        </div>

    </div>


                {{-- FASWIL --}}

                 <div class="detail-item">

        <span class="detail-label">
            Faswil
        </span>

        <div class="detail-value">

            <i class="fa-solid fa-user-tie"></i>

            {{ $registrasi->master->nama_faswil ?? '-' }}

        </div>

    </div>


    {{-- =========================================
         NO MEJA
    ========================================== --}}

    <div class="detail-item">

        <span class="detail-label">
            No. Meja
        </span>

        <div class="detail-value">

            <i class="fa-solid fa-chair"></i>

            {{ $registrasi->master->no_meja ?? '-' }}

        </div>

    </div>

     {{-- =========================================
         SESI
    ========================================== --}}

    <div class="detail-item">

        <span class="detail-label">
            Sesi
        </span>

        <div class="detail-value">

            <i class="fa-solid fa-layer-group"></i>

            {{ $registrasi->master->sesi ?? '-' }}

        </div>

    </div>


                {{-- =========================================
         TANGGAL JADWAL
    ========================================== --}}

    <div class="detail-item">

        <span class="detail-label">
            Tanggal Layanan
        </span>

        <div class="detail-value">

            <i class="fa-regular fa-calendar"></i>

            @if($registrasi->master && $registrasi->master->tanggal)

                {{ \Carbon\Carbon::parse(
                    $registrasi->master->tanggal
                )->translatedFormat('d F Y') }}

            @else

                -

            @endif

        </div>

    </div>

    {{-- =========================================
         JAM LAYANAN
    ========================================== --}}

    <div class="detail-item">

        <span class="detail-label">
            Jam Layanan
        </span>

        <div class="detail-value">

            <i class="fa-regular fa-clock"></i>

            @if(
                $registrasi->master &&
                $registrasi->master->jam_mulai &&
                $registrasi->master->jam_selesai
            )

                {{ substr($registrasi->master->jam_mulai, 0, 5) }}
                -
                {{ substr($registrasi->master->jam_selesai, 0, 5) }}

                WIB

            @else

                -

            @endif

        </div>

    </div>


    {{-- =========================================
         PENDAMPING
    ========================================== --}}

    <div class="detail-item">

        <span class="detail-label">
            Pendamping
        </span>

        <div class="detail-value">

            <i class="fa-solid fa-user"></i>

            {{ $registrasi->master->pendamping ?? '-' }}

        </div>

    </div>

            </div>


            {{-- =================================================
                 KEBUTUHAN
            ================================================== --}}

            <h3 class="section-title">

                <i class="fa-solid fa-clipboard-list"></i>

                Kebutuhan Layanan

            </h3>


            <div class="needs-box">

                <p>

                    {{ $registrasi->kebutuhan ?? 'Tidak ada kebutuhan yang dicatat.' }}

                </p>

            </div>


            {{-- =================================================
                 WAKTU TIKET
            ================================================== --}}

            @if($registrasi->tiket)

                <h3 class="section-title">

                    <i class="fa-solid fa-clock"></i>

                    Riwayat Tiket

                </h3>


                <div class="timeline">


                    {{-- DAFTAR --}}

                    <div class="timeline-item">

                        <div class="timeline-icon">

                            <i class="fa-solid fa-ticket"></i>

                        </div>

                        <div class="timeline-label">
                            Waktu Daftar
                        </div>

                        <div class="timeline-value">

                            {{ $registrasi->tiket->waktu_daftar
                                ? \Carbon\Carbon::parse($registrasi->tiket->waktu_daftar)->translatedFormat('d F Y H:i')
                                : '-'
                            }}

                            WIB

                        </div>

                    </div>


                    {{-- MULAI --}}

                    <div class="timeline-item">

                        <div class="timeline-icon">

                            <i class="fa-solid fa-play"></i>

                        </div>

                        <div class="timeline-label">
                            Mulai Diproses
                        </div>

                        <div class="timeline-value">

                            {{ $registrasi->tiket->waktu_mulai
                                ? \Carbon\Carbon::parse($registrasi->tiket->waktu_mulai)->translatedFormat('d F Y H:i')
                                : 'Belum diproses'
                            }}

                            @if($registrasi->tiket->waktu_mulai)
                                WIB
                            @endif

                        </div>

                    </div>


                    {{-- SELESAI --}}

                    <div class="timeline-item">

                        <div class="timeline-icon">

                            <i class="fa-solid fa-check"></i>

                        </div>

                        <div class="timeline-label">
                            Waktu Selesai
                        </div>

                        <div class="timeline-value">

                            {{ $registrasi->tiket->waktu_selesai
                                ? \Carbon\Carbon::parse($registrasi->tiket->waktu_selesai)->translatedFormat('d F Y H:i')
                                : 'Belum selesai'
                            }}

                            @if($registrasi->tiket->waktu_selesai)
                                WIB
                            @endif

                        </div>

                    </div>


                </div>

            @endif


            {{-- =================================================
                 UPDATE STATUS
            ================================================== --}}

            <div class="detail-actions">


                <a href="{{ route('admin.registrasi.index') }}"
                   class="btn-back">

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali ke Kelola Registrasi

                </a>

            </div>


        </div>

    </section>


</main>


{{-- =====================================================
     SIDEBAR JAVASCRIPT
====================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    const sidebar =
        document.getElementById('sidebar');


    const sidebarToggle =
        document.getElementById('sidebarToggle');


    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    /*
    |--------------------------------------------------------------------------
    | TOGGLE SIDEBAR DESKTOP
    |--------------------------------------------------------------------------
    */

    if (sidebarToggle && sidebar) {

        sidebarToggle.addEventListener(
            'click',
            function () {

                sidebar.classList.toggle('closed');

                document.body.classList.toggle(
                    'sidebar-closed'
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE OVERLAY
    |--------------------------------------------------------------------------
    */

    if (sidebarOverlay && sidebar) {

        sidebarOverlay.addEventListener(
            'click',
            function () {

                sidebar.classList.remove('active');

                sidebarOverlay.classList.remove(
                    'active'
                );

            }
        );

    }


});

</script>


</body>

</html>