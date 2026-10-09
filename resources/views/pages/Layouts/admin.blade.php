<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'SITAFAS')
    </title>


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
         ADMIN / MAIN CSS
    ====================================================== --}}

    <style>

        /* =================================================
           RESET
        ================================================= */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;

            min-height: 100%;

            font-family:
                "Poppins",
                Arial,
                sans-serif;
        }


        body {
            background: #f4f7f9;

            color: #173f50;
        }


        /* =================================================
           MAIN CONTENT
        ================================================= */

        .main-content {

            margin-left: 230px;

            min-height: 100vh;

            padding: 30px;

            background: #f4f7f9;

            transition:
                margin-left 0.3s ease;
        }


        /* =================================================
           MOBILE
        ================================================= */

        @media (max-width: 768px) {

            .main-content {

                margin-left: 0;

                padding: 20px 15px;
            }

        }


        /* =================================================
           Poppins
        ================================================= */

        @import url(
            'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap'
        );

    </style>


    {{-- =====================================================
         PAGE SPECIFIC CSS
    ====================================================== --}}

    @stack('styles')

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('pages.Layouts.sidebar')



    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main-content">

        @yield('content')

    </main>



    {{-- =====================================================
         SIDEBAR JAVASCRIPT
    ====================================================== --}}

    <script src="{{ asset('js/sidebar.js') }}"></script>



    {{-- =====================================================
         PAGE SPECIFIC JAVASCRIPT
    ====================================================== --}}

    @stack('scripts')


</body>

</html>