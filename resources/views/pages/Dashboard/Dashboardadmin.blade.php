
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - SITAFAS</title>


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    {{-- =====================================================
         GOOGLE FONT
    ====================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- =====================================================
         SIDEBAR CSS
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/sidebar.css') }}"
    >


    {{-- =====================================================
         DASHBOARD CSS
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/dashboard.css') }}"
    >

</head>


<body>


{{-- =========================================================
     SIDEBAR
========================================================= --}}

@include('pages.Layouts.sidebar')


{{-- =========================================================
     SIDEBAR OVERLAY
========================================================= --}}

<div
    class="sidebar-overlay"
    id="sidebarOverlay">
</div>


{{-- =========================================================
     MAIN CONTENT
========================================================= --}}

<main class="main-content">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <header class="dashboard-header">


        {{-- HEADER LEFT --}}

        <div class="header-left">


            {{-- =================================================
                 SATU-SATUNYA TOMBOL TOGGLE SIDEBAR
            ================================================== --}}

            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Toggle sidebar"
                aria-expanded="true"
            >

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div>

                <h1>
                    Dashboard Admin
                </h1>

                <p>
                    Ringkasan aktivitas SITAFAS
                </p>

            </div>

        </div>


        {{-- =================================================
             HEADER RIGHT
        ================================================== --}}

        <div class="header-right">


            {{-- USER --}}

            <div class="header-user">


                <div class="header-user-avatar">

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

    </header>


    {{-- =====================================================
         WELCOME
    ====================================================== --}}

    <section class="welcome-section">


        <div>

            <h2>

                Selamat datang,

                {{ Auth::user()->nama ?? 'Admin' }}! 👋

            </h2>


            <p>

                Berikut ringkasan aktivitas

                SITAFAS hari ini.

            </p>

        </div>


        <div class="date-info">

            <i class="fa-regular fa-calendar"></i>

            <span id="currentDate">

                {{ now()->translatedFormat('l, d F Y') }}

            </span>

        </div>

    </section>


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <section class="statistics-grid">


        {{-- =================================================
             TOTAL PT
        ================================================== --}}

        <div class="stat-card">

            <div class="stat-icon blue">

                <i class="fa-solid fa-building-columns"></i>

            </div>


            <div class="stat-content">

                <span class="stat-label">
                    Perguruan Tinggi
                </span>


                <strong class="stat-number">
                    {{ $totalPT }}
                </strong>


                <small>
                    Total terdaftar
                </small>

            </div>

        </div>


        {{-- =================================================
             TOTAL FASWIL
        ================================================== --}}

        <div class="stat-card">

            <div class="stat-icon teal">

                <i class="fa-solid fa-building"></i>

            </div>


            <div class="stat-content">

                <span class="stat-label">
                    Total Faswil
                </span>


                <strong class="stat-number">
                    {{ $totalFaswil }}
                </strong>


                <small>
                    {{ $faswilAktif }} Faswil aktif
                </small>

            </div>

        </div>


        {{-- =================================================
             TIKET HARI INI
        ================================================== --}}

        <div class="stat-card">

            <div class="stat-icon orange">

                <i class="fa-solid fa-ticket"></i>

            </div>


            <div class="stat-content">

                <span class="stat-label">
                    Tiket Hari Ini
                </span>


                <strong class="stat-number">
                    {{ $tiketHariIni }}
                </strong>


                <small>

                    <i class="fa-solid fa-arrow-up"></i>

                    Tiket terdaftar hari ini

                </small>

            </div>

        </div>


        {{-- =================================================
             ANTREAN AKTIF
        ================================================== --}}

        <div class="stat-card">

            <div class="stat-icon purple">

                <i class="fa-solid fa-users"></i>

            </div>


            <div class="stat-content">

                <span class="stat-label">
                    Antrean Aktif
                </span>


                <strong class="stat-number">
                    {{ $antreanAktif }}
                </strong>


                <small>
                    Antrean aktif hari ini
                </small>

            </div>

        </div>


        {{-- =================================================
             PETUGAS AKTIF
        ================================================== --}}

        <div class="stat-card">

            <div class="stat-icon green">

                <i class="fa-solid fa-user-check"></i>

            </div>


            <div class="stat-content">

                <span class="stat-label">
                    Petugas Aktif
                </span>


                <strong class="stat-number">
                    {{ $petugasAktif }}
                </strong>


                <small>
                    Petugas aktif
                </small>

            </div>

        </div>


    </section>


    {{-- =====================================================
         STATUS TIKET
    ====================================================== --}}

    <section class="dashboard-section-full">


        <div class="dashboard-card status-card">


            {{-- CARD HEADER --}}

            <div class="card-header">

                <div>

                    <h3>
                        Status Tiket
                    </h3>

                    <p>
                        Kondisi tiket hari ini
                    </p>

                </div>

            </div>


            {{-- STATUS LIST --}}

            <div class="ticket-status-list">


                {{-- MENUNGGU --}}

                <div class="ticket-status-item">

                    <div class="status-name">

                        <span
                            class="status-dot waiting">
                        </span>

                        <span>
                            Menunggu
                        </span>

                    </div>


                    <strong>
                        {{ $statusTiket['menunggu'] ?? 0 }}
                    </strong>

                </div>


                {{-- DIPANGGIL --}}

                <div class="ticket-status-item">

                    <div class="status-name">

                        <span
                            class="status-dot called">
                        </span>

                        <span>
                            Dipanggil
                        </span>

                    </div>


                    <strong>
                        {{ $statusTiket['dipanggil'] ?? 0 }}
                    </strong>

                </div>


                {{-- DILAYANI --}}

                <div class="ticket-status-item">

                    <div class="status-name">

                        <span
                            class="status-dot serving">
                        </span>

                        <span>
                            Dilayani
                        </span>

                    </div>


                    <strong>
                        {{ $statusTiket['dilayani'] ?? 0 }}
                    </strong>

                </div>


                {{-- DILEWATI --}}

                <div class="ticket-status-item">

                    <div class="status-name">

                        <span
                            class="status-dot skipped">
                        </span>

                        <span>
                            Dilewati
                        </span>

                    </div>


                    <strong>
                        {{ $statusTiket['dilewati'] ?? 0 }}
                    </strong>

                </div>


                {{-- SELESAI --}}

                <div class="ticket-status-item">

                    <div class="status-name">

                        <span
                            class="status-dot completed">
                        </span>

                        <span>
                            Selesai
                        </span>

                    </div>


                    <strong>
                        {{ $statusTiket['selesai'] ?? 0 }}
                    </strong>

                </div>


            </div>


            {{-- TOTAL TIKET --}}

            <div class="status-total">

                <span>
                    Total Tiket
                </span>


                <strong>
                    {{ $tiketHariIni }}
                </strong>

            </div>


        </div>

    </section>


    {{-- =====================================================
         MONITOR ANTREAN + STATUS MEJA
    ====================================================== --}}

    <section class="dashboard-grid dashboard-grid-bottom">


        {{-- =================================================
             MONITOR ANTREAN
        ================================================== --}}

        <div class="dashboard-card">


            {{-- CARD HEADER --}}

            <div class="card-header">

                <div>

                    <h3>
                        Monitor Antrean
                    </h3>

                    <p>
                        Kondisi antrean berdasarkan Faswil
                    </p>

                </div>


                <a
                    href="{{ route('admin.monitor.index') }}"
                    class="lihat-semua"
                >

                    Lihat semua

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>


            {{-- QUEUE LIST --}}

            <div class="queue-list">


                @forelse($monitorFaswil as $faswil)


                    <div class="queue-item">


                        <div class="queue-info">


                            <div class="queue-icon">

                                <i class="fa-solid fa-building"></i>

                            </div>


                            <div>

                                <strong>
                                    {{ $faswil->nama_faswil }}
                                </strong>

                            </div>


                        </div>


                        <div class="queue-number">

                            <strong>
                                {{ $faswil->jumlah_menunggu ?? 0 }}
                            </strong>

                            <span>
                                menunggu
                            </span>

                        </div>


                    </div>


                @empty


                    <div class="queue-item">


                        <div class="queue-info">


                            <div class="queue-icon">

                                <i class="fa-solid fa-circle-info"></i>

                            </div>


                            <div>

                                <strong>
                                    Tidak ada antrean
                                </strong>

                            </div>


                        </div>


                        <div class="queue-number">

                            <span>
                                Hari ini
                            </span>

                        </div>


                    </div>


                @endforelse


            </div>

        </div>


        {{-- =================================================
             STATUS MEJA
        ================================================== --}}

        <div class="dashboard-card status-meja-card">


            {{-- CARD HEADER --}}

            <div class="dashboard-card-header">


                <div>

                    <h3>
                        Status Meja
                    </h3>

                    <p>
                        Kondisi meja pelayanan
                    </p>

                </div>


                <a
                    href="{{ route('admin.master.index') }}"
                    class="dashboard-card-link"
                >

                    Lihat semua

                    <i class="fa-solid fa-arrow-right"></i>

                </a>


            </div>


            {{-- STATUS MEJA LIST --}}

            <div class="status-meja-list">


                @forelse($statusMeja as $meja)


                    <div class="status-meja-item">


                        {{-- KODE MEJA --}}

                        <div class="status-meja-code">

                            {{ $meja->kode_meja ?? '-' }}

                        </div>


                        {{-- INFORMASI MEJA --}}

                        <div class="status-meja-info">

                            <strong>

                                {{ $meja->nama_meja }}

                            </strong>


                            <span>

                                {{ $meja->faswil->nama_faswil ?? 'Belum ditempati' }}

                            </span>

                        </div>


                        {{-- STATUS --}}

                        <div class="status-meja-status">


                            @if($meja->status === 'aktif')


                                <span class="status-meja-active">

                                    <i class="fa-solid fa-circle"></i>

                                    Aktif

                                </span>


                            @else


                                <span class="status-meja-inactive">

                                    <i class="fa-solid fa-circle"></i>

                                    Nonaktif

                                </span>


                            @endif


                        </div>


                    </div>


                @empty


                    <div class="status-meja-empty">

                        <i class="fa-solid fa-chair"></i>

                        <span>
                            Belum ada data meja
                        </span>

                    </div>


                @endforelse


            </div>


        </div>


    </section>


</main>


{{-- =====================================================
     CHART JS
====================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    window.ticketChartLabels =
        @json($tanggalGrafik ?? []);

    window.ticketChartData =
        @json($jumlahGrafik ?? []);

</script>


{{-- =====================================================
     DASHBOARD JS
====================================================== --}}

<script src="{{ asset('js/dashboard.js') }}"></script>



{{-- =====================================================
     SCRIPT UTAMA
====================================================== --}}

<script src="{{ asset('js/script.js') }}"></script>


</body>

</html>
