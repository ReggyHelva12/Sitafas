<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | SITAFAS</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

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

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #eef9fc;
            overflow-x: hidden;
            color: #123d63;
        }

        /* =========================================================
           BACKGROUND
        ========================================================= */

        .login-page {
            min-height: 100vh;
            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px 60px;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            border: 10px solid rgba(51, 153, 174, 0.20);
            pointer-events: none;
        }

        .circle-top-left {
            width: 260px;
            height: 260px;
            top: -150px;
            left: -110px;
        }

        .circle-top-left::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border: 10px solid rgba(51, 153, 174, 0.30);
            border-radius: 50%;
            top: 35px;
            left: 35px;
        }

        .circle-bottom-left {
            width: 330px;
            height: 330px;
            bottom: -200px;
            left: -120px;
            border-color: rgba(51, 153, 174, 0.30);
        }

        .circle-bottom-left::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border: 10px solid rgba(51, 153, 174, 0.20);
            border-radius: 50%;
            top: 30px;
            left: 30px;
        }

        .circle-top-right {
            width: 240px;
            height: 240px;
            top: -150px;
            right: -100px;
            border-color: rgba(51, 153, 174, 0.30);
        }

        /* =========================================================
           MAIN CONTAINER
        ========================================================= */

        .login-container {
            width: 100%;
            max-width: 1200px;

            display: grid;
            grid-template-columns: 1fr 1.2fr;

            gap: 70px;

            align-items: center;

            position: relative;
            z-index: 5;
        }

        /* =========================================================
           BRAND
        ========================================================= */

        .brand-section {
            text-align: center;
            order: 1;
        }

        .brand-logo {
            width: 105px;
            height: auto;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .brand-title {
            font-size: 56px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #06345f;
            line-height: 1.1;
        }

        .brand-subtitle {
            margin-top: 5px;
            font-size: 17px;
            color: #111;
            font-weight: 400;
        }

        /* =========================================================
           QUICK TIPS
        ========================================================= */

        .quick-tips {
            margin-top: 65px;
            text-align: left;
            padding-left: 80px;
        }

        .quick-tips h3 {
            font-size: 17px;
            font-weight: 700;
            color: #111;
            margin-bottom: 12px;
        }

        .quick-tips p {
            font-size: 11px;
            line-height: 1.7;
            color: #173b5d;
            max-width: 320px;
        }

        .ticket-illustration {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .ticket-icon {
            font-size: 90px;
            color: #399ba8;
            transform: rotate(-8deg);
        }

        /* =========================================================
           LOGIN CARD
        ========================================================= */

        .login-card {
            background: #ffffff;

            border-radius: 22px;

            padding: 32px 45px 36px;

            box-shadow:
                0 18px 45px rgba(20, 70, 95, 0.13);

            order: 2;
        }

        .login-title {
            text-align: center;

            font-size: 27px;
            font-weight: 700;

            color: #0b3964;

            margin-bottom: 20px;
        }

        /* =========================================================
           SUCCESS / ERROR
        ========================================================= */

        .alert {
            border-radius: 10px;
            padding: 11px 14px;
            margin-bottom: 15px;

            font-size: 13px;
        }

        .alert-success {
            background: #e7f8ef;
            color: #177245;
        }

        .alert-error {
            background: #ffe9e9;
            color: #b42323;
        }

        /* =========================================================
           ADMIN BADGE
        ========================================================= */

        .admin-badge {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            background: #e8f6fb;

            border: 1px solid #cceaf4;

            color: #087ca8;

            padding: 12px;

            border-radius: 12px;

            font-size: 15px;
            font-weight: 600;

            margin-bottom: 22px;
        }

        .admin-badge i {
            font-size: 17px;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;

            font-size: 16px;

            font-weight: 600;

            color: #111;

            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;

            height: 55px;

            border: 1px solid #bfd0dc;

            border-radius: 10px;

            padding: 0 45px 0 17px;

            font-family: 'Poppins', sans-serif;

            font-size: 14px;

            color: #173b5d;

            outline: none;

            transition: 0.2s;
        }

        .input-wrapper input:focus {
            border-color: #168db5;

            box-shadow:
                0 0 0 3px rgba(22, 141, 181, 0.10);
        }

        .input-wrapper input::placeholder {
            color: #9aaabd;
        }

        .password-toggle {
            position: absolute;

            right: 16px;
            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            color: #8fa1af;

            cursor: pointer;

            font-size: 17px;
        }

        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-button {
            width: 100%;

            height: 55px;

            border: none;

            border-radius: 30px;

            background: #123f67;

            color: #fff;

            font-family: 'Poppins', sans-serif;

            font-size: 18px;

            font-weight: 700;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            margin-top: 7px;

            box-shadow:
                0 8px 18px rgba(18, 63, 103, 0.20);

            transition: 0.2s;
        }

        .login-button:hover {
            background: #0c3152;

            transform: translateY(-1px);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .forgot-title {
            text-align: center;

            margin-top: 17px;

            font-size: 15px;

            font-weight: 600;

            color: #073b68;
        }

        .forgot-text {
            text-align: center;

            margin-top: 4px;

            font-size: 13px;

            color: #72869a;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1000px) {

            .login-page {
                padding: 30px;
            }

            .login-container {
                grid-template-columns: 1fr;

                max-width: 550px;

                gap: 35px;
            }

            .brand-section {
                order: 1;
            }

            .login-card {
                order: 2;
            }

            .quick-tips {
                display: none;
            }

            .brand-title {
                font-size: 45px;
            }

            .brand-logo {
                width: 80px;
            }
        }

        @media (max-width: 600px) {

            .login-page {
                padding: 20px;
            }

            .login-card {
                padding: 28px 22px 30px;

                border-radius: 18px;
            }

            .login-title {
                font-size: 23px;
            }

            .brand-title {
                font-size: 38px;
            }

            .brand-subtitle {
                font-size: 14px;
            }

            .form-label {
                font-size: 14px;
            }

            .login-button {
                height: 52px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    {{-- Background --}}
    <div class="circle circle-top-left"></div>
    <div class="circle circle-bottom-left"></div>
    <div class="circle circle-top-right"></div>


    <div class="login-container">

        {{-- =====================================================
             BRAND
        ====================================================== --}}
        <div class="brand-section">

            {{-- Jika logo Anda berada di public/images/logo.png --}}
            <img
                src="{{ asset('images/sitafas-logo.png') }}"
                alt="Logo SITAFAS"
                class="brand-logo"
                onerror="this.style.display='none';"
            >

            <div class="brand-title">
                SITAFAS
            </div>

            <div class="brand-subtitle">
                Sistem Ticketing dan Antrean Faswil
            </div>


            {{-- QUICK TIPS --}}
            <div class="quick-tips">

                <h3>
                    Quick tips
                </h3>

                <p>
                    Gunakan akun administrator yang telah
                    terdaftar untuk mengakses sistem
                    ticketing dan antrean.
                </p>

                <div class="ticket-illustration">

                    <i class="fa-solid fa-ticket ticket-icon"></i>

                </div>

            </div>

        </div>


        {{-- =====================================================
             LOGIN CARD
        ====================================================== --}}
        <div class="login-card">

            <h1 class="login-title">
                Silakan Masuk ke Akun Admin
            </h1>


            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- ERROR MESSAGE --}}
            @if($errors->any())

                <div class="alert alert-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    {{ $errors->first() }}

                </div>

            @endif


            {{-- ADMIN BADGE --}}
            <div class="admin-badge">

                <i class="fa-solid fa-user-shield"></i>

                Login Administrator

            </div>


            {{-- =================================================
                 FORM LOGIN
            ================================================== --}}
            <form
                action="{{ route('login') }}"
                method="POST"
            >

                @csrf


                {{-- USERNAME --}}
                <div class="form-group">

                    <label
                        for="username"
                        class="form-label"
                    >
                        Username
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

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>

                    <div class="input-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                </div>


                {{-- ROLE ADMIN
                     Tidak ditampilkan kepada user.
                     Backend akan selalu menerima admin.
                --}}
                <input
                    type="hidden"
                    name="role"
                    value="admin"
                >


                {{-- LOGIN --}}
                <button
                    type="submit"
                    class="login-button"
                >

                    <span>
                        MASUK
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>


            {{-- FOOTER --}}
            <div class="forgot-title">
                Lupa Kata Sandi?
            </div>

            <div class="forgot-text">
                Silakan hubungi administrator untuk
                perubahan kata sandi.
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | TOGGLE PASSWORD
    |--------------------------------------------------------------------------
    */

    const togglePassword =
        document.getElementById('togglePassword');

    const password =
        document.getElementById('password');


    if (togglePassword && password) {

        togglePassword.addEventListener('click', function () {

            const icon =
                this.querySelector('i');


            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove(
                    'fa-eye'
                );

                icon.classList.add(
                    'fa-eye-slash'
                );

                this.setAttribute(
                    'aria-label',
                    'Sembunyikan password'
                );

            } else {

                password.type = 'password';

                icon.classList.remove(
                    'fa-eye-slash'
                );

                icon.classList.add(
                    'fa-eye'
                );

                this.setAttribute(
                    'aria-label',
                    'Tampilkan password'
                );

            }

        });

    }

</script>

</body>

</html>