{{-- resources/views/registrasi.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi Layanan - SITAFAS</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 14px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f7fb;
            color: #123f67;
            min-height: 100vh;
        }

        .ticket-print-btn {
    width: 100%;
    height: 45px;
    margin-top: 18px;

    border: none;
    border-radius: 9px;

    background: #ffffff;
    color: #123f73;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    font-size: 13px;
    font-weight: 700;

    cursor: pointer;
    text-decoration: none;

    transition: 0.2s ease;
}

.ticket-print-btn:hover {
    background: #eef5fb;
}

        /* =========================================================
           HEADER SISTEM
        ========================================================= */

        .system-header {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #dce8f1;
            box-shadow: 0 2px 8px rgba(0, 50, 90, 0.05);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            min-height: 76px;
            padding: 12px 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .system-brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .logo-wrapper {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .logo-wrapper img {
            max-width: 120%;
            max-height: 120%;
            object-fit: contain;
        }

        .logo-fallback {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;
            background: #0d6e9f;
            color: white;

            font-size: 20px;
            font-weight: 800;
        }

        .system-info {
            line-height: 1.25;
        }

        .system-name {
            font-size: 25px;
            font-weight: 800;
            color: #124a78;
            letter-spacing: 0.2px;
        }

        .system-subtitle {
            margin-top: 3px;
            font-size: 15px;
            color: #7190a8;
            font-weight: 500;
        }

        .header-right {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
}

.header-logo {
    height: 55px;
    width: auto;
    object-fit: contain;
    display: block;
}

.lldikti-logo {
    max-width: 130px;
}

.kemdiktisaintek-logo {
    max-width: 150px;
}

        .header-badge {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 9px 14px;
            border-radius: 25px;

            background: #eaf6fb;
            color: #117ca7;

            font-size: 11px;
            font-weight: 600;
        }

        .header-badge i {
            font-size: 12px;
        }

        /* =========================================================
           MAIN CONTAINER
        ========================================================= */

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 28px 30px 40px;
        }

        /* =========================================================
           PAGE TITLE
        ========================================================= */

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 30px;

            margin-bottom: 25px;
        }

        .heading-left h1 {
            color: #124a78;
            font-size: 34px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.6px;
        }

        .heading-left p {
            margin-top: 7px;
            color: #7895ad;
            font-size: 14px;
            line-height: 1.5;
        }

        .service-status {
            flex-shrink: 0;

            display: flex;
            align-items: center;
            gap: 9px;

            background: #08a77e;
            color: white;

            padding: 12px 20px;
            border-radius: 28px;

            font-size: 13px;
            font-weight: 600;

            box-shadow: 0 5px 15px rgba(8, 167, 126, 0.15);
        }

        .service-status .status-dot {
            width: 9px;
            height: 9px;
            background: #6ff0cb;
            border-radius: 50%;
        }

        /* =========================================================
           GRID
        ========================================================= */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, 0.9fr);
            gap: 24px;
            align-items: start;
        }

        /* =========================================================
           CARD
        ========================================================= */

        .card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e4edf4;
            box-shadow: 0 8px 25px rgba(27, 74, 105, 0.07);
            overflow: hidden;
        }

        .card-header {
            padding: 25px 28px;
            border-bottom: 1px solid #e5edf3;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .card-title-icon {
            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;
            background: #eaf6fb;
            color: #1085b1;

            font-size: 16px;
        }

        .card-title h2 {
            font-size: 21px;
            color: #124a78;
            font-weight: 700;
        }

        .card-header p {
            margin-top: 5px;
            margin-left: 47px;

            font-size: 12px;
            color: #7895ad;
        }

        .card-body {
            padding: 25px 28px 28px;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 7px;

            color: #124a78;
            font-size: 13px;
            font-weight: 700;
        }

        .required {
            color: #df4b58;
        }

        .select-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            height: 48px;

            padding: 0 14px;

            border: 1px solid #cfdeea;
            border-radius: 11px;

            background: #ffffff;
            color: #174d78;

            font-family: 'Poppins', sans-serif;
            font-size: 13px;

            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #1592c0;
            box-shadow: 0 0 0 3px rgba(21, 146, 192, 0.09);
        }

        select.form-control {
            cursor: pointer;
            appearance: auto;
        }

        .form-help {
            margin-top: 6px;

            color: #809bb0;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================================================
           INFO JADWAL
        ========================================================= */

        .schedule-box {
            margin-top: 8px;
            padding: 20px;

            background: #f2f8fc;
            border: 1px solid #dcecf5;
            border-radius: 15px;
        }

        .schedule-title {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 15px;

            color: #124a78;
            font-size: 15px;
            font-weight: 700;
        }

        .schedule-title i {
            color: #1491ba;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .schedule-item {
            min-height: 70px;

            padding: 12px 14px;

            background: #ffffff;
            border: 1px solid #dbe8f0;
            border-radius: 10px;
        }

        .schedule-label {
            margin-bottom: 4px;

            color: #7895ad;
            font-size: 10px;
            font-weight: 500;
        }

        .schedule-value {
            color: #124a78;
            font-size: 12px;
            line-height: 1.45;
            font-weight: 700;
        }

        .schedule-value.large {
            font-size: 14px;
        }

        /* =========================================================
           KEBUTUHAN
        ========================================================= */

        textarea.form-control {
            height: 90px;
            padding: 12px 14px;
            resize: vertical;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-submit {
            width: 100%;
            height: 48px;

            margin-top: 5px;

            border: none;
            border-radius: 11px;

            background: #1188b4;
            color: white;

            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background: #0e759c;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(17, 136, 180, 0.18);
        }

        /* =========================================================
           TRACK TICKET
        ========================================================= */

        .track-box {
            padding: 20px;

            background: #f5f9fc;
            border: 1px solid #dce8f0;
            border-radius: 15px;
        }

        .track-label {
            display: block;
            margin-bottom: 8px;

            color: #124a78;
            font-size: 13px;
            font-weight: 700;
        }

        .track-form {
            display: flex;
            gap: 8px;
        }

        .track-input {
            flex: 1;
            min-width: 0;

            height: 46px;
            padding: 0 13px;

            border: 1px solid #d0dfe9;
            border-radius: 10px;

            background: white;
            outline: none;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;
        }

        .track-input:focus {
            border-color: #1592c0;
        }

        .btn-track {
            height: 46px;
            padding: 0 17px;

            border: none;
            border-radius: 10px;

            background: #1594c1;
            color: white;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            display: flex;
            align-items: center;
            gap: 7px;
        }


        /* =========================================================
   POPUP AKSI TIKET
========================================================= */

.ticket-action-overlay {
    position: fixed;
    inset: 0;

    width: 100%;
    height: 100%;

    background: rgba(8, 35, 55, 0.72);

    display: flex;
    align-items: center;
    justify-content: center;

    z-index: 99999;

    opacity: 0;
    visibility: hidden;

    transition:
        opacity 0.3s ease,
        visibility 0.3s ease;

    backdrop-filter: blur(5px);
}


/* POPUP AKTIF */

.ticket-action-overlay.show {
    opacity: 1;
    visibility: visible;
}


/* =========================================================
   BOX POPUP
========================================================= */

.ticket-action-popup {
    position: relative;

    width: min(560px, calc(100% - 40px));

    background: #ffffff;

    border-radius: 28px;

    padding: 45px 40px 40px;

    text-align: center;

    box-shadow:
        0 30px 80px rgba(0, 0, 0, 0.30);

    transform: translateY(25px) scale(0.95);

    transition: transform 0.3s ease;
}


.ticket-action-overlay.show .ticket-action-popup {

    transform:
        translateY(0)
        scale(1);
}


/* =========================================================
   TOMBOL CLOSE
========================================================= */

.ticket-action-close {

    position: absolute;

    top: 18px;
    right: 20px;

    width: 42px;
    height: 42px;

    border: none;

    border-radius: 50%;

    background: #f1f5f9;

    color: #64748b;

    font-size: 30px;

    line-height: 35px;

    cursor: pointer;

    transition: all 0.2s ease;
}


.ticket-action-close:hover {

    background: #e2e8f0;

    color: #0f172a;

    transform: rotate(90deg);
}


/* =========================================================
   ICON
========================================================= */

.ticket-action-icon {

    width: 105px;
    height: 105px;

    margin: 0 auto 25px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #e8f7fc;

    color: #1493bd;

    font-size: 48px;

    animation: ticketIconPulse 1.5s infinite;
}


.ticket-action-icon i {

    font-size: 48px;
}


/* =========================================================
   ANIMASI ICON
========================================================= */

@keyframes ticketIconPulse {

    0% {
        transform: scale(1);
        box-shadow:
            0 0 0 0 rgba(20, 147, 189, 0.35);
    }

    70% {
        transform: scale(1.05);
        box-shadow:
            0 0 0 18px rgba(20, 147, 189, 0);
    }

    100% {
        transform: scale(1);
        box-shadow:
            0 0 0 0 rgba(20, 147, 189, 0);
    }
}


/* =========================================================
   TITLE
========================================================= */

.ticket-action-title h2 {

    margin: 0 0 20px;

    color: #084f78;

    font-size: 30px;

    font-weight: 800;

    line-height: 1.3;
}


/* =========================================================
   NOMOR TIKET
========================================================= */

.ticket-action-ticket {

    margin: 0 auto 20px;

    padding: 18px 25px;

    background: #f0f9fd;

    border: 2px solid #d5edf6;

    border-radius: 18px;

    width: fit-content;

    min-width: 230px;
}


.ticket-action-ticket span {

    display: block;

    color: #7192a5;

    font-size: 14px;

    margin-bottom: 5px;
}


.ticket-action-ticket strong {

    display: block;

    color: #078fbe;

    font-size: 38px;

    font-weight: 900;

    letter-spacing: 2px;
}


/* =========================================================
   PESAN
========================================================= */

.ticket-action-message {

    margin: 20px auto;

    max-width: 450px;

    color: #456276;

    font-size: 18px;

    line-height: 1.6;
}


/* =========================================================
   WAKTU
========================================================= */

.ticket-action-time {

    margin-bottom: 25px;

    color: #94a3b8;

    font-size: 14px;
}


/* =========================================================
   BUTTON
========================================================= */

.ticket-action-button {

    width: 100%;

    padding: 16px 25px;

    border: none;

    border-radius: 14px;

    background: #1595bd;

    color: white;

    font-size: 17px;

    font-weight: 700;

    cursor: pointer;

    transition: all 0.2s ease;
}


.ticket-action-button:hover {

    background: #087da4;

    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(21, 149, 189, 0.25);
}


/* =========================================================
   WARNA BERDASARKAN AKSI
========================================================= */

.ticket-action-popup.called .ticket-action-icon {

    background: #e8f7fc;

    color: #1595bd;
}


.ticket-action-popup.skipped .ticket-action-icon {

    background: #fff7e6;

    color: #f59e0b;
}


.ticket-action-popup.completed .ticket-action-icon {

    background: #eaf9ef;

    color: #22a447;
}


/* =========================================================
   NOTIFIKASI REGISTRASI GAGAL / PT SUDAH TERDAFTAR
========================================================= */

.registration-error-alert {
    width: 100%;

    margin-bottom: 22px;

    padding: 18px 20px;

    display: flex;
    align-items: flex-start;

    gap: 15px;

    background: #fff7f7;

    border: 1px solid #ffc9ce;

    border-left: 5px solid #dc3545;

    border-radius: 14px;

    box-shadow: 0 5px 18px rgba(220, 53, 69, 0.07);

    animation: registrationErrorShow 0.25s ease;
}


/* ICON */

.registration-error-icon {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #ffe4e7;

    color: #dc3545;

    font-size: 19px;
}


/* CONTENT */

.registration-error-content {
    flex: 1;

    min-width: 0;
}


/* TITLE */

.registration-error-title {
    margin-bottom: 5px;

    color: #a51f2d;

    font-size: 14px;

    font-weight: 800;
}


/* MESSAGE */

.registration-error-message {
    color: #b02a37;

    font-size: 13px;

    line-height: 1.6;

    font-weight: 500;
}


/* HELP */

.registration-error-help {
    margin-top: 12px;

    padding: 11px 13px;

    display: flex;
    align-items: flex-start;

    gap: 8px;

    background: #fff;

    border: 1px solid #ffd9dd;

    border-radius: 9px;

    color: #6f4b51;

    font-size: 11px;

    line-height: 1.6;
}


.registration-error-help i {
    margin-top: 3px;

    color: #1594c1;

    flex-shrink: 0;
}


.registration-error-help strong {
    color: #124a78;
}


/* ANIMATION */

@keyframes registrationErrorShow {

    from {
        opacity: 0;
        transform: translateY(-8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .registration-error-alert {
        padding: 15px;

        gap: 11px;

        border-radius: 12px;
    }


    .registration-error-icon {
        width: 36px;
        height: 36px;

        font-size: 16px;
    }


    .registration-error-title {
        font-size: 13px;
    }


    .registration-error-message {
        font-size: 12px;
    }


    .registration-error-help {
        font-size: 10px;

        padding: 9px 10px;
    }

}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .ticket-action-popup {

        width: calc(100% - 25px);

        padding: 40px 22px 25px;

        border-radius: 22px;
    }


    .ticket-action-icon {

        width: 85px;
        height: 85px;

        font-size: 38px;
    }


    .ticket-action-icon i {

        font-size: 38px;
    }


    .ticket-action-title h2 {

        font-size: 24px;
    }


    .ticket-action-ticket strong {

        font-size: 32px;
    }


    .ticket-action-message {

        font-size: 16px;
    }
}

        /* =========================================================
           EMPTY TRACK
        ========================================================= */

        .track-empty {
            min-height: 230px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;
            padding: 25px;
        }

        .track-empty-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 12px;

            border-radius: 50%;

            background: #eaf5fa;
            color: #63afd0;

            font-size: 22px;
        }

        .track-empty h3 {
            color: #6e8da7;
            font-size: 14px;
            font-weight: 600;
        }

        .track-empty p {
            margin-top: 5px;

            color: #8ba3b7;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================================================
           ALERT
        ========================================================= */

        .alert {
            margin-bottom: 20px;
            padding: 13px 16px;

            border-radius: 11px;

            display: flex;
            align-items: flex-start;
            gap: 10px;

            font-size: 12px;
        }

        .alert-danger {
            background: #fff1f2;
            border: 1px solid #ffd2d6;
            color: #c43b48;
        }

        .alert-warning {
            background: #fff8e6;
            border: 1px solid #ffe0a3;
            color: #9a6700;
        }

        .alert-success {
            background: #edfaf5;
            border: 1px solid #ccefe1;
            color: #13815f;
        }

        .alert i {
            margin-top: 2px;
        }

        /* =========================================================
           HASIL TIKET
        ========================================================= */

        .ticket-result {
            margin-top: 18px;
            padding: 20px;
            border-radius: 15px;
            background: #f2f9fd;
            border: 1px solid #cfe7f3;
        }

        .ticket-result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .ticket-result-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #124a78;
            font-size: 15px;
            font-weight: 700;
        }

        .ticket-result-title i {
            color: #1594c1;
        }

        .ticket-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 105px;
            padding: 9px 14px;
            border-radius: 10px;
            background: #e4f4fb;
            color: #087ba9;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .ticket-item {
            padding: 11px 13px;
            background: #ffffff;
            border: 1px solid #dceaf2;
            border-radius: 10px;
        }

        .ticket-label {
            color: #7895ad;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .ticket-value {
            color: #124a78;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.45;
        }

        .ticket-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 20px;
            background: #fff5d9;
            color: #9a6a00;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .ticket-status.selesai {
            background: #e9f8f1;
            color: #13815f;
        }

        .ticket-status.dilayani,
        .ticket-status.dipanggil {
            background: #eaf4ff;
            color: #1769aa;
        }

        @media (max-width: 480px) {
            .ticket-result-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .ticket-grid {
                grid-template-columns: 1fr;
            }

            .ticket-number {
                width: 100%;
            }
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .page-container {
                padding-left: 22px;
                padding-right: 22px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .track-empty {
                min-height: 180px;
            }
        }

        @media (max-width: 768px) {

            html {
                font-size: 13px;
            }

            .header-container {
                padding: 10px 18px;
                min-height: 68px;
            }

            .system-name {
                font-size: 16px;
            }

            .system-subtitle {
                font-size: 9px;
            }

            .header-badge {
                display: none;
            }

            .page-container {
                padding: 20px 15px 30px;
            }

            .page-heading {
                flex-direction: column;
                gap: 14px;
            }

            .heading-left h1 {
                font-size: 27px;
            }

            .heading-left p {
                font-size: 12px;
            }

            .service-status {
                align-self: flex-start;
                font-size: 11px;
                padding: 10px 15px;
            }

            .card-header {
                padding: 20px;
            }

            .card-body {
                padding: 20px;
            }

            .card-title h2 {
                font-size: 18px;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {

            .logo-wrapper {
                width: 40px;
                height: 40px;
            }

            .system-name {
                font-size: 14px;
            }

            .system-subtitle {
                display: none;
            }

            .heading-left h1 {
                font-size: 23px;
            }

            .track-form {
                flex-direction: column;
            }

            .btn-track {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    {{-- =========================================================
         HEADER SISTEM
    ========================================================== --}}
    <header class="system-header">

        <div class="header-container">

            <div class="system-brand">

                <div class="logo-wrapper">

                    {{-- GANTI PATH INI JIKA LOGO KAMU BERBEDA --}}
                    @if(file_exists(public_path('images/sitafas-logo.png')))

    <img
        src="{{ asset('images/sitafas-logo.png') }}"
        alt="Logo SITAFAS"
        class="logo-sitafas"
    >

@else

    <div class="logo-placeholder">
        S
    </div>

@endif

                </div>

                <div class="system-info">

                    <div class="system-name">
                        SITAFAS
                    </div>

                    <div class="system-subtitle">
                        Sistem Tiketing Antrean Faswil
                    </div>

                </div>

            </div>

           <div class="header-right">

    <img
        src="{{ asset('images/Logo-LLDIKTI.png') }}"
        alt="Logo LLDIKTI"
        class="header-logo lldikti-logo"
    >

    <img
        src="{{ asset('images/Logo-Tersier-Diktisaintek-Berdampak-1.png') }}"
        alt="Logo Kemdiktisaintek"
        class="header-logo kemdiktisaintek-logo"
    >

</div>

        </div>

    </header>


    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <main class="page-container">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="fa-solid fa-circle-check"></i>

                <div>
                    {{ session('success') }}
                </div>

            </div>

        @endif


        {{-- ALERT PT SUDAH TERDAFTAR --}}
@if(session('error'))
    <div class="alert alert-warning">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <div>{{ session('error') }}</div>
    </div>
@endif


        {{-- VALIDATION ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <i class="fa-solid fa-circle-exclamation"></i>

                <div>

                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach

                </div>

            </div>

        @endif


        {{-- ALERT TRACKING ERROR --}}
        @if(session('track_error'))

            <div class="alert alert-danger">
                <i class="fa-solid fa-ticket"></i>
                <div>{{ session('track_error') }}</div>
            </div>

        @endif


        {{-- =====================================================
             PAGE HEADING
        ====================================================== --}}
        <section class="page-heading">

            <div class="heading-left">

                <h1>
                    Registrasi Layanan Perguruan Tinggi
                </h1>

                <p>
                    Silakan melakukan registrasi untuk mendapatkan nomor tiket layanan Faswil.
                </p>

            </div>

            <div class="service-status">

                <span class="status-dot"></span>

                Layanan Buka (08.00 - 16.00 WIB)

            </div>

        </section>


        {{-- =====================================================
             CONTENT GRID
        ====================================================== --}}
        <div class="content-grid">


            {{-- =================================================
                 FORM REGISTRASI
            ================================================== --}}
            <section class="card">

                <div class="card-header">

                    <div class="card-title">

                        <div class="card-title-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>

                        <h2>
                            Daftar Layanan
                        </h2>

                    </div>

                    <p>
                        Lengkapi data berikut untuk mendapatkan nomor antrean.
                    </p>

                </div>


                <div class="card-body">

                    {{-- FORM --}}
                    <form
                        action="{{ route('registrasi.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- =========================================
                             PERGURUAN TINGGI
                        ========================================== --}}
                        <div class="form-group">

                            <label
                                for="id_master"
                                class="form-label"
                            >
                                1. Perguruan Tinggi
                                <span class="required">*</span>
                            </label>


                            <select
                                name="id_master"
                                id="id_master"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    -- Pilih Perguruan Tinggi --
                                </option>


                                @foreach($masters as $master)



    @php
        $ptSudahTerdaftar = in_array(
            mb_strtolower(trim($master->nama_pt)),
            $namaPtTerdaftar ?? [],
            true
        );
    @endphp

                                    <option
                                        value="{{ $master->id_master }}"
                                        data-kode-pt="{{ $master->kode_pt }}"
                                        data-nama-pt="{{ $master->nama_pt }}"
                                        data-faswil="{{ $master->nama_faswil }}"
                                        data-no-meja="{{ $master->no_meja }}"
                                        data-sesi="{{ $master->sesi }}"
                                        data-tanggal="{{ $master->tanggal }}"
                                        data-jam-mulai="{{ $master->jam_mulai }}"
                                        data-jam-selesai="{{ $master->jam_selesai }}"
                                        data-pendamping="{{ $master->pendamping }}"
                                        {{ old('id_master') == $master->id_master ? 'selected' : '' }}
                                        {{ $ptSudahTerdaftar ? 'disabled' : '' }}
                                    >

                                        {{ $master->nama_pt }}
                                        ({{ $master->kode_pt }})

                                        @if($ptSudahTerdaftar)
                                             - SUDAH TERDAFTAR
                                        @endif

                                    </option>

                                @endforeach

                            </select>


                            <div class="form-help">
                                Pilih Perguruan Tinggi terlebih dahulu untuk melihat jadwal layanan dari data master.
                            </div>

                        </div>


                        {{-- =========================================
                             INFORMASI JADWAL
                        ========================================== --}}
                        <div
                            class="schedule-box"
                            id="scheduleBox"
                            style="display: none;"
                        >

                            <div class="schedule-title">

                                <i class="fa-solid fa-calendar-days"></i>

                                Informasi Jadwal Layanan

                            </div>


                            <div class="schedule-grid">


                                {{-- KODE PT --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Kode PT
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="kodePt"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- NAMA PT --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Nama Perguruan Tinggi
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="namaPt"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- FASWIL --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Nama Faswil
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="namaFaswil"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- MEJA --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        No. Meja
                                    </div>

                                    <div
                                        class="schedule-value large"
                                        id="noMeja"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- SESI --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Sesi
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="sesi"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- TANGGAL --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Tanggal
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="tanggal"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- JAM --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Jam Layanan
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="jam"
                                    >
                                        -
                                    </div>

                                </div>


                                {{-- PENDAMPING --}}
                                <div class="schedule-item">

                                    <div class="schedule-label">
                                        Pendamping
                                    </div>

                                    <div
                                        class="schedule-value"
                                        id="pendamping"
                                    >
                                        -
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================================
                             Catatan 
                        ========================================== --}}
                        <div
                            class="form-group"
                            style="margin-top: 20px;"
                        >

                            <label
                                for="kebutuhan"
                                class="form-label"
                            >
                                Catatan Khusus
                            </label>

                            <textarea
                                name="kebutuhan"
                                id="kebutuhan"
                                class="form-control"
                                placeholder="Tuliskan catatan Anda..."
                            >{{ old('kebutuhan') }}</textarea>

                        </div>


                        {{-- =========================================
                             HIDDEN DATA MASTER
                        ========================================== --}}

                        <input
                            type="hidden"
                            name="kode_pt"
                            id="hiddenKodePt"
                        >

                        <input
                            type="hidden"
                            name="nama_pt"
                            id="hiddenNamaPt"
                        >

                        <input
                            type="hidden"
                            name="nama_faswil"
                            id="hiddenNamaFaswil"
                        >

                        <input
                            type="hidden"
                            name="no_meja"
                            id="hiddenNoMeja"
                        >

                        <input
                            type="hidden"
                            name="sesi"
                            id="hiddenSesi"
                        >

                        <input
                            type="hidden"
                            name="tanggal"
                            id="hiddenTanggal"
                        >

                        <input
                            type="hidden"
                            name="jam_mulai"
                            id="hiddenJamMulai"
                        >

                        <input
                            type="hidden"
                            name="jam_selesai"
                            id="hiddenJamSelesai"
                        >

                        <input
                            type="hidden"
                            name="pendamping"
                            id="hiddenPendamping"
                        >


                        {{-- =========================================
                             BUTTON
                        ========================================== --}}
                        <button
                            type="submit"
                            class="btn-submit"
                        >

                            <i class="fa-solid fa-ticket"></i>

                            Daftar & Ambil Nomor Tiket

                        </button>

                    </form>

                </div>

            </section>


            {{-- =================================================
                 LACAK TIKET
            ================================================== --}}
            <section class="card">

                <div class="card-header">

                    <div class="card-title">

                        <div class="card-title-icon">
                            <i class="fa-solid fa-crosshairs"></i>
                        </div>

                        <h2>
                            Lacak Tiket
                        </h2>

                    </div>

                    <p>
                        Masukkan nama perguruan tinggi yang sudah melakukan pendaftaran untuk melihat status layanan.
                    </p>

                </div>


                <div class="card-body">


                    <div class="track-box">

                        <label
                            for="nama_pt"
                            class="track-label"
                        >
                            Nama Perguruan Tinggi
                        </label>


                        <form
                            action="{{ route('registrasi.track') }}"
                            method="GET"
                            class="track-form"
                        >

                            <input
                                type="text"
                                name="nama_pt"
                                id="nama_pt"
                                class="track-input"
                                value="{{ old('nama_pt', request('nama_pt', isset($ticketMaster) && $ticketMaster ? $ticketMaster->nama_pt : '')) }}"
                                placeholder="Contoh: Universitas Pancasila"
                                autocomplete="off"
                                required
                            >


                            <button
                                type="submit"
                                class="btn-track"
                            >

                                <i class="fa-solid fa-magnifying-glass"></i>

                                Lacak

                            </button>

                        </form>

                    </div>


                    {{-- HASIL TIKET / EMPTY STATE --}}
                    @if(isset($tiket) && $tiket)

                        @php
                            /*
                             * DATA HASIL LACAK SELALU DIAMBIL DARI TIKET
                             * YANG SEDANG DITAMPILKAN.
                             *
                             * Tiket -> Registrasi -> Master
                             *
                             * Ini mencegah nama PT/kode PT/master lain
                             * tertukar ketika user mencari berdasarkan nama PT.
                             */
                            $ticketRegistrasi = $tiket->registrasi ?? null;

                            $ticketMaster = $ticketRegistrasi
                                ? $ticketRegistrasi->master
                                : null;

                            $ticketStatus = strtolower(
                                (string) ($tiket->status ?? 'menunggu')
                            );

                            $ticketNamaPt = $ticketMaster->nama_pt ?? '-';
                            $ticketKodePt = $ticketMaster->kode_pt ?? '-';
                            $ticketFaswil = $ticketMaster->nama_faswil ?? '-';
                            $ticketMeja = $ticketMaster->no_meja ?? '-';
                            $ticketSesi = $ticketMaster->sesi ?? '-';
                            $ticketTanggal = $ticketMaster->tanggal ?? null;
                            $ticketJamMulai = $ticketMaster->jam_mulai ?? null;
                            $ticketJamSelesai = $ticketMaster->jam_selesai ?? null;
                            $ticketKebutuhan = $ticketRegistrasi->kebutuhan ?? '-';
                        @endphp

                        <div class="ticket-result">

                            <div class="ticket-result-header">

                                <div class="ticket-result-title">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Tiket ditemukan
                                </div>

                                <div class="ticket-number">
                                    {{ preg_replace('/^[A-Za-z]+-/', '', $tiket->nomor_tiket) }}
                                </div>

                            </div>

                            <div class="ticket-grid">

                                <div class="ticket-item">
                                    <div class="ticket-label">Perguruan Tinggi</div>
                                    <div class="ticket-value">
                                        {{ $ticketNamaPt }}
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Kode PT</div>
                                    <div class="ticket-value">
                                        {{ $ticketKodePt }}
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Faswil</div>
                                    <div class="ticket-value">
                                        {{ $ticketFaswil }}
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">No. Meja</div>
                                    <div class="ticket-value">
                                        {{ $ticketMeja }}
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Sesi</div>
                                    <div class="ticket-value">
                                        {{ $ticketSesi }}
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Tanggal Jadwal</div>
                                    <div class="ticket-value">
                                        @if(!empty($ticketTanggal))
                                            {{ \Carbon\Carbon::parse($ticketTanggal)->translatedFormat('d F Y') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Jam Layanan</div>
                                    <div class="ticket-value">
                                        @if($ticketJamMulai && $ticketJamSelesai)
                                            {{ substr($ticketJamMulai, 0, 5) }} - {{ substr($ticketJamSelesai, 0, 5) }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Status Tiket</div>
                                    <div class="ticket-value">
                                        <span class="ticket-status {{ $ticketStatus }}">
                                            <i class="fa-solid fa-circle"></i>
                                            {{ $tiket->status ?? 'menunggu' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Waktu Daftar</div>
                                    <div class="ticket-value">
                                        @if($tiket->waktu_daftar)
                                            {{ \Carbon\Carbon::parse($tiket->waktu_daftar)->format('d-m-Y H:i') }} WIB
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                                <div class="ticket-item">
                                    <div class="ticket-label">Catatan Khusus</div>
                                    <div class="ticket-value">
                                        {{ $ticketKebutuhan }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="track-empty">

                            <div class="track-empty-icon">
                                <i class="fa-solid fa-ticket"></i>
                            </div>

                            <h3>
                                Belum ada tiket yang dilacak.
                            </h3>

                            <p>
                                Masukkan nama perguruan tinggi yang sudah melakukan pendaftaran untuk melihat status.
                            </p>

                        </div>

                    @endif

                    {{-- =================================================
     TOMBOL CETAK TIKET
================================================== --}}

@if(isset($tiket) && $tiket)
    <a
        href="{{ route('registrasi.cetak', [
            'id' => $tiket->id_registrasi
        ]) }}"
        class="ticket-print-btn"
        target="_blank"
    >
        <i class="fa-solid fa-print"></i>
        Cetak Tiket
    </a>
@endif

                </div>

            </section>

        </div>

    </main>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const masterSelect = document.getElementById('id_master');

            const scheduleBox = document.getElementById('scheduleBox');


            masterSelect.addEventListener('change', function () {

                const option = this.options[this.selectedIndex];


                if (!option.value) {

                    scheduleBox.style.display = 'none';

                    clearSchedule();

                    return;
                }


                /* ================================================
                   AMBIL DATA DARI DATA MASTER
                ================================================= */

                const kodePt =
                    option.dataset.kodePt || '-';

                const namaPt =
                    option.dataset.namaPt || '-';

                const faswil =
                    option.dataset.faswil || '-';

                const noMeja =
                    option.dataset.noMeja || '-';

                const sesi =
                    option.dataset.sesi || '-';

                const tanggal =
                    option.dataset.tanggal || '-';

                const jamMulai =
                    option.dataset.jamMulai || '';

                const jamSelesai =
                    option.dataset.jamSelesai || '';

                const pendamping =
                    option.dataset.pendamping || '-';


                /* ================================================
                   TAMPILKAN DATA
                ================================================= */

                document.getElementById('kodePt').textContent =
                    kodePt;

                document.getElementById('namaPt').textContent =
                    namaPt;

                document.getElementById('namaFaswil').textContent =
                    faswil;

                document.getElementById('noMeja').textContent =
                    noMeja;

                document.getElementById('sesi').textContent =
                    sesi;

                document.getElementById('tanggal').textContent =
                    formatTanggal(tanggal);

                document.getElementById('jam').textContent =
                    formatJam(jamMulai, jamSelesai);

                document.getElementById('pendamping').textContent =
                    pendamping;


                /* ================================================
                   ISI HIDDEN INPUT
                ================================================= */

                document.getElementById('hiddenKodePt').value =
                    kodePt;

                document.getElementById('hiddenNamaPt').value =
                    namaPt;

                document.getElementById('hiddenNamaFaswil').value =
                    faswil;

                document.getElementById('hiddenNoMeja').value =
                    noMeja;

                document.getElementById('hiddenSesi').value =
                    sesi;

                document.getElementById('hiddenTanggal').value =
                    tanggal;

                document.getElementById('hiddenJamMulai').value =
                    jamMulai;

                document.getElementById('hiddenJamSelesai').value =
                    jamSelesai;

                document.getElementById('hiddenPendamping').value =
                    pendamping;


                /* ================================================
                   TAMPILKAN BOX
                ================================================= */

                scheduleBox.style.display = 'block';

            });


            /* ====================================================
               FORMAT TANGGAL
            ==================================================== */

            function formatTanggal(value) {

                if (!value || value === '-') {
                    return '-';
                }

                const date = new Date(value);

                if (isNaN(date.getTime())) {
                    return value;
                }

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });

            }


            /* ====================================================
               FORMAT JAM
            ==================================================== */

            function formatJam(mulai, selesai) {

                if (!mulai && !selesai) {
                    return '-';
                }

                if (mulai && selesai) {

                    return (
                        formatTime(mulai)
                        + ' - ' +
                        formatTime(selesai)
                    );

                }

                return mulai || selesai || '-';

            }


            function formatTime(value) {

                if (!value) {
                    return '';
                }

                /*
                 * Jika database menyimpan:
                 * 08:00:00
                 * maka menjadi:
                 * 08.00
                 */

                return value
                    .substring(0, 5)
                    .replace(':', '.');

            }


            /* ====================================================
               OTOMATIS TAMPILKAN DATA JIKA OLD INPUT ADA
            ==================================================== */

            if (masterSelect.value) {

                masterSelect.dispatchEvent(
                    new Event('change')
                );

            }


            /* ====================================================
               CLEAR SCHEDULE
            ==================================================== */

            function clearSchedule() {

                document.getElementById('kodePt').textContent = '-';
                document.getElementById('namaPt').textContent = '-';
                document.getElementById('namaFaswil').textContent = '-';
                document.getElementById('noMeja').textContent = '-';
                document.getElementById('sesi').textContent = '-';
                document.getElementById('tanggal').textContent = '-';
                document.getElementById('jam').textContent = '-';
                document.getElementById('pendamping').textContent = '-';

                document.getElementById('hiddenKodePt').value = '';
                document.getElementById('hiddenNamaPt').value = '';
                document.getElementById('hiddenNamaFaswil').value = '';
                document.getElementById('hiddenNoMeja').value = '';
                document.getElementById('hiddenSesi').value = '';
                document.getElementById('hiddenTanggal').value = '';
                document.getElementById('hiddenJamMulai').value = '';
                document.getElementById('hiddenJamSelesai').value = '';
                document.getElementById('hiddenPendamping').value = '';

            }

        });

</script>

{{-- =========================================================
     POPUP AKSI PETUGAS
     
     Aksi:
     - dipanggil
     - dipanggil_ulang
     - dilewati
     - selesai

     Popup:
     - otomatis muncul
     - tidak auto close
     - tidak bisa ditutup dengan klik background
     - hanya tombol TUTUP yang menutup
========================================================= --}}

{{-- =========================================================
     POPUP AKSI PETUGAS

     FITUR:
     - Panggil       -> popup otomatis
     - Panggil Ulang -> popup otomatis
     - Lewati        -> popup otomatis
     - Selesai       -> popup otomatis
     - Tidak perlu klik Lacak untuk popup
     - Lacak Tiket tetap berfungsi seperti sebelumnya
     - Tiket hasil registrasi otomatis dimonitor
     - Tiket hasil Lacak otomatis dimonitor
     - Popup tidak auto-close
     - Klik background tidak menutup popup
     - Hanya tombol Tutup yang menutup popup
     - Polling setiap 1 detik
     - Panggil Ulang berkali-kali tetap terdeteksi berdasarkan waktu_aksi
========================================================= --}}

<div
    id="ticketActionPopup"
    class="ticket-action-overlay"
    aria-hidden="true"
>

    <div class="ticket-action-popup">

        <div
            id="ticketActionIcon"
            class="ticket-action-icon"
        >
            <i class="fa-solid fa-bullhorn"></i>
        </div>

        <div class="ticket-action-title">
            <h2 id="ticketActionTitle">
                Informasi Antrean
            </h2>
        </div>

        <div class="ticket-action-ticket">
            <span>Nomor Antrean</span>

            <strong id="ticketActionNumber">
                -
            </strong>
        </div>

        <div
            id="ticketActionPT"
            class="ticket-action-pt"
        >
            -
        </div>

        <p
            id="ticketActionMessage"
            class="ticket-action-message"
        >
            Menunggu panggilan petugas.
        </p>

        <div
            id="ticketActionTime"
            class="ticket-action-time"
        >
            -
        </div>

        <button
            type="button"
            id="ticketActionOk"
            class="ticket-action-button"
        >
            <i class="fa-solid fa-check"></i>
            Tutup
        </button>

    </div>

</div>

<style>
.ticket-action-overlay {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    background: rgba(5, 30, 50, 0.78);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999999;
    opacity: 0;
    visibility: hidden;
    transition: opacity .25s ease, visibility .25s ease;
    backdrop-filter: blur(6px);
}

.ticket-action-overlay.show {
    opacity: 1;
    visibility: visible;
}

.ticket-action-popup {
    width: min(600px, calc(100% - 35px));
    background: #ffffff;
    border-radius: 28px;
    padding: 45px 40px 35px;
    text-align: center;
    box-shadow: 0 30px 90px rgba(0, 0, 0, .35);
    transform: translateY(30px) scale(.94);
    transition: transform .3s ease;
}

.ticket-action-overlay.show .ticket-action-popup {
    transform: translateY(0) scale(1);
}

.ticket-action-icon {
    width: 105px;
    height: 105px;
    margin: 0 auto 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f7fc;
    color: #1595bd;
    font-size: 48px;
}

.ticket-action-overlay.show .ticket-action-icon {
    animation: ticketPulse 1.5s infinite;
}

@keyframes ticketPulse {
    0% { box-shadow: 0 0 0 0 rgba(21,149,189,.30); }
    70% { box-shadow: 0 0 0 18px rgba(21,149,189,0); }
    100% { box-shadow: 0 0 0 0 rgba(21,149,189,0); }
}

.ticket-action-title h2 {
    margin: 0 0 20px;
    color: #084f78;
    font-size: 29px;
    font-weight: 800;
    line-height: 1.35;
}

.ticket-action-ticket {
    width: fit-content;
    min-width: 260px;
    margin: 0 auto 15px;
    padding: 18px 30px;
    background: #eff9fd;
    border: 2px solid #d5edf6;
    border-radius: 18px;
}

.ticket-action-ticket span {
    display: block;
    margin-bottom: 5px;
    color: #7896aa;
    font-size: 13px;
}

.ticket-action-ticket strong {
    display: block;
    color: #078fbe;
    font-size: 42px;
    font-weight: 900;
    letter-spacing: 2px;
}

.ticket-action-pt {
    margin-top: 10px;
    color: #164b72;
    font-size: 17px;
    font-weight: 700;
}

.ticket-action-message {
    max-width: 480px;
    margin: 20px auto;
    color: #536f82;
    font-size: 17px;
    line-height: 1.6;
}

.ticket-action-time {
    margin-bottom: 25px;
    color: #94a3b8;
    font-size: 13px;
}

.ticket-action-button {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 13px;
    background: #1595bd;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.ticket-action-button:hover {
    background: #087da4;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(21,149,189,.25);
}

.ticket-action-popup.called .ticket-action-icon {
    background: #e8f7fc;
    color: #1595bd;
}

.ticket-action-popup.skipped .ticket-action-icon {
    background: #fff5df;
    color: #d99000;
}

.ticket-action-popup.completed .ticket-action-icon {
    background: #e9f9ef;
    color: #15965b;
}

@media (max-width: 600px) {
    .ticket-action-popup {
        width: calc(100% - 25px);
        padding: 35px 22px 25px;
        border-radius: 22px;
    }

    .ticket-action-icon {
        width: 85px;
        height: 85px;
        font-size: 38px;
    }

    .ticket-action-title h2 {
        font-size: 23px;
    }

    .ticket-action-ticket strong {
        font-size: 32px;
    }

    .ticket-action-message {
        font-size: 15px;
    }
}
</style>


<script>
(function () {
    'use strict';

    /* =========================================================
       SITAFAS - POPUP OTOMATIS STATUS ANTREAN
       =========================================================

       Sumber ID tiket:
       1. Session hasil registrasi
       2. $tiket jika tersedia
       3. localStorage

       Aksi yang dipantau:
       - dipanggil
       - panggil
       - dipanggil_ulang
       - panggil_ulang
       - dilewati
       - lewati
       - selesai

       Popup muncul otomatis tanpa refresh halaman.
    ========================================================= */


    /* =========================================================
       1. AMBIL TIKET AKTIF
    ========================================================= */

    const sessionTicketId = @json(
        session('sitafas_id_tiket_aktif')
    );

    const serverTicketId = @json(
        isset($tiket) && $tiket
            ? $tiket->id_tiket
            : null
    );

    const serverTicketNumber = @json(
        isset($tiket) && $tiket
            ? $tiket->nomor_tiket
            : null
    );

    const serverTicketPT = @json(
        isset($tiket)
        && $tiket
        && $tiket->registrasi
        && $tiket->registrasi->master
            ? $tiket->registrasi->master->nama_pt
            : null
    );


    /*
     * Prioritas:
     * session -> server -> localStorage
     */

    let ticketId =
        sessionTicketId ||
        serverTicketId ||
        localStorage.getItem(
            'sitafas_ticket_id'
        );


    ticketId = ticketId
        ? String(ticketId)
        : '';


    let nomorTiket =
        serverTicketNumber ||
        localStorage.getItem(
            'sitafas_ticket_number'
        ) ||
        '';


    let namaPT =
        serverTicketPT ||
        localStorage.getItem(
            'sitafas_ticket_pt'
        ) ||
        '';


    /* =========================================================
       2. SIMPAN TIKET AKTIF
    ========================================================= */

    if (ticketId) {

        localStorage.setItem(
            'sitafas_ticket_id',
            ticketId
        );
    }


    if (nomorTiket) {

        localStorage.setItem(
            'sitafas_ticket_number',
            nomorTiket
        );
    }


    if (namaPT) {

        localStorage.setItem(
            'sitafas_ticket_pt',
            namaPT
        );
    }


    /* =========================================================
       3. AMBIL ELEMENT POPUP
    ========================================================= */

    const overlay =
        document.getElementById(
            'ticketActionPopup'
        );


    const popup =
        overlay
            ? overlay.querySelector(
                '.ticket-action-popup'
            )
            : null;


    const icon =
        document.getElementById(
            'ticketActionIcon'
        );


    const title =
        document.getElementById(
            'ticketActionTitle'
        );


    const number =
        document.getElementById(
            'ticketActionNumber'
        );


    const pt =
        document.getElementById(
            'ticketActionPT'
        );


    const message =
        document.getElementById(
            'ticketActionMessage'
        );


    const time =
        document.getElementById(
            'ticketActionTime'
        );


    const button =
        document.getElementById(
            'ticketActionOk'
        );


    if (!overlay || !popup) {

        console.error(
            'SITAFAS: Element popup tidak ditemukan.'
        );

        return;
    }


    /* =========================================================
       4. NORMALISASI WAKTU
    ========================================================= */

    function normalizeDateTime(value) {

        if (!value) {
            return '';
        }

        return String(value)
            .trim()
            .replace('T', ' ');
    }


    function displayTime(value) {

        const text =
            normalizeDateTime(value);


        const match =
            text.match(
                /(\d{2}:\d{2}:\d{2})$/
            );


        return match
            ? match[1]
            : text;
    }


    /* =========================================================
       5. EVENT ID
    ========================================================= */

    function createEventId(
        action,
        waktu
    ) {

        return [
            String(
                ticketId ||
                nomorTiket ||
                ''
            ),

            String(
                action || ''
            ),

            normalizeDateTime(
                waktu
            )

        ].join('|');
    }


    /*
     * Kondisi terakhir yang sudah diproses.
     */

    let lastEventId = null;


    /*
     * Menandakan request pertama.
     */

    let firstServerRead = true;


    /*
     * Mencegah request bertumpuk.
     */

    let pollingRunning = false;


    /*
     * ID interval polling.
     */

    let pollingTimer = null;


    /* =========================================================
       6. TAMPILKAN POPUP
    ========================================================= */

    function showPopup(
        action,
        nomor,
        namaPTData,
        waktuAksi
    ) {

        let popupClass =
            'called';

        let popupTitle =
            'Informasi Antrean';

        let popupMessage =
            'Status antrean Anda telah diperbarui.';

        let popupIcon =
            'fa-solid fa-bell';


        /*
         * PANGGIL
         */

        switch (action) {

            case 'dipanggil':
            case 'panggil':

                popupClass =
                    'called';

                popupTitle =
                    'Antrean Anda Dipanggil';

                popupMessage =
                    'Silakan segera menuju meja pelayanan.';

                popupIcon =
                    'fa-solid fa-bullhorn';

                break;


            /*
             * PANGGIL ULANG
             */

            case 'dipanggil_ulang':
            case 'panggil_ulang':

                popupClass =
                    'called';

                popupTitle =
                    'Antrean Anda Dipanggil Ulang';

                popupMessage =
                    'Silakan segera menuju meja pelayanan.';

                popupIcon =
                    'fa-solid fa-bullhorn';

                break;


            /*
             * LEWATI
             */

            case 'dilewati':
            case 'lewati':

                popupClass =
                    'skipped';

                popupTitle =
                    'Antrean Anda Dilewati';

                popupMessage =
                    'Antrean Anda telah dilewati oleh petugas.';

                popupIcon =
                    'fa-solid fa-forward';

                break;


            /*
             * SELESAI
             */

            case 'selesai':

                popupClass =
                    'completed';

                popupTitle =
                    'Layanan Selesai';

                popupMessage =
                    'Layanan Anda telah selesai. Terima kasih.';

                popupIcon =
                    'fa-solid fa-circle-check';

                break;


            default:

                return;
        }


        /*
         * Hapus class status lama.
         */

        popup.classList.remove(
            'called',
            'skipped',
            'completed'
        );


        /*
         * Tambahkan class baru.
         */

        popup.classList.add(
            popupClass
        );


        /*
         * Icon
         */

        if (icon) {

            icon.className =
                popupIcon;
        }


        /*
         * Judul
         */

        if (title) {

            title.textContent =
                popupTitle;
        }


        /*
         * Nomor tiket
         */

        if (number) {

            const nomorTampil =
    nomor ||
    nomorTiket ||
    '-';

number.textContent =
    nomorTampil
        .replace(/^[A-Za-z]+-/, '');
        }


        /*
         * Nama PT
         */

        if (pt) {

            pt.textContent =
                namaPTData ||
                namaPT ||
                '-';
        }


        /*
         * Pesan
         */

        if (message) {

            message.textContent =
                popupMessage;
        }


        /*
         * Waktu
         */

        if (time) {

            time.textContent =
                displayTime(
                    waktuAksi
                );
        }


        /*
         * TAMPILKAN POPUP
         */

        overlay.classList.add(
            'show'
        );

        overlay.setAttribute(
            'aria-hidden',
            'false'
        );
    }


    /* =========================================================
       7. TUTUP POPUP
    ========================================================= */

    function closePopup() {

        overlay.classList.remove(
            'show'
        );

        overlay.setAttribute(
            'aria-hidden',
            'true'
        );
    }


    if (button) {

        button.addEventListener(
            'click',
            closePopup
        );
    }


    /* =========================================================
       8. CEK STATUS TIKET
    ========================================================= */

    async function checkPopupStatus() {

        /*
         * Belum ada tiket.
         */

        if (!ticketId) {

            return;
        }


        /*
         * Jangan jalankan request baru
         * jika request sebelumnya belum selesai.
         */

        if (pollingRunning) {

            return;
        }


        pollingRunning = true;


        try {

            const url =
                "{{ url('/registrasi/cek-status-popup') }}/" +
                encodeURIComponent(
                    ticketId
                ) +
                '?_=' +
                Date.now();


            const response =
                await fetch(
                    url,
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
                    }
                );


            /*
             * Jika endpoint error,
             * jangan hentikan polling.
             */

            if (!response.ok) {

                console.warn(
                    'SITAFAS popup HTTP error:',
                    response.status
                );

                return;
            }


            const data =
                await response.json();


            if (
                !data ||
                data.success !== true ||
                data.found !== true
            ) {

                return;
            }


            /* =================================================
               9. SINKRONISASI DATA TIKET
            ================================================= */

            if (data.id_tiket) {

                ticketId =
                    String(
                        data.id_tiket
                    );


                localStorage.setItem(
                    'sitafas_ticket_id',
                    ticketId
                );
            }


            if (data.nomor_tiket) {

                nomorTiket =
                    data.nomor_tiket;


                localStorage.setItem(
                    'sitafas_ticket_number',
                    nomorTiket
                );
            }


            if (data.nama_pt) {

                namaPT =
                    data.nama_pt;


                localStorage.setItem(
                    'sitafas_ticket_pt',
                    namaPT
                );
            }


            /* =================================================
               10. AMBIL AKSI
            ================================================= */

            const action =
                data.aksi_terakhir;


            const waktuAksi =
                normalizeDateTime(
                    data.waktu_aksi
                );


            /*
             * Tidak ada aksi atau waktu.
             */

            if (
                !action ||
                !waktuAksi
            ) {

                return;
            }


            /* =================================================
               11. BUAT EVENT ID
            ================================================= */

            const currentEventId =
                createEventId(
                    action,
                    waktuAksi
                );


            /*
             * REQUEST PERTAMA
             *
             * Jangan munculkan popup dari aksi
             * lama yang sudah ada sebelum halaman dibuka.
             */

            if (firstServerRead) {

                lastEventId =
                    currentEventId;

                firstServerRead =
                    false;

                return;
            }


            /*
             * Tidak ada perubahan.
             */

            if (
                currentEventId ===
                lastEventId
            ) {

                return;
            }


            /* =================================================
               12. AKSI BARU TERDETEKSI
            ================================================= */

            lastEventId =
                currentEventId;


            showPopup(
                action,

                data.nomor_tiket ||
                    nomorTiket,

                data.nama_pt ||
                    namaPT,

                waktuAksi
            );


            /* =================================================
               13. JIKA SELESAI
            ================================================= */

            if (
                action ===
                'selesai'
            ) {

                if (
                    pollingTimer
                ) {

                    clearInterval(
                        pollingTimer
                    );

                    pollingTimer =
                        null;
                }
            }


        } catch (error) {

            /*
             * Error polling tidak boleh
             * menghentikan sistem.
             */

            console.error(
                'SITAFAS popup polling error:',
                error
            );


        } finally {

            pollingRunning =
                false;
        }
    }


    /* =========================================================
       14. MULAI POLLING
    ========================================================= */

    /*
     * Cek langsung saat halaman dibuka.
     */

    checkPopupStatus();


    /*
     * Cek setiap 1 detik.
     */

    pollingTimer =
        window.setInterval(
            checkPopupStatus,
            1000
        );


})();
</script>

</body>

</html>