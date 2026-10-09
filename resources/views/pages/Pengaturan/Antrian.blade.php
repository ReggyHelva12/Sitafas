<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pengaturan Antrean - SITAFAS</title>


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    {{-- =====================================================
         CSS SIDEBAR
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/sidebar.css') }}"
    >


    {{-- =====================================================
         CSS PENGATURAN ANTREAN
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/setting-antrian.css') }}"
    >


    {{-- =====================================================
         STYLE TAMBAHAN
    ====================================================== --}}

    <style>

        /* =====================================================
           DURASI LAYANAN
        ===================================================== */

        .duration-input-wrapper {

            position: relative;

            display: flex;

            align-items: center;

        }


        .duration-input-wrapper input {

            width: 100%;

            padding-right: 75px;

        }


        .duration-unit {

            position: absolute;

            right: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #777;

            font-size: 14px;

            font-weight: 600;

            pointer-events: none;

        }


        .duration-preview {

            margin-top: 20px;

            padding: 18px 20px;

            border-radius: 12px;

            background: #f5f8fc;

            border: 1px solid #e4eaf1;

            display: flex;

            align-items: center;

            gap: 15px;

        }


        .duration-preview-icon {

            width: 45px;

            height: 45px;

            border-radius: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #e8f4ff;

            color: #168acb;

            font-size: 19px;

        }


        .duration-preview-content {

            display: flex;

            flex-direction: column;

            gap: 4px;

        }


        .duration-preview-content strong {

            font-size: 15px;

        }


        .duration-preview-content span {

            color: #718096;

            font-size: 14px;

        }


        /* =====================================================
           INFO KODE FASWIL
        ===================================================== */

        .faswil-format-info {

            margin-top: 18px;

            padding: 18px 20px;

            border-radius: 12px;

            background: #f0f8fc;

            border: 1px solid #d9edf7;

            display: flex;

            align-items: flex-start;

            gap: 14px;

        }


        .faswil-format-info .info-icon {

            width: 42px;

            height: 42px;

            min-width: 42px;

            border-radius: 10px;

            background: #e1f3fb;

            color: #168acb;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

        }


        .faswil-format-info strong {

            display: block;

            margin-bottom: 5px;

            color: #16445c;

        }


        .faswil-format-info p {

            margin: 0;

            color: #718096;

            line-height: 1.6;

            font-size: 14px;

        }


        /* =====================================================
           CONTOH FORMAT
        ===================================================== */

        .format-example-list {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-top: 12px;

        }


        .format-example-item {

            padding: 8px 13px;

            border-radius: 8px;

            background: #ffffff;

            border: 1px solid #dce8ef;

            color: #168acb;

            font-weight: 700;

            font-size: 14px;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 768px) {

            .duration-preview {

                align-items: flex-start;

            }


            .faswil-format-info {

                flex-direction: column;

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
     MAIN CONTENT
====================================================== --}}

<main class="antrian-page user-content">


    {{-- =================================================
         HEADER
    ================================================== --}}

    <div class="page-header">


        <div class="page-title-wrapper">


            {{-- HAMBURGER --}}

            <button
                type="button"
                class="menu-toggle"
                id="menuToggle"
                aria-label="Buka atau tutup sidebar"
            >

                <i class="fa-solid fa-bars"></i>

            </button>



            {{-- TITLE --}}

            <div>

                <h1>
                    Pengaturan Antrean
                </h1>

                <p>
                    Atur konfigurasi sistem antrean SITAFAS.
                </p>

            </div>


        </div>


    </div>



    {{-- =================================================
         SUCCESS ALERT
    ================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success"
            id="successAlert"
        >

            <div class="alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>


            <div class="alert-content">

                <strong>
                    Berhasil
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>


            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

    @endif



    {{-- =================================================
         ERROR ALERT
    ================================================== --}}

    @if(session('error'))

        <div class="alert alert-error">

            <div class="alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>


            <div class="alert-content">

                <strong>
                    Gagal
                </strong>

                <span>
                    {{ session('error') }}
                </span>

            </div>


            <button
                type="button"
                class="alert-close"
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

        <div class="alert alert-error">

            <div class="alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>


            <div class="alert-content">

                <strong>
                    Periksa kembali data
                </strong>


                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>


            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

    @endif



    {{-- =================================================
         FORM
    ================================================== --}}

    <form
        action="{{ route('admin.pengaturan.antrian.update') }}"
        method="POST"
        id="antrianForm"
    >

        @csrf

        @method('PUT')



        {{-- =================================================
             FORMAT NOMOR ANTREAN
        ================================================== --}}

        <section class="setting-card">


            <div class="setting-card-header">


                <div class="setting-card-icon">

                    <i class="fa-solid fa-ticket"></i>

                </div>


                <div>

                    <h2>
                        Format Nomor Antrean
                    </h2>

                    <p>
                        Atur jumlah digit nomor antrean yang
                        digunakan pada sistem SITAFAS.
                    </p>

                </div>


            </div>



            <div class="setting-card-body">


                {{-- =========================================
                     PANJANG NOMOR
                ========================================== --}}

                <div class="form-group">

                    <label for="panjang_nomor">

                        Panjang Nomor

                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">

                            <i class="fa-solid fa-hashtag"></i>

                        </span>


                        <input
                            type="number"
                            id="panjang_nomor"
                            name="panjang_nomor"
                            value="{{ old('panjang_nomor', $pengaturan->panjang_nomor ?? 3) }}"
                            min="1"
                            max="6"
                            placeholder="3"
                            required
                        >

                    </div>


                    <small>

                        Menentukan jumlah digit nomor antrean.
                        Contoh 3 menghasilkan 001, 002, 003.

                    </small>

                </div>



                {{-- =========================================
                     INFORMASI PREFIX FASWIL
                ========================================== --}}

                <div class="faswil-format-info">

                    <div class="info-icon">

                        <i class="fa-solid fa-building-columns"></i>

                    </div>


                    <div>

                        <strong>
                            Nomor antrean berdasarkan Faswil
                        </strong>

                        <p>

                            Prefix nomor tiket tidak diatur
                            secara global. Sistem akan mengambil
                            kode Faswil secara otomatis saat
                            membuat tiket.

                        </p>


                        <div class="format-example-list">

                            <span class="format-example-item">
                                VNG-001
                            </span>

                            <span class="format-example-item">
                                SUS-001
                            </span>

                            <span class="format-example-item">
                                LUT-001
                            </span>

                            <span class="format-example-item">
                                CYN-001
                            </span>

                        </div>

                    </div>

                </div>


            </div>

        </section>



        {{-- =================================================
             PREVIEW NOMOR ANTREAN
        ================================================== --}}

        <section class="setting-card">


            <div class="setting-card-header">


                <div class="setting-card-icon">

                    <i class="fa-solid fa-eye"></i>

                </div>


                <div>

                    <h2>
                        Preview Nomor Antrean
                    </h2>

                    <p>
                        Contoh tampilan nomor antrean
                        berdasarkan konfigurasi yang dipilih.
                    </p>

                </div>


            </div>



            <div class="preview-container">


                <div class="queue-preview-label">

                    CONTOH NOMOR ANTREAN

                </div>


                <div
                    class="queue-number"
                    id="queuePreview"
                >

                    VNG-{{ str_pad(
                        '1',
                        $pengaturan->panjang_nomor ?? 3,
                        '0',
                        STR_PAD_LEFT
                    ) }}

                </div>


                <div class="queue-preview-description">

                    Prefix seperti VNG, SUS, LUT, dan lainnya
                    akan mengikuti Faswil masing-masing.

                </div>


            </div>

        </section>



        {{-- =================================================
             RESET ANTREAN
        ================================================== --}}

        <section class="setting-card">


            <div class="setting-card-header">


                <div class="setting-card-icon">

                    <i class="fa-solid fa-rotate"></i>

                </div>


                <div>

                    <h2>
                        Reset Antrean
                    </h2>

                    <p>
                        Tentukan perilaku nomor antrean
                        ketika memasuki hari baru.
                    </p>

                </div>


            </div>



            <div class="setting-card-body">


                <div class="toggle-setting">


                    <div class="toggle-info">

                        <strong>
                            Reset Nomor Setiap Hari
                        </strong>

                        <span>
                            Nomor antrean setiap Faswil akan
                            kembali ke nomor awal pada hari baru.
                        </span>

                    </div>



                    {{-- SWITCH --}}

                    <label class="switch">

                        <input
                            type="checkbox"
                            name="reset_harian"
                            value="1"
                            {{ old(
                                'reset_harian',
                                $pengaturan->reset_harian ?? 0
                            ) ? 'checked' : '' }}
                        >

                        <span class="slider"></span>

                    </label>


                </div>


            </div>

        </section>



        {{-- =================================================
             DURASI LAYANAN / TIMER
        ================================================== --}}

        <section class="setting-card">


            <div class="setting-card-header">


                <div class="setting-card-icon">

                    <i class="fa-solid fa-stopwatch"></i>

                </div>


                <div>

                    <h2>
                        Durasi Layanan
                    </h2>

                    <p>
                        Atur waktu pelayanan untuk setiap
                        antrean yang sedang dilayani petugas.
                    </p>

                </div>


            </div>



            <div class="setting-card-body">


                <div class="form-group">


                    <label for="durasi_layanan">

                        Durasi Layanan

                    </label>


                    <div class="duration-input-wrapper">


                        <input
                            type="number"
                            id="durasi_layanan"
                            name="durasi_layanan"
                            value="{{ old(
                                'durasi_layanan',
                                $pengaturan->durasi_layanan ?? 15
                            ) }}"
                            min="1"
                            max="180"
                            required
                        >


                        <span class="duration-unit">

                            menit

                        </span>


                    </div>


                    <small>

                        Waktu ini menjadi durasi awal timer
                        ketika petugas memanggil antrean.

                    </small>



                    {{-- PREVIEW DURASI --}}

                    <div class="duration-preview">


                        <div class="duration-preview-icon">

                            <i class="fa-solid fa-stopwatch"></i>

                        </div>


                        <div class="duration-preview-content">

                            <strong>
                                Durasi Timer Saat Ini
                            </strong>


                            <span id="durationInfo">

                                {{ $pengaturan->durasi_layanan ?? 15 }}
                                menit

                            </span>

                        </div>


                    </div>


                </div>


            </div>

        </section>



        {{-- =================================================
             INFORMASI SISTEM
        ================================================== --}}

        <section class="setting-card">


            <div class="setting-card-header">


                <div class="setting-card-icon">

                    <i class="fa-solid fa-list-ol"></i>

                </div>


                <div>

                    <h2>
                        Informasi Antrean
                    </h2>

                    <p>
                        Informasi konfigurasi sistem antrean.
                    </p>

                </div>


            </div>



            <div class="setting-card-body">


                <div class="info-setting">


                    <div class="info-setting-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>


                        <strong>
                            Sistem Antrean SITAFAS
                        </strong>


                        <p>

                            Nomor antrean dibuat otomatis
                            berdasarkan kode Faswil masing-masing.

                            Contoh:

                            <strong>
                                VNG-001
                            </strong>,

                            <strong>
                                SUS-001
                            </strong>,

                            <strong>
                                LUT-001
                            </strong>.

                        </p>


                        <p>

                            <strong>
                                Panjang nomor:
                            </strong>

                            <span id="formatInfo">

                                {{ $pengaturan->panjang_nomor ?? 3 }}
                                digit

                            </span>

                        </p>


                        <p>

                            <strong>
                                Reset harian:
                            </strong>

                            <span id="resetInfo">

                                {{
                                    ($pengaturan->reset_harian ?? 0)
                                    ? 'Aktif'
                                    : 'Tidak aktif'
                                }}

                            </span>

                        </p>


                        <p>

                            <strong>
                                Durasi layanan:
                            </strong>

                            <span id="durationInfoSystem">

                                {{ $pengaturan->durasi_layanan ?? 15 }}
                                menit

                            </span>

                        </p>


                    </div>


                </div>


            </div>

        </section>



        {{-- =================================================
             ACTION
        ================================================== --}}

        <div class="form-actions">


            <button
                type="reset"
                class="btn-secondary"
                id="resetForm"
            >

                <i class="fa-solid fa-rotate-left"></i>

                Reset

            </button>



            <button
                type="submit"
                class="btn-primary"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Pengaturan

            </button>


        </div>


    </form>


</main>



{{-- =====================================================
     JAVASCRIPT GLOBAL
====================================================== --}}

<script src="{{ asset('js/script.js') }}"></script>



{{-- =====================================================
     JAVASCRIPT PREVIEW PENGATURAN
====================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =================================================
           ELEMENT
        ================================================== */

        const panjangInput =
            document.getElementById(
                'panjang_nomor'
            );


        const queuePreview =
            document.getElementById(
                'queuePreview'
            );


        const formatInfo =
            document.getElementById(
                'formatInfo'
            );


        const resetInfo =
            document.getElementById(
                'resetInfo'
            );


        const resetCheckbox =
            document.querySelector(
                'input[name="reset_harian"]'
            );


        const resetForm =
            document.getElementById(
                'resetForm'
            );


        const durationInput =
            document.getElementById(
                'durasi_layanan'
            );


        const durationInfo =
            document.getElementById(
                'durationInfo'
            );


        const durationInfoSystem =
            document.getElementById(
                'durationInfoSystem'
            );



        /* =================================================
           UPDATE PREVIEW NOMOR
        ================================================== */

        function updatePreview() {


            if (!panjangInput) {

                return;

            }


            let panjang =
                parseInt(
                    panjangInput.value,
                    10
                );


            if (
                isNaN(panjang) ||
                panjang < 1
            ) {

                panjang = 3;

            }


            if (panjang > 6) {

                panjang = 6;

            }


            const nomor =
                String(1).padStart(
                    panjang,
                    '0'
                );


            /*
             * Prefix hanya contoh.
             * Prefix sebenarnya berasal dari Faswil.
             */

            const hasil =
                'VNG-' + nomor;


            if (queuePreview) {

                queuePreview.textContent =
                    hasil;

            }


            if (formatInfo) {

                formatInfo.textContent =
                    panjang + ' digit';

            }

        }



        /* =================================================
           UPDATE RESET INFO
        ================================================== */

        function updateResetInfo() {


            if (
                !resetCheckbox ||
                !resetInfo
            ) {

                return;

            }


            if (resetCheckbox.checked) {

                resetInfo.textContent =
                    'Aktif';

            } else {

                resetInfo.textContent =
                    'Tidak aktif';

            }

        }



        /* =================================================
           UPDATE DURASI
        ================================================== */

        function updateDurationInfo() {


            if (!durationInput) {

                return;

            }


            let duration =
                parseInt(
                    durationInput.value,
                    10
                );


            if (
                isNaN(duration) ||
                duration < 1
            ) {

                duration = 15;

            }


            if (duration > 180) {

                duration = 180;

            }


            if (durationInfo) {

                durationInfo.textContent =
                    duration + ' menit';

            }


            if (durationInfoSystem) {

                durationInfoSystem.textContent =
                    duration + ' menit';

            }

        }



        /* =================================================
           EVENT PANJANG NOMOR
        ================================================== */

        if (panjangInput) {


            panjangInput.addEventListener(
                'input',
                updatePreview
            );


            panjangInput.addEventListener(
                'change',
                updatePreview
            );

        }



        /* =================================================
           EVENT RESET HARIAN
        ================================================== */

        if (resetCheckbox) {


            resetCheckbox.addEventListener(
                'change',
                updateResetInfo
            );

        }



        /* =================================================
           EVENT DURASI
        ================================================== */

        if (durationInput) {


            durationInput.addEventListener(
                'input',
                updateDurationInfo
            );


            durationInput.addEventListener(
                'change',
                updateDurationInfo
            );

        }



        /* =================================================
           RESET FORM
        ================================================== */

        if (resetForm) {


            resetForm.addEventListener(
                'click',
                function () {


                    setTimeout(
                        function () {

                            updatePreview();

                            updateResetInfo();

                            updateDurationInfo();

                        },
                        50
                    );

                }
            );

        }



        /* =================================================
           INITIAL
        ================================================== */

        updatePreview();

        updateResetInfo();

        updateDurationInfo();


    }
);

</script>


</body>

</html>