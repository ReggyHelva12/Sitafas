<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit User - SITAFAS</title>

    {{-- FONT POPPINS --}}
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

    {{-- SIDEBAR CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/sidebar.css') }}">

    {{-- USER CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/user.css') }}">

    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>


{{-- =====================================================
    SIDEBAR
===================================================== --}}

@include('pages.Layouts.sidebar')


{{-- OVERLAY --}}

<div class="sidebar-overlay"
     id="sidebarOverlay">
</div>



{{-- =====================================================
    MAIN CONTENT
===================================================== --}}

<main class="main-content">


    {{-- =================================================
        PAGE HEADER
    ================================================== --}}

    <div class="page-header">


        {{-- HEADER LEFT --}}

        <div class="header-left">


            {{-- HAMBURGER --}}

            <button type="button"
                    id="mobileMenuButton"
                    class="mobile-menu-button">

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- TITLE --}}

            <div class="page-title-wrapper">

                <h1 class="page-title">
                    Edit User
                </h1>

                <p class="page-subtitle">
                    Ubah data Admin atau Petugas SITAFAS
                </p>

            </div>


        </div>



        {{-- =================================================
            USER LOGIN
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
        FORM CARD
    ================================================== --}}

    <div class="content-card user-form-card">


        {{-- =================================================
            CARD HEADER
        ================================================== --}}

        <div class="content-card-header">


            <div>

                <h2>
                    Informasi User
                </h2>

                <p>
                    Perbarui informasi akun user di bawah ini.
                </p>

            </div>


        </div>



        {{-- =================================================
            VALIDATION ERROR
        ================================================== --}}

        @if($errors->any())

            <div class="form-alert error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <div>

                    <strong>
                        Data belum lengkap
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif



        {{-- =================================================
            FORM
        ================================================== --}}

        <form
            action="{{ route('admin.users.update', $user->id_user) }}"
            method="POST"
            class="user-form"
        >

            @csrf

            @method('PUT')



            {{-- =================================================
                ROW 1
            ================================================== --}}

            <div class="form-grid">


                {{-- NAMA --}}

                <div class="form-group">

                    <label for="nama">

                        Nama Lengkap
                        <span>*</span>

                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-user"></i>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', $user->nama) }}"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                    </div>


                </div>



                {{-- USERNAME --}}

                <div class="form-group">

                    <label for="username">

                        Username
                        <span>*</span>

                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-at"></i>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username', $user->username) }}"
                            placeholder="Masukkan username"
                            required
                        >

                    </div>


                </div>


            </div>



            {{-- =================================================
                ROW 2
            ================================================== --}}

            <div class="form-grid">


                {{-- EMAIL --}}

                <div class="form-group">

                    <label for="email">

                        Email

                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="contoh@sitafas.test"
                        >

                    </div>


                </div>




            </div>



            {{-- =================================================
                ROW 3 PASSWORD
            ================================================== --}}

            <div class="form-grid">


                {{-- PASSWORD BARU --}}

                <div class="form-group">

                    <label for="password">

                        Password Baru

                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Kosongkan jika tidak diubah"
                            autocomplete="new-password"
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password"
                            aria-label="Tampilkan password"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </button>


                    </div>


                    <small class="form-help">

                        Kosongkan jika password tidak ingin diubah.

                    </small>


                </div>



                {{-- KONFIRMASI PASSWORD --}}

                <div class="form-group">

                    <label for="password_confirmation">

                        Konfirmasi Password

                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            autocomplete="new-password"
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                            aria-label="Tampilkan password"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </button>


                    </div>


                </div>


            </div>



            {{-- =================================================
                ROW 4 STATUS
            ================================================== --}}

            <div class="form-grid">


                {{-- STATUS --}}

                <div class="form-group">

                    <label for="status">

                        Status

                    </label>


                    <div class="input-wrapper select-wrapper">

                        <i class="fa-solid fa-circle-check"></i>


                        <select
                            id="status"
                            name="status"
                        >

                            <option
                                value="aktif"
                                {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>


                            <option
                                value="nonaktif"
                                {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}
                            >
                                Nonaktif
                            </option>

                        </select>


                    </div>


                </div>


                <div></div>


            </div>



            {{-- =================================================
                FOOTER BUTTON
            ================================================== --}}

            <div class="user-form-footer">


                {{-- KEMBALI --}}

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn-cancel"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>



                {{-- SIMPAN --}}

                <button
                    type="submit"
                    class="btn-save"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    Simpan Perubahan

                </button>


            </div>


        </form>


    </div>


</main>



{{-- =====================================================
    USER JAVASCRIPT
===================================================== --}}

<script src="{{ asset('js/user.js') }}"></script>



{{-- =====================================================
    SWEET ALERT ERROR
===================================================== --}}

@if($errors->any())

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({

        icon: 'error',

        title: 'Data belum lengkap',

        html: @json(implode('<br>', $errors->all())),

        confirmButtonText: 'OK',

        confirmButtonColor: '#168fc1'

    });

});

</script>

@endif
</body>

</html>