<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tiket Berhasil - SITAFAS</title>


    {{-- =====================================================
         FONT
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
         CSS
    ====================================================== --}}
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            font-family: 'Poppins', sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #f4f8ff 0%,
                    #eef5ff 50%,
                    #f8fbff 100%
                );

            min-height: 100vh;

            color: #1e293b;

        }


        /* =====================================================
           CONTAINER
        ====================================================== */

        .success-page {

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 40px 20px;

        }


        .success-container {

            width: 100%;

            max-width: 620px;

        }


        /* =====================================================
           CARD
        ====================================================== */

        .success-card {

            background: #ffffff;

            border-radius: 24px;

            padding: 40px;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, 0.10);

            border: 1px solid #e5e7eb;

            text-align: center;

            position: relative;

            overflow: hidden;

        }


        /* garis atas */

        .success-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 6px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #3b82f6,
                    #60a5fa
                );

        }


        /* =====================================================
           ICON SUCCESS
        ====================================================== */

        .success-icon {

            width: 85px;

            height: 85px;

            margin: 5px auto 20px;

            border-radius: 50%;

            background: #dcfce7;

            display: flex;

            justify-content: center;

            align-items: center;

        }


        .success-icon i {

            font-size: 42px;

            color: #16a34a;

        }


        /* =====================================================
           TITLE
        ====================================================== */

        .success-title {

            font-size: 28px;

            font-weight: 700;

            color: #0f172a;

            margin-bottom: 8px;

        }


        .success-description {

            font-size: 14px;

            color: #64748b;

            line-height: 1.7;

            margin-bottom: 30px;

        }

        /* =====================================================
   STATUS TIKET DINAMIS
===================================================== */

.ticket-status {
    transition:
        all 0.3s ease;
}


/* MENUNGGU */

.ticket-status.status-menunggu {
    background: #fef3c7;
    color: #92400e;
}


/* DIPANGGIL */

.ticket-status.status-dipanggil {
    background: #dbeafe;
    color: #1d4ed8;
}


/* DIPANGGIL ULANG */

.ticket-status.status-dipanggil-ulang {
    background: #ede9fe;
    color: #6d28d9;
}


/* DILEWATI */

.ticket-status.status-dilewati {
    background: #fee2e2;
    color: #b91c1c;
}


/* SELESAI */

.ticket-status.status-selesai {
    background: #dcfce7;
    color: #15803d;
}


        /* =========================================================
   JAM LAYANAN
========================================================= */

.ticket-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    width: 100%;
    padding: 14px 18px;

    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;

    box-sizing: border-box;
}

/* Label sebelah kiri */
.ticket-label {
    font-size: 14px;
    font-weight: 600;
    color: #6b7280;

    white-space: nowrap;
}

/* Nilai jam sebelah kanan */
.ticket-value {
    font-size: 15px;
    font-weight: 700;
    color: #111827;

    text-align: right;
    white-space: nowrap;
}



        /* =====================================================
           TICKET BOX
        ====================================================== */

        .ticket-box {

            background:
                linear-gradient(
                    135deg,
                    #eff6ff,
                    #f8fbff
                );

            border: 2px dashed #93c5fd;

            border-radius: 18px;

            padding: 25px 20px;

            margin-bottom: 25px;

        }


        .ticket-label {

            font-size: 13px;

            font-weight: 500;

            color: #64748b;

            margin-bottom: 8px;

        }


        .ticket-number {

            font-size: 48px;

            line-height: 1;

            font-weight: 800;

            letter-spacing: 4px;

            color: #2563eb;

            margin-bottom: 12px;

        }


        .ticket-main-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            width: 100%;
            margin-bottom: 18px;
        }

        .main-number-box {
            background: #ffffff;
            border: 1px solid #dbe5f0;
            border-radius: 14px;
            padding: 18px 12px;
            min-height: 145px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-number-box .ticket-label {
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .main-number-box .ticket-number {
            margin-bottom: 0;
            font-size: 48px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 3px;
            color: #2563eb;
        }

        .ticket-status {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 14px;

            border-radius: 30px;

            background: #fef3c7;

            color: #92400e;

            font-size: 12px;

            font-weight: 600;

        }


        .ticket-status i {

            font-size: 11px;

        }


        /* =====================================================
           DETAIL TIKET
        ====================================================== */

        .ticket-detail {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 12px;

            margin-top: 20px;

            text-align: left;

        }


        .detail-item {

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 12px;

            padding: 14px;

        }


        .detail-label {

            display: block;

            font-size: 11px;

            color: #64748b;

            margin-bottom: 5px;

        }


        .detail-value {

            display: block;

            font-size: 13px;

            font-weight: 600;

            color: #1e293b;

            line-height: 1.5;

        }


        /* =====================================================
           INFO
        ====================================================== */

        .info-box {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            text-align: left;

            background: #f0f9ff;

            border: 1px solid #bae6fd;

            border-radius: 12px;

            padding: 15px;

            margin-top: 20px;

        }


        .info-box i {

            color: #0284c7;

            font-size: 17px;

            margin-top: 2px;

        }


        .info-box p {

            font-size: 12px;

            line-height: 1.6;

            color: #475569;

        }


        /* =====================================================
           BUTTON
        ====================================================== */

        .button-group {

            display: flex;

            gap: 12px;

            margin-top: 25px;

        }


        .btn {

            flex: 1;

            min-height: 46px;

            border-radius: 10px;

            border: none;

            display: inline-flex;

            justify-content: center;

            align-items: center;

            gap: 8px;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

            transition: all .2s ease;

        }


        .btn-primary {

            background: #2563eb;

            color: white;

        }


        .btn-primary:hover {

            background: #1d4ed8;

            transform: translateY(-1px);

        }


        .btn-secondary {

            background: #f1f5f9;

            color: #334155;

            border: 1px solid #e2e8f0;

        }


        .btn-secondary:hover {

            background: #e2e8f0;

        }


        /* =====================================================
           FOOTER
        ====================================================== */

        .success-footer {

            margin-top: 25px;

            text-align: center;

            font-size: 11px;

            color: #94a3b8;

        }


        .success-footer strong {

            color: #64748b;

        }


        /* =====================================================
           PRINT
        ====================================================== */

        @media print {

            body {

                background: white;

            }


            .success-page {

                padding: 0;

                min-height: auto;

            }


            .success-card {

                box-shadow: none;

                border: none;

                max-width: 100%;

            }


            .button-group,
            .success-footer,
            .info-box {

                display: none;

            }


            .success-card::before {

                display: none;

            }

        }


        /* =====================================================
           TABLET
        ====================================================== */

        @media (max-width: 700px) {

            .success-page {

                padding: 25px 15px;

            }


            .success-card {

                padding: 30px 22px;

                border-radius: 20px;

            }


            .success-title {

                font-size: 24px;

            }


            .ticket-number {

                font-size: 40px;

            }

            .main-number-box .ticket-number {
                font-size: 40px;
            }

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 480px) {

            .success-page {

                padding: 15px;

            }


            .success-card {

                padding: 28px 16px;

            }


            .success-icon {

                width: 70px;

                height: 70px;

            }


            .success-icon i {

                font-size: 34px;

            }


            .success-title {

                font-size: 21px;

            }


            .success-description {

                font-size: 12px;

            }


            .ticket-number {

                font-size: 34px;

                letter-spacing: 3px;

            }

            .ticket-main-info {
                gap: 8px;
            }

            .main-number-box {
                min-height: 115px;
                padding: 14px 8px;
            }

            .main-number-box .ticket-label {
                font-size: 11px;
            }

            .main-number-box .ticket-number {
                font-size: 32px;
                letter-spacing: 2px;
            }


            .ticket-detail {

                grid-template-columns: 1fr;

            }


            .button-group {

                flex-direction: column;

            }

        }

        /* =========================================================
   RESPONSIVE MOBILE
========================================================= */

@media (max-width: 576px) {

    .ticket-item {
        padding: 12px 14px;
        gap: 10px;
    }

    .ticket-label {
        font-size: 13px;
    }

    .ticket-value {
        font-size: 14px;
    }
}

    </style>

</head>


<body>


<div class="success-page">

    <div class="success-container">

        <div class="success-card">


            {{-- =================================================
                 ICON
            ================================================== --}}

            <div class="success-icon">

                <i class="fa-solid fa-check"></i>

            </div>


            {{-- =================================================
                 TITLE
            ================================================== --}}

            <h1 class="success-title">

                Registrasi Berhasil

            </h1>


            <p class="success-description">

                Data registrasi Anda berhasil disimpan.
                Berikut adalah nomor tiket antrean Anda.

            </p>


            {{-- =================================================
                 TICKET
            ================================================== --}}

            @if(isset($tiket) && $tiket)

                <div class="ticket-box">

                    <div class="ticket-main-info">

                        <div class="main-number-box">
                            <div class="ticket-label">
                                NOMOR ANTRIAN
                            </div>

                            <div class="ticket-number">
                                {{ preg_replace('/^[A-Za-z]+-/', '', $tiket->nomor_tiket) }}
                            </div>
                        </div>

                        <div class="main-number-box">
                            <div class="ticket-label">
                                MEJA
                            </div>

                            <div class="ticket-number">
                                {{ $registrasi->master->no_meja ?? '-' }}
                            </div>
                        </div>

                    </div>


                    <div
    id="ticketStatus"
    class="ticket-status status-menunggu"
>

    <i
        id="ticketStatusIcon"
        class="fa-solid fa-clock"
    ></i>

    <span id="ticketStatusText">
        Menunggu Dipanggil
    </span>

</div>


                    {{-- =================================================
                         DETAIL
                    ================================================== --}}

                    <div class="ticket-detail">


                        <div class="detail-item">

                            <span class="detail-label">
                                Perguruan Tinggi
                            </span>

                            <span class="detail-value">

                                {{ $registrasi->master->nama_pt ?? '-' }}

                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Kode PT
                            </span>

                            <span class="detail-value">

                                {{ $registrasi->master->kode_pt ?? '-' }}

                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Faswil
                            </span>

                            <span class="detail-value">

                                {{ $registrasi->master->nama_faswil ?? '-' }}

                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Sesi
                            </span>

                            <span class="detail-value">

                                {{ $registrasi->master->sesi ?? '-' }}

                            </span>

                        </div>


                        {{-- JAM LAYANAN --}}
<div class="detail-item">

    <div class="detail-label">
        Jam Layanan
    </div>

    <div class="detail-value">

        @if(
            $master &&
            $master->jam_mulai &&
            $master->jam_selesai
        )

            {{ substr($master->jam_mulai, 0, 5) }}
            -
            {{ substr($master->jam_selesai, 0, 5) }}
            WIB

        @else

            -

        @endif

    </div>

</div>


                        <div class="detail-item">

                            <span class="detail-label">
                                 Waktu Daftar
                            </span>

                            <span class="detail-value">

                                 {{ $tiket->waktu_daftar
                                    ? $tiket->waktu_daftar->format('d-m-Y H:i')
                                    : '-' }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     INFO
                ================================================== --}}

                <div class="info-box">

                    <i class="fa-solid fa-circle-info"></i>

                    <p>

                        Simpan nomor antrian dan nomor meja Anda.
                        Nomor tiket dapat digunakan untuk memantau
                        status antrean.

                    </p>

                </div>


                {{-- =================================================
                     BUTTON
                ================================================== --}}

                <div class="button-group">


                    {{-- CETAK TIKET --}}

                    <button type="button"
                            class="btn btn-primary"
                            onclick="window.print()">

                        <i class="fa-solid fa-print"></i>

                        Cetak Tiket

                    </button>


                    {{-- KEMBALI --}}

                    <a href="{{ route('registrasi.create') }}"
                       class="btn btn-secondary">

                        <i class="fa-solid fa-arrow-left"></i>

                        Kembali

                    </a>


                </div>


            @else

                {{-- =================================================
                     JIKA TIKET TIDAK ADA
                ================================================== --}}

                <div class="info-box">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <p>

                        Registrasi berhasil disimpan,
                        tetapi data tiket belum ditemukan.

                        Silakan kembali ke halaman registrasi
                        atau hubungi petugas.

                    </p>

                </div>


                <div class="button-group">

                    <a href="{{ route('registrasi.create') }}"
                       class="btn btn-primary">

                        <i class="fa-solid fa-arrow-left"></i>

                        Kembali ke Registrasi

                    </a>

                </div>

            @endif


        </div>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="success-footer">

            <strong>SITAFAS</strong>
            — Sistem Ticketing dan Antrean Faswil

        </div>

    </div>

</div>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /* =====================================================
           ELEMENT STATUS
        ===================================================== */

        const statusElement =
            document.getElementById(
                'ticketStatus'
            );

        const statusIcon =
            document.getElementById(
                'ticketStatusIcon'
            );

        const statusText =
            document.getElementById(
                'ticketStatusText'
            );


        /*
        |--------------------------------------------------------------------------
        | ID TIKET
        |--------------------------------------------------------------------------
        */

        const ticketId =
            @json(
                isset($tiket)
                    ? $tiket->id_tiket
                    : null
            );


        /*
        |--------------------------------------------------------------------------
        | NOMOR TIKET
        |--------------------------------------------------------------------------
        */

        const nomorTiket =
            @json(
                isset($tiket)
                    ? $tiket->nomor_tiket
                    : null
            );


        /*
        |--------------------------------------------------------------------------
        | JIKA TIKET TIDAK ADA
        |--------------------------------------------------------------------------
        */

        if (
            !ticketId ||
            !statusElement
        ) {

            return;

        }


        console.log(
            'SITAFAS monitoring tiket:',
            nomorTiket
        );


        /* =====================================================
           UPDATE TAMPILAN STATUS
        ===================================================== */

        function updateTicketStatus(
            status,
            action
        ) {

            /*
            |--------------------------------------------------------------------------
            | RESET CLASS
            |--------------------------------------------------------------------------
            */

            statusElement.classList.remove(
                'status-menunggu',
                'status-dipanggil',
                'status-dipanggil-ulang',
                'status-dilewati',
                'status-selesai'
            );


            /*
            |--------------------------------------------------------------------------
            | MENUNGGU
            |--------------------------------------------------------------------------
            */

            if (
                status === 'menunggu'
            ) {

                statusElement.classList.add(
                    'status-menunggu'
                );


                statusIcon.className =
                    'fa-solid fa-clock';


                statusText.textContent =
                    'Menunggu Dipanggil';


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | PANGGIL
            |--------------------------------------------------------------------------
            */

            if (
                action === 'dipanggil'
            ) {

                statusElement.classList.add(
                    'status-dipanggil'
                );


                statusIcon.className =
                    'fa-solid fa-bullhorn';


                statusText.textContent =
                    'Sedang Dipanggil';


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | PANGGIL ULANG
            |--------------------------------------------------------------------------
            */

            if (
                action === 'dipanggil_ulang'
            ) {

                statusElement.classList.add(
                    'status-dipanggil-ulang'
                );


                statusIcon.className =
                    'fa-solid fa-volume-high';


                statusText.textContent =
                    'Dipanggil Ulang';


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | DILEWATI
            |--------------------------------------------------------------------------
            */

            if (
                status === 'dilewati' ||
                action === 'dilewati'
            ) {

                statusElement.classList.add(
                    'status-dilewati'
                );


                statusIcon.className =
                    'fa-solid fa-forward';


                statusText.textContent =
                    'Antrean Dilewati';


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | SELESAI
            |--------------------------------------------------------------------------
            */

            if (
                status === 'selesai' ||
                action === 'selesai'
            ) {

                statusElement.classList.add(
                    'status-selesai'
                );


                statusIcon.className =
                    'fa-solid fa-circle-check';


                statusText.textContent =
                    'Layanan Selesai';


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | FALLBACK
            |--------------------------------------------------------------------------
            */

            if (
                status === 'dilayani'
            ) {

                statusElement.classList.add(
                    'status-dipanggil'
                );


                statusIcon.className =
                    'fa-solid fa-user-check';


                statusText.textContent =
                    'Sedang Dilayani';

            }

        }


        /* =====================================================
           CEK STATUS DARI SERVER
        ===================================================== */

        async function checkTicketStatus() {

            try {

                const response =
                    await fetch(

                        "{{ route('registrasi.checkStatus') }}" +
                        "?nomor_tiket=" +
                        encodeURIComponent(
                            nomorTiket
                        ) +
                        "&_=" +
                        Date.now(),

                        {
                            method: 'GET',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            cache:
                                'no-store'

                        }

                    );


                /*
                |--------------------------------------------------------------------------
                | RESPONSE ERROR
                |--------------------------------------------------------------------------
                */

                if (
                    !response.ok
                ) {

                    console.warn(
                        'Gagal mengambil status tiket.'
                    );

                    return;

                }


                const data =
                    await response.json();


                /*
                |--------------------------------------------------------------------------
                | DATA TIDAK VALID
                |--------------------------------------------------------------------------
                */

                if (
                    !data ||
                    !data.success
                ) {

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE STATUS
                |--------------------------------------------------------------------------
                */

                updateTicketStatus(

                    data.status,

                    data.aksi_terakhir

                );


                console.log(
                    'Status tiket:',
                    data.status,
                    'Aksi:',
                    data.aksi_terakhir
                );


            } catch (error) {

                console.error(
                    'Error monitoring tiket:',
                    error
                );

            }

        }


        /* =====================================================
           CEK PERTAMA
        ===================================================== */

        checkTicketStatus();


        /* =====================================================
           CEK SETIAP 1 DETIK
        ===================================================== */

        setInterval(
            checkTicketStatus,
            1000
        );

    });

</script>


</body>

</html>