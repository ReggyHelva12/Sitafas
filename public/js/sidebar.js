document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENT SIDEBAR
    ===================================================== */

    const sidebar =
        document.getElementById('sidebar');

    const overlay =
        document.getElementById('sidebarOverlay');

    const body =
        document.body;


    /* =====================================================
       HAMBURGER
       UTAMA: #mobileMenuButton
       Tetap support class lama
    ===================================================== */

    const toggleButton =
        document.getElementById('mobileMenuButton') ||
        document.querySelector('.mobile-menu-button') ||
        document.querySelector('.sidebar-toggle') ||
        document.querySelector('.menu-toggle');


    /* =====================================================
       CEK TOMBOL
    ===================================================== */

    if (!toggleButton) {

        console.warn(
            'Tombol hamburger sidebar tidak ditemukan.'
        );

        return;
    }


    /* =====================================================
       FUNGSI TUTUP SIDEBAR MOBILE
    ===================================================== */

    function closeMobileSidebar() {

        body.classList.remove(
            'sidebar-open'
        );


        if (sidebar) {

            sidebar.classList.remove(
                'show'
            );

        }


        if (overlay) {

            overlay.classList.remove(
                'show'
            );

        }

    }


    /* =====================================================
       FUNGSI BUKA SIDEBAR MOBILE
    ===================================================== */

    function openMobileSidebar() {

        body.classList.add(
            'sidebar-open'
        );


        if (sidebar) {

            sidebar.classList.add(
                'show'
            );

        }


        if (overlay) {

            overlay.classList.add(
                'show'
            );

        }

    }


    /* =====================================================
       FUNGSI TOGGLE SIDEBAR
    ===================================================== */

    function toggleSidebar() {

        /* =================================================
           DESKTOP
        ================================================= */

        if (window.innerWidth > 768) {

            body.classList.toggle(
                'sidebar-closed'
            );

            return;
        }


        /* =================================================
           MOBILE
        ================================================= */

        if (
            body.classList.contains('sidebar-open') ||
            (sidebar && sidebar.classList.contains('show'))
        ) {

            closeMobileSidebar();

        } else {

            openMobileSidebar();

        }

    }


    /* =====================================================
       HAMBURGER CLICK
    ===================================================== */

    toggleButton.addEventListener(
        'click',
        function (e) {

            e.preventDefault();
            e.stopPropagation();

            toggleSidebar();

        }
    );


    /* =====================================================
       OVERLAY MOBILE
    ===================================================== */

    if (overlay) {

        overlay.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                closeMobileSidebar();

            }
        );

    }


    /* =====================================================
       KLIK MENU DI MOBILE
       → SIDEBAR TUTUP
    ===================================================== */

    const sidebarLinks =
        document.querySelectorAll(
            '.sidebar-menu, ' +
            '.sidebar-link, ' +
            '.sidebar-submenu-item'
        );


    sidebarLinks.forEach(function (link) {

        link.addEventListener(
            'click',
            function () {

                if (window.innerWidth <= 768) {

                    closeMobileSidebar();

                }

            }
        );

    });


    /* =====================================================
       ESC → TUTUP SIDEBAR
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (e) {

            if (e.key !== 'Escape') {
                return;
            }


            /* Mobile */

            closeMobileSidebar();


            /* Desktop */

            body.classList.remove(
                'sidebar-closed'
            );


            if (sidebar) {

                sidebar.classList.remove(
                    'closed'
                );

            }

        }
    );


    /* =====================================================
       RESPONSIVE RESET
    ===================================================== */

    window.addEventListener(
        'resize',
        function () {

            /* =============================================
               DESKTOP
            ============================================= */

            if (window.innerWidth > 768) {

                closeMobileSidebar();

            }


            /* =============================================
               MOBILE
            ============================================= */

            else {

                /*
                 * Jangan hapus sidebar-open di sini.
                 * Supaya ketika user sedang membuka sidebar
                 * di mobile, resize kecil tidak langsung
                 * menutupnya.
                 */

                body.classList.remove(
                    'sidebar-closed'
                );

            }

        }
    );

});