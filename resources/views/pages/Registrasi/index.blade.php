<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kelola Registrasi - SITAFAS
    </title>


    {{-- =====================================================
         FONT POPPINS
    ====================================================== --}}

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


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    {{-- =====================================================
         SIDEBAR CSS
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/sidebar.css') }}"
    >


    {{-- =====================================================
         REGISTRASI CSS
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/registrasi.css') }}"
    >


    <style>

        /* =====================================================
           TAMBAH REGISTRASI
        ===================================================== */

        .btn-add-registration {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 10px 16px;

            border: none;

            border-radius: 8px;

            background: #1d4ed8;

            color: #fff;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;

        }


        .btn-add-registration:hover {

            background: #1e40af;

            transform: translateY(-1px);

        }


        .header-actions {

            display: flex;

            align-items: center;

            gap: 10px;

            flex-wrap: wrap;

        }


        /* =====================================================
           MODAL
        ===================================================== */

        .registration-modal {

            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background: rgba(15, 23, 42, .55);

            backdrop-filter: blur(3px);

        }


        .registration-modal.show {

            display: flex;

        }


        .registration-modal-card {

            width: 100%;

            max-width: 650px;

            max-height: 90vh;

            overflow-y: auto;

            background: #fff;

            border-radius: 16px;

            box-shadow: 0 25px 60px rgba(0,0,0,.20);

            animation: modalShow .2s ease;

        }


        @keyframes modalShow {

            from {

                opacity: 0;

                transform: translateY(-15px) scale(.98);

            }

            to {

                opacity: 1;

                transform: translateY(0) scale(1);

            }

        }


        .registration-modal-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 20px 24px;

            border-bottom: 1px solid #e5e7eb;

        }


        .registration-modal-title {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .registration-modal-title-icon {

            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            background: #eff6ff;

            color: #2563eb;

        }


        .registration-modal-title h3 {

            margin: 0;

            font-size: 17px;

            font-weight: 700;

            color: #111827;

        }


        .registration-modal-title p {

            margin: 3px 0 0;

            font-size: 12px;

            color: #6b7280;

        }


        .modal-close {

            width: 36px;

            height: 36px;

            border: none;

            border-radius: 8px;

            background: #f3f4f6;

            color: #6b7280;

            cursor: pointer;

            font-size: 16px;

        }


        .modal-close:hover {

            background: #fee2e2;

            color: #dc2626;

        }


        .registration-modal-body {

            padding: 24px;

        }


        .form-group {

            margin-bottom: 18px;

        }


        .form-label {

            display: block;

            margin-bottom: 7px;

            font-size: 13px;

            font-weight: 600;

            color: #374151;

        }


        .form-label .required {

            color: #dc2626;

        }


        .form-control {

            width: 100%;

            box-sizing: border-box;

            padding: 11px 13px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            outline: none;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            color: #111827;

            background: #fff;

            transition: .2s ease;

        }


        .form-control:focus {

            border-color: #2563eb;

            box-shadow: 0 0 0 3px rgba(37,99,235,.10);

        }


        .master-info {

            display: none;

            margin-top: 14px;

            padding: 15px;

            border-radius: 10px;

            background: #f8fafc;

            border: 1px solid #e5e7eb;

        }


        .master-info.show {

            display: block;

        }


        .master-info-grid {

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 10px 16px;

        }


        .master-info-item span {

            display: block;

            font-size: 11px;

            color: #6b7280;

            margin-bottom: 3px;

        }


        .master-info-item strong {

            display: block;

            font-size: 12px;

            color: #111827;

        }


        .registration-modal-footer {

            display: flex;

            justify-content: flex-end;

            gap: 10px;

            padding: 18px 24px;

            border-top: 1px solid #e5e7eb;

        }


        .btn-modal {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 10px 16px;

            border: none;

            border-radius: 8px;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

        }


        .btn-modal-cancel {

            background: #f3f4f6;

            color: #374151;

        }


        .btn-modal-save {

            background: #2563eb;

            color: #fff;

        }


        .btn-modal-save:hover {

            background: #1d4ed8;

        }


        .btn-modal:disabled {

            opacity: .6;

            cursor: not-allowed;

        }


        @media (max-width: 650px) {

            .master-info-grid {

                grid-template-columns: 1fr;

            }

            .registration-modal {

                padding: 10px;

            }

            .registration-modal-card {

                max-height: 95vh;

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

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main-content">

        <div class="page-container">


            {{-- =================================================
                 PAGE HEADER
            ================================================== --}}

            <div class="page-header">

                <div class="page-header-left">


                    {{-- HAMBURGER --}}

                    <button
                        type="button"
                        id="mobileMenuButton"
                        class="hamburger-btn"
                        aria-label="Buka/Tutup Sidebar"
                    >

                        <i class="fa-solid fa-bars"></i>

                    </button>


                    {{-- TITLE --}}

                    <div class="page-title-wrapper">

                        <h1 class="page-title">
                            Kelola Registrasi
                        </h1>

                        <p class="page-subtitle">
                            Data registrasi yang dilakukan oleh pengguna
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
                            {{ Auth::user()->nama ?? 'Admin' }}
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 SUCCESS MESSAGE
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
                 ERROR MESSAGE
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
                 VALIDATION ERROR
            ================================================== --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- =================================================
                 DATA CARD
            ================================================== --}}

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


                    <div class="header-actions">

                        {{-- EXPORT --}}

                        <a
                            href="{{ route(
                                'admin.registrasi.export',
                                request()->query()
                            ) }}"
                            class="btn-export"
                        >

                            <i class="fa-solid fa-file-excel"></i>

                            <span>
                                Export Excel
                            </span>

                        </a>

                    </div>

                </div>


                {{-- =================================================
                     FILTER
                ================================================== --}}

                <div class="filter-section">


                    {{-- SEARCH --}}

                    <div class="search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            id="searchRegistrasi"
                            placeholder="Cari nama perguruan tinggi..."
                            autocomplete="off"
                        >

                    </div>


                    {{-- FASWIL FILTER --}}

                    <div class="status-filter">

                        <select id="faswilFilter">

                            <option value="">
                                Semua Faswil
                            </option>

                            @foreach(
                                $masters
                                    ->pluck('nama_faswil')
                                    ->filter()
                                    ->unique()
                                    ->sort()
                                as $namaFaswil
                            )

                                <option
                                    value="{{ strtolower($namaFaswil) }}"
                                >
                                    {{ $namaFaswil }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STATUS FILTER --}}

                    <div class="status-filter">

                        <select id="statusFilter">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="terdaftar">
                                Terdaftar
                            </option>

                            <option value="diproses">
                                Diproses
                            </option>

                            <option value="selesai">
                                Selesai
                            </option>

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     TABLE
                ================================================== --}}

                <div class="table-wrapper">

                    <table
                        class="data-table"
                        id="registrasiTable"
                    >

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
                                    FASWIL
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

                                <th width="100">
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody id="registrasiTableBody">


                            @forelse($registrasis as $registrasi)

                                @php

                                    $master =
                                        $registrasi->master;

                                    $tiket =
                                        $registrasi->tiket;

                                @endphp


                                <tr

                                    data-search="{{ strtolower(
                                        ($master?->nama_pt ?? '') . ' ' .
                                        ($master?->kode_pt ?? '') . ' ' .
                                        ($registrasi->kebutuhan ?? '') . ' ' .
                                        ($tiket?->nomor_tiket ?? '') . ' ' .
                                        ($master?->sesi ?? '') . ' ' .
                                        ($master?->tanggal ?? '') . ' ' .
                                        ($master?->jam_mulai ?? '') . ' ' .
                                        ($master?->jam_selesai ?? '') . ' ' .
                                        ($master?->nama_faswil ?? '') . ' ' .
                                        ($master?->pendamping ?? '')
                                    ) }}"

                                    data-faswil="{{ strtolower(
                                        $master?->nama_faswil ?? ''
                                    ) }}"

                                    data-status="{{ strtolower(
                                        $registrasi->status ?? ''
                                    ) }}"

                                >


                                    {{-- NO --}}

                                    <td>

                                        {{
                                            method_exists(
                                                $registrasis,
                                                'firstItem'
                                            )
                                            ? $registrasis->firstItem()
                                                + $loop->index
                                            : $loop->iteration
                                        }}

                                    </td>


                                    {{-- PERGURUAN TINGGI --}}

                                    <td>

                                        <div class="name-wrapper">

                                            <div class="name-icon">

                                                <i
                                                    class="fa-solid fa-building-columns"
                                                ></i>

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


                                    {{-- NOMOR TIKET --}}

                                    <td>

                                        @if($tiket)

                                            <span
                                                class="ticket-badge"
                                            >

                                                <i
                                                    class="fa-solid fa-ticket"
                                                ></i>

                                                {{
                                                    preg_replace('/^[A-Za-z]+-/', '', $tiket->nomor_tiket) 
                                                }}

                                            </span>

                                        @else

                                            <span
                                                class="text-muted"
                                            >
                                                Belum dibuat
                                            </span>

                                        @endif

                                    </td>


                                    {{-- SESI --}}

                                    <td>

                                        @if($master)

                                            <span
                                                class="session-badge"
                                            >

                                                {{
                                                    $master->sesi
                                                    ?? '-'
                                                }}

                                            </span>

                                        @else

                                            <span
                                                class="text-muted"
                                            >
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TANGGAL JADWAL --}}

                                    <td>

                                        @if($master?->tanggal)

                                            <div
                                                class="date-wrapper"
                                            >

                                                <span>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $master->tanggal
                                                        )->format(
                                                            'd-m-Y'
                                                        )
                                                    }}

                                                </span>


                                                <small>
                                                    Jadwal
                                                </small>

                                            </div>

                                        @else

                                            <span
                                                class="text-muted"
                                            >
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- JAM JADWAL --}}

                                    <td>

                                        @if(
                                            $master?->jam_mulai &&
                                            $master?->jam_selesai
                                        )

                                            <span
                                                class="time-badge"
                                            >

                                                <i
                                                    class="fa-regular fa-clock"
                                                ></i>


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

                                            <span
                                                class="text-muted"
                                            >
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- FASWIL --}}

                                    <td>

                                        {{
                                            $master?->nama_faswil
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- TANGGAL REGISTRASI --}}

                                    <td>

                                        @if(
                                            $registrasi->tgl_registrasi
                                        )

                                            <div
                                                class="date-wrapper"
                                            >

                                                <span>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $registrasi->tgl_registrasi
                                                        )->format(
                                                            'd-m-Y'
                                                        )
                                                    }}

                                                </span>


                                                <small>

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $registrasi->tgl_registrasi
                                                        )->format(
                                                            'H:i'
                                                        )
                                                    }}

                                                </small>

                                            </div>

                                        @else

                                            <span
                                                class="text-muted"
                                            >
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- KEBUTUHAN --}}

                                    <td>

                                        <div
                                            class="kebutuhan-wrapper"
                                        >

                                            {{
                                                $registrasi->kebutuhan
                                                ?: '-'
                                            }}

                                        </div>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if(
                                            $registrasi->status
                                            === 'terdaftar'
                                        )

                                            <span
                                                class="status-badge status-registered"
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
                                                class="status-badge status-processing"
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
                                                class="status-badge status-completed"
                                            >

                                                <span
                                                    class="status-dot"
                                                ></span>

                                                Selesai

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


                                    {{-- AKSI --}}

                                    <td>

                                        <div
                                            class="action-buttons"
                                        >


                                            {{-- DETAIL --}}

                                            <a
                                                href="{{ route(
                                                    'admin.registrasi.show',
                                                    $registrasi->id_registrasi
                                                ) }}"
                                                class="btn-action btn-view"
                                                title="Lihat Detail"
                                            >

                                                <i
                                                    class="fa-solid fa-eye"
                                                ></i>

                                            </a>


                                            {{-- HAPUS --}}

                                            <form
                                                action="{{ route(
                                                    'admin.registrasi.destroy',
                                                    $registrasi->id_registrasi
                                                ) }}"
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm(
                                                    'Apakah Anda yakin ingin menghapus registrasi ini? Data tiket yang terkait juga akan dihapus.'
                                                );"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn-action btn-delete"
                                                    title="Hapus Registrasi"
                                                >

                                                    <i
                                                        class="fa-solid fa-trash"
                                                    ></i>

                                                </button>

                                            </form>


                                        </div>

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="11"
                                        class="empty-data"
                                    >

                                        <div
                                            class="empty-content"
                                        >

                                            <i
                                                class="fa-solid fa-clipboard-list"
                                            ></i>

                                            <p>
                                                Belum ada data registrasi.
                                            </p>

                                            <small>
                                                Registrasi yang berhasil dilakukan akan tampil di sini.
                                            </small>

                                        </div>

                                    </td>

                                </tr>


                            @endforelse


                            {{-- FILTER EMPTY --}}

                            <tr
                                id="emptyFilterRow"
                                style="display:none;"
                            >

                                <td
                                    colspan="11"
                                    class="empty-data"
                                >

                                    <div
                                        class="empty-content"
                                    >

                                        <i
                                            class="fa-solid fa-magnifying-glass"
                                        ></i>

                                        <p
                                            id="emptyFilterText"
                                        >
                                            Data registrasi tidak ditemukan.
                                        </p>

                                    </div>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>


                {{-- =================================================
     PAGINATION KELola REGISTRASI
================================================== --}}

@if($registrasis->hasPages())

    <div class="pagination-wrapper">

        {{-- INFORMASI DATA --}}
        <div class="pagination-info">

            Menampilkan

            <strong>{{ $registrasis->firstItem() }}</strong>

            -

            <strong>{{ $registrasis->lastItem() }}</strong>

            dari

            <strong>{{ $registrasis->total() }}</strong>

            data registrasi

        </div>


        {{-- NOMOR HALAMAN --}}
        <div class="pagination">

            {{-- PREVIOUS --}}
            @if($registrasis->onFirstPage())

                <span class="page-btn disabled">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>

            @else

                <a
                    href="{{ $registrasis->previousPageUrl() }}"
                    class="page-btn"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </a>

            @endif


            {{-- NOMOR HALAMAN --}}
            @foreach($registrasis->getUrlRange(
                max(1, $registrasis->currentPage() - 2),
                min($registrasis->lastPage(), $registrasis->currentPage() + 2)
            ) as $page => $url)

                @if($page == $registrasis->currentPage())

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
            @if($registrasis->hasMorePages())

                <a
                    href="{{ $registrasis->nextPageUrl() }}"
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

        </div>

    </main>


    {{-- =====================================================
         MODAL TAMBAH REGISTRASI
    ====================================================== --}}

    <div
        class="registration-modal"
        id="registrationModal"
    >

        <div
            class="registration-modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="registrationModalTitle"
        >


            {{-- HEADER --}}

            <div
                class="registration-modal-header"
            >

                <div
                    class="registration-modal-title"
                >

                    <div
                        class="registration-modal-title-icon"
                    >

                        <i
                            class="fa-solid fa-user-plus"
                        ></i>

                    </div>


                    <div>

                        <h3
                            id="registrationModalTitle"
                        >
                            Tambah Registrasi
                        </h3>

                        <p>
                            Pilih data Perguruan Tinggi dari Master
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="modal-close"
                    id="closeRegistrationModal"
                >

                    <i
                        class="fa-solid fa-xmark"
                    ></i>

                </button>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route(
                    'registrasi.store'
                ) }}"
                method="POST"
                id="registrationForm"
            >

                @csrf


                <div
                    class="registration-modal-body"
                >


                    {{-- MASTER --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="id_master"
                        >

                            Perguruan Tinggi
                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            name="id_master"
                            id="id_master"
                            class="form-control"
                            required
                        >

                            <option
                                value=""
                            >
                                -- Pilih Perguruan Tinggi --
                            </option>


                            @foreach(
                                $masters
                                as $masterOption
                            )

                                <option
                                    value="{{ $masterOption->id_master }}"
                                    data-kode="{{ $masterOption->kode_pt }}"
                                    data-nama="{{ $masterOption->nama_pt }}"
                                    data-faswil="{{ $masterOption->nama_faswil }}"
                                    data-meja="{{ $masterOption->no_meja }}"
                                    data-sesi="{{ $masterOption->sesi }}"
                                    data-tanggal="{{ $masterOption->tanggal }}"
                                    data-jam-mulai="{{ $masterOption->jam_mulai }}"
                                    data-jam-selesai="{{ $masterOption->jam_selesai }}"
                                    data-pendamping="{{ $masterOption->pendamping }}"
                                >

                                    {{ $masterOption->nama_pt }}

                                    -

                                    {{ $masterOption->sesi }}

                                    -

                                    {{
                                        \Carbon\Carbon::parse(
                                            $masterOption->tanggal
                                        )->format('d-m-Y')
                                    }}

                                </option>

                            @endforeach

                        </select>


                        {{-- MASTER INFO --}}

                        <div
                            class="master-info"
                            id="masterInfo"
                        >

                            <div
                                class="master-info-grid"
                            >


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Kode PT
                                    </span>

                                    <strong
                                        id="infoKode"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Faswil
                                    </span>

                                    <strong
                                        id="infoFaswil"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Nomor Meja
                                    </span>

                                    <strong
                                        id="infoMeja"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Sesi
                                    </span>

                                    <strong
                                        id="infoSesi"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Tanggal
                                    </span>

                                    <strong
                                        id="infoTanggal"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Jam
                                    </span>

                                    <strong
                                        id="infoJam"
                                    >
                                        -
                                    </strong>

                                </div>


                                <div
                                    class="master-info-item"
                                >

                                    <span>
                                        Pendamping
                                    </span>

                                    <strong
                                        id="infoPendamping"
                                    >
                                        -
                                    </strong>

                                </div>


                            </div>

                        </div>

                    </div>


                    {{-- KEBUTUHAN --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="kebutuhan"
                        >

                            Kebutuhan

                            <span class="required">
                                *
                            </span>

                        </label>


                        <textarea
                            name="kebutuhan"
                            id="kebutuhan"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan kebutuhan layanan..."
                            maxlength="1000"
                            required
                        ></textarea>

                    </div>


                </div>


                {{-- FOOTER --}}

                <div
                    class="registration-modal-footer"
                >

                    <button
                        type="button"
                        class="btn-modal btn-modal-cancel"
                        id="cancelRegistrationModal"
                    >

                        <i
                            class="fa-solid fa-xmark"
                        ></i>

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn-modal btn-modal-save"
                        id="saveRegistrationButton"
                    >

                        <i
                            class="fa-solid fa-floppy-disk"
                        ></i>

                        Simpan Registrasi

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
         SIDEBAR JS
    ====================================================== --}}

    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>


    {{-- =====================================================
         SEARCH + FILTER
    ====================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                /*
                |--------------------------------------------------------------------------
                | ELEMENT
                |--------------------------------------------------------------------------
                */

                const searchInput =
                    document.getElementById(
                        'searchRegistrasi'
                    );

                const faswilFilter =
                    document.getElementById(
                        'faswilFilter'
                    );

                const statusFilter =
                    document.getElementById(
                        'statusFilter'
                    );

                const tableBody =
                    document.getElementById(
                        'registrasiTableBody'
                    );

                const emptyFilterRow =
                    document.getElementById(
                        'emptyFilterRow'
                    );

                const emptyFilterText =
                    document.getElementById(
                        'emptyFilterText'
                    );


                /*
                |--------------------------------------------------------------------------
                | FILTER
                |--------------------------------------------------------------------------
                */

                function filterRegistrasi()
                {

                    const searchValue =
                        searchInput.value
                            .toLowerCase()
                            .trim();


                    const faswilValue =
                        faswilFilter.value
                            .toLowerCase()
                            .trim();


                    const statusValue =
                        statusFilter.value
                            .toLowerCase()
                            .trim();


                    const rows =
                        tableBody.querySelectorAll(
                            'tr[data-search]'
                        );


                    let visibleRows = 0;


                    rows.forEach(
                        function (row) {


                            const searchData =
                                (
                                    row.dataset.search
                                    || ''
                                ).toLowerCase();


                            const rowFaswil =
                                (
                                    row.dataset.faswil
                                    || ''
                                ).toLowerCase();


                            const rowStatus =
                                (
                                    row.dataset.status
                                    || ''
                                ).toLowerCase();


                            const matchSearch =
                                searchValue === ''
                                ||
                                searchData.includes(
                                    searchValue
                                );


                            const matchFaswil =
                                faswilValue === ''
                                ||
                                rowFaswil ===
                                    faswilValue;


                            const matchStatus =
                                statusValue === ''
                                ||
                                rowStatus ===
                                    statusValue;


                            if (
                                matchSearch &&
                                matchFaswil &&
                                matchStatus
                            ) {

                                row.style.display =
                                    '';

                                visibleRows++;

                            } else {

                                row.style.display =
                                    'none';

                            }

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | EMPTY FILTER
                    |--------------------------------------------------------------------------
                    */

                    if (
                        rows.length > 0 &&
                        visibleRows === 0
                    ) {

                        emptyFilterRow.style.display =
                            'table-row';


                        if (searchValue) {

                            emptyFilterText.textContent =
                                'Data registrasi yang dicari tidak ditemukan.';

                        }

                        else if (faswilValue) {

                            emptyFilterText.textContent =
                                'Tidak ada registrasi pada Faswil tersebut.';

                        }

                        else if (statusValue) {

                            emptyFilterText.textContent =
                                'Tidak ada registrasi dengan status tersebut.';

                        }

                        else {

                            emptyFilterText.textContent =
                                'Data registrasi tidak ditemukan.';

                        }

                    } else {

                        emptyFilterRow.style.display =
                            'none';

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | EVENT SEARCH
                |--------------------------------------------------------------------------
                */

                if (searchInput) {

                    searchInput.addEventListener(
                        'input',
                        filterRegistrasi
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | EVENT FASWIL
                |--------------------------------------------------------------------------
                */

                if (faswilFilter) {

                    faswilFilter.addEventListener(
                        'change',
                        filterRegistrasi
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | EVENT STATUS
                |--------------------------------------------------------------------------
                */

                if (statusFilter) {

                    statusFilter.addEventListener(
                        'change',
                        filterRegistrasi
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | MODAL
                |--------------------------------------------------------------------------
                */

                const modal =
                    document.getElementById(
                        'registrationModal'
                    );


                const openButton =
                    document.getElementById(
                        'openRegistrationModal'
                    );


                const closeButton =
                    document.getElementById(
                        'closeRegistrationModal'
                    );


                const cancelButton =
                    document.getElementById(
                        'cancelRegistrationModal'
                    );


                function openModal()
                {

                    if (!modal) {
                        return;
                    }

                    modal.classList.add(
                        'show'
                    );

                    document.body.style.overflow =
                        'hidden';

                }


                function closeModal()
                {

                    if (!modal) {
                        return;
                    }

                    modal.classList.remove(
                        'show'
                    );

                    document.body.style.overflow =
                        '';

                }


                if (openButton) {

                    openButton.addEventListener(
                        'click',
                        openModal
                    );

                }


                if (closeButton) {

                    closeButton.addEventListener(
                        'click',
                        closeModal
                    );

                }


                if (cancelButton) {

                    cancelButton.addEventListener(
                        'click',
                        closeModal
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | KLIK LUAR MODAL
                |--------------------------------------------------------------------------
                */

                if (modal) {

                    modal.addEventListener(
                        'click',
                        function (event) {

                            if (
                                event.target ===
                                modal
                            ) {

                                closeModal();

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | ESCAPE
                |--------------------------------------------------------------------------
                */

                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key ===
                            'Escape'
                        ) {

                            closeModal();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | MASTER SELECT
                |--------------------------------------------------------------------------
                */

                const masterSelect =
                    document.getElementById(
                        'id_master'
                    );


                const masterInfo =
                    document.getElementById(
                        'masterInfo'
                    );


                function updateMasterInfo()
                {

                    if (
                        !masterSelect ||
                        !masterInfo
                    ) {

                        return;

                    }


                    const option =
                        masterSelect.options[
                            masterSelect.selectedIndex
                        ];


                    if (
                        !option ||
                        !option.value
                    ) {

                        masterInfo.classList.remove(
                            'show'
                        );

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | DATA MASTER
                    |--------------------------------------------------------------------------
                    */

                    const kode =
                        option.dataset.kode
                        || '-';


                    const faswil =
                        option.dataset.faswil
                        || '-';


                    const meja =
                        option.dataset.meja
                        || '-';


                    const sesi =
                        option.dataset.sesi
                        || '-';


                    const tanggal =
                        option.dataset.tanggal
                        || '-';


                    const jamMulai =
                        option.dataset.jamMulai
                        || '';


                    const jamSelesai =
                        option.dataset.jamSelesai
                        || '';


                    const pendamping =
                        option.dataset.pendamping
                        || '-';


                    /*
                    |--------------------------------------------------------------------------
                    | TAMPILKAN
                    |--------------------------------------------------------------------------
                    */

                    document.getElementById(
                        'infoKode'
                    ).textContent =
                        kode;


                    document.getElementById(
                        'infoFaswil'
                    ).textContent =
                        faswil;


                    document.getElementById(
                        'infoMeja'
                    ).textContent =
                        meja;


                    document.getElementById(
                        'infoSesi'
                    ).textContent =
                        sesi;


                    document.getElementById(
                        'infoTanggal'
                    ).textContent =
                        formatTanggal(
                            tanggal
                        );


                    document.getElementById(
                        'infoJam'
                    ).textContent =
                        formatJam(
                            jamMulai,
                            jamSelesai
                        );


                    document.getElementById(
                        'infoPendamping'
                    ).textContent =
                        pendamping;


                    masterInfo.classList.add(
                        'show'
                    );

                }


                if (masterSelect) {

                    masterSelect.addEventListener(
                        'change',
                        updateMasterInfo
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | FORMAT TANGGAL
                |--------------------------------------------------------------------------
                */

                function formatTanggal(
                    tanggal
                )
                {

                    if (
                        !tanggal ||
                        tanggal === '-'
                    ) {

                        return '-';

                    }


                    const parts =
                        tanggal.split('-');


                    if (
                        parts.length !== 3
                    ) {

                        return tanggal;

                    }


                    return (
                        parts[2] +
                        '-' +
                        parts[1] +
                        '-' +
                        parts[0]
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | FORMAT JAM
                |--------------------------------------------------------------------------
                */

                function formatJam(
                    mulai,
                    selesai
                )
                {

                    if (
                        !mulai ||
                        !selesai
                    ) {

                        return '-';

                    }


                    return (
                        mulai.substring(0, 5) +
                        ' - ' +
                        selesai.substring(0, 5) +
                        ' WIB'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | PREVENT DOUBLE SUBMIT
                |--------------------------------------------------------------------------
                */

                const registrationForm =
                    document.getElementById(
                        'registrationForm'
                    );


                const saveButton =
                    document.getElementById(
                        'saveRegistrationButton'
                    );


                if (registrationForm) {

                    registrationForm.addEventListener(
                        'submit',
                        function () {


                            if (saveButton) {

                                saveButton.disabled =
                                    true;


                                saveButton.innerHTML =

                                    '<i class="fa-solid fa-spinner fa-spin"></i>' +
                                    ' Menyimpan...';

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | AUTO OPEN MODAL JIKA ADA VALIDATION ERROR
                |--------------------------------------------------------------------------
                */

                @if($errors->any())

                    openModal();

                @endif


            }

        );

    </script>


</body>

</html>