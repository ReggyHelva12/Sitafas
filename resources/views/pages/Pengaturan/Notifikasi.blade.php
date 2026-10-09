<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pengaturan Notifikasi - SITAFAS</title>


    {{-- Google Font --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">


    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- CSS Sidebar --}}
    <link rel="stylesheet"
          href="{{ asset('css/sidebar.css') }}">


    {{-- CSS Notifikasi --}}
    <link rel="stylesheet"
          href="{{ asset('css/setting-notifikasi.css') }}">

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('pages.Layouts.sidebar')


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main-content" id="mainContent">
        {{-- NOTIFIKASI BERHASIL --}}
@if(session('success'))
    <div class="alert-success" id="successAlert">

        <div class="alert-success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="alert-success-content">
            <strong>Berhasil!</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="notification-header">


            {{-- HAMBURGER --}}

            <button
                type="button"
                class="page-menu-button"
                id="sidebarToggle">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- JUDUL --}}

            <div class="notification-title-area">

                <h1>
                    Pengaturan Notifikasi
                </h1>

                <p>
                    Kelola notifikasi yang digunakan dalam sistem SITAFAS
                </p>

            </div>


            {{-- USER --}}

            <div class="notification-header-user">

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
             CARD PENGATURAN
        ================================================== --}}

        <section class="notification-container">


            {{-- CARD HEADER --}}

            <div class="notification-card-header">

                <div>

                    <h2>
                        <i class="fa-solid fa-bell"></i>

                        Notifikasi Sistem
                    </h2>

                    <p>
                        Aktifkan atau nonaktifkan notifikasi
                        yang digunakan dalam sistem.
                    </p>

                </div>

            </div>



            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
    action="{{ route('admin.pengaturan.notifikasi.update') }}"
    method="POST">

    @csrf
    @method('PUT')


    {{-- =====================================================
         NOTIFIKASI TIKET BARU
    ====================================================== --}}

    <div class="notification-row">

        <div class="notification-info">

            <h3>
                Notifikasi Tiket Baru
            </h3>

            <p>
                Memberikan informasi ketika tiket baru dibuat.
            </p>

        </div>


        <label class="notification-switch">

            <input
                type="checkbox"
                name="notifikasi_tiket_baru"
                value="1"
                {{ old(
                    'notifikasi_tiket_baru',
                    $pengaturan->notifikasi_tiket_baru
                ) ? 'checked' : '' }}
            >

            <span class="notification-slider"></span>

        </label>

    </div>



    {{-- =====================================================
         PERUBAHAN STATUS TIKET
    ====================================================== --}}

    <div class="notification-row">

        <div class="notification-info">

            <h3>
                Perubahan Status Tiket
            </h3>

            <p>
                Memberikan informasi ketika status tiket berubah.
            </p>

        </div>


        <label class="notification-switch">

            <input
                type="checkbox"
                name="perubahan_status_tiket"
                value="1"
                {{ old(
                    'perubahan_status_tiket',
                    $pengaturan->perubahan_status_tiket
                ) ? 'checked' : '' }}
            >

            <span class="notification-slider"></span>

        </label>

    </div>



    {{-- =====================================================
         PANGGILAN ANTREAN
    ====================================================== --}}

    <div class="notification-row">

        <div class="notification-info">

            <h3>
                Panggilan Antrean
            </h3>

            <p>
                Memberikan informasi ketika tiket dipanggil.
            </p>

        </div>


        <label class="notification-switch">

            <input
                type="checkbox"
                name="panggilan_antrean"
                value="1"
                {{ old(
                    'panggilan_antrean',
                    $pengaturan->panggilan_antrean
                ) ? 'checked' : '' }}
            >

            <span class="notification-slider"></span>

        </label>

    </div>



    {{-- =====================================================
         ANTREAN SELESAI
    ====================================================== --}}

    <div class="notification-row">

        <div class="notification-info">

            <h3>
                Antrean Selesai
            </h3>

            <p>
                Memberikan informasi ketika pelayanan selesai.
            </p>

        </div>


        <label class="notification-switch">

            <input
                type="checkbox"
                name="antrean_selesai"
                value="1"
                {{ old(
                    'antrean_selesai',
                    $pengaturan->antrean_selesai
                ) ? 'checked' : '' }}
            >

            <span class="notification-slider"></span>

        </label>

    </div>



    {{-- =====================================================
         MEDIA NOTIFIKASI
    ====================================================== --}}

    <div class="media-notification">

        <div class="media-header">

            <div class="media-icon">
                <i class="fa-solid fa-bullhorn"></i>
            </div>

            <div>

                <h3>
                    Media Notifikasi
                </h3>

                <p>
                    Pilih media yang digunakan untuk menyampaikan
                    notifikasi.
                </p>

            </div>

        </div>



        {{-- NOTIFIKASI DALAM SISTEM --}}

        <label class="media-option">

            <input
                type="checkbox"
                name="notifikasi_sistem"
                value="1"
                {{ old(
                    'notifikasi_sistem',
                    $pengaturan->notifikasi_sistem
                ) ? 'checked' : '' }}
            >

            <span>
                Notifikasi dalam sistem
            </span>

        </label>



        {{-- SUARA PANGGILAN --}}

        <label class="media-option">

            <input
                type="checkbox"
                name="suara_panggilan"
                value="1"
                {{ old(
                    'suara_panggilan',
                    $pengaturan->suara_panggilan
                ) ? 'checked' : '' }}
            >

            <span>
                Suara panggilan antrean
            </span>

        </label>



        {{-- EMAIL --}}

        <label class="media-option">

            <input
                type="checkbox"
                name="email"
                value="1"
                {{ old(
                    'email',
                    $pengaturan->email
                ) ? 'checked' : '' }}
            >

            <span>
                Email
            </span>

        </label>

    </div>



    {{-- =====================================================
         BUTTON
    ====================================================== --}}

    <div class="notification-actions">

        <a
            href="{{ route('admin.dashboard') }}"
            class="btn-back">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>


        <button
            type="submit"
            class="btn-save">

            <i class="fa-solid fa-floppy-disk"></i>

            Simpan Pengaturan

        </button>

    </div>

</form>

        </section>

    </main>



    {{-- =====================================================
         JAVASCRIPT
    ====================================================== --}}

    <script src="{{ asset('js/script.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const sidebar = document.getElementById('sidebar');

            const sidebarToggle =
                document.getElementById('sidebarToggle');

            const mainContent =
                document.getElementById('mainContent');


            if (sidebarToggle) {

                sidebarToggle.addEventListener('click', function () {

                    sidebar.classList.toggle('closed');

                    document.body.classList.toggle(
                        'sidebar-closed'
                    );

                });

            }

        });

    </script>


</body>

</html>