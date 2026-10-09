<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah User - SITAFAS</title>


    {{-- =====================================================
         FONT
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


    {{-- =====================================================
         USER CSS
    ====================================================== --}}

    <link rel="stylesheet"
          href="{{ asset('css/user.css') }}">

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

    <main class="main-content">


        {{-- =================================================
             PAGE HEADER
        ================================================== --}}

        <div class="page-header">

            <div class="header-left">


                {{-- =================================================
                     HAMBURGER
                ================================================== --}}

                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Buka menu">

                    <i class="fa-solid fa-bars"></i>

                </button>


                {{-- =================================================
                     TITLE
                ================================================== --}}

                <div>

                    <h1 class="page-title">
                        Tambah User
                    </h1>

                    <p class="page-subtitle">
                        Tambah akun Admin SITAFAS
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

                <div>

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

        <div class="user-form-card">


            {{-- =================================================
                 CARD HEADER
            ================================================== --}}

            <div class="user-form-header">

                <h2>
                    Informasi User
                </h2>

                <p>
                    Isi data berikut untuk membuat akun Admin baru.
                </p>

            </div>



            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                action="{{ route('admin.users.store') }}"
                method="POST"
            >

                @csrf


                <div class="user-form-body">


                    {{-- =================================================
                         NAMA LENGKAP
                    ================================================== --}}

                    <div class="form-group">

                        <label for="nama">

                            Nama Lengkap

                            <span>*</span>

                        </label>


                        <div class="input-wrapper">

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap"
                                autocomplete="name"
                                required
                            >

                        </div>


                        @error('nama')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- =================================================
                         USERNAME
                    ================================================== --}}

                    <div class="form-group">

                        <label for="username">

                            Username

                            <span>*</span>

                        </label>


                        <div class="input-wrapper">

                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                autocomplete="username"
                                required
                            >

                        </div>


                        @error('username')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div class="form-group">

                        <label for="email">

                            Email

                            <span>*</span>

                        </label>


                        <div class="input-wrapper">

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@sitafas.test"
                                autocomplete="email"
                                required
                            >

                        </div>


                        @error('email')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- =================================================
                         ROLE
                    ================================================== --}}

                    <div class="form-group">

                        <label for="role_display">

                            Role User

                            <span>*</span>

                        </label>


                        <div class="input-wrapper">

                            {{-- =================================================
                                 ROLE DITAMPILKAN SEBAGAI ADMIN
                                 TIDAK BISA DIUBAH
                            ================================================== --}}

                            <input
                                type="text"
                                id="role_display"
                                value="Admin"
                                readonly
                                style="
                                    background-color: #f1f5f9;
                                    color: #17466f;
                                    font-weight: 600;
                                    cursor: not-allowed;
                                "
                            >


                            {{-- =================================================
                                 NILAI ROLE YANG DIKIRIM KE CONTROLLER
                            ================================================== --}}

                            <input
                                type="hidden"
                                name="role"
                                value="admin"
                            >

                        </div>


                        <small
                            style="
                                display: block;
                                margin-top: 8px;
                                color: #78909c;
                                font-size: 13px;
                            "
                        >

                            <i class="fa-solid fa-lock"></i>

                            Role user dikunci sebagai Admin.

                        </small>


                        @error('role')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- =================================================
                         PASSWORD
                    ================================================== --}}

                    <div class="form-group">

                        <label for="password">

                            Password

                            <span>*</span>

                        </label>


                        <div class="input-wrapper password-wrapper">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                autocomplete="new-password"
                                required
                            >


                            {{-- TOGGLE PASSWORD --}}

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password"
                                aria-label="Tampilkan password"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>


                        @error('password')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- =================================================
                         KONFIRMASI PASSWORD
                    ================================================== --}}

                    <div class="form-group">

                        <label for="password_confirmation">

                            Konfirmasi Password

                            <span>*</span>

                        </label>


                        <div class="input-wrapper password-wrapper">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                autocomplete="new-password"
                                required
                            >


                            {{-- TOGGLE KONFIRMASI PASSWORD --}}

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_confirmation"
                                aria-label="Tampilkan konfirmasi password"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>


                        @error('password_confirmation')

                            <small class="error-message">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>


                </div>



                {{-- =================================================
                     FORM FOOTER
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
                        class="btn-submit"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Simpan User

                    </button>


                </div>


            </form>

        </div>


    </main>



    {{-- =====================================================
         USER JAVASCRIPT
    ====================================================== --}}

    <script src="{{ asset('js/user.js') }}"></script>


</body>

</html>