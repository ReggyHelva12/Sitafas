document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENT
    ===================================================== */

    const sidebar = document.getElementById('sidebar');
    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    /* =====================================================
       CEK ELEMENT
    ===================================================== */

    if (!sidebar || !mobileMenuButton) {
        console.warn(
            'Sidebar atau tombol hamburger tidak ditemukan.'
        );

        return;
    }


    /* =====================================================
       BREAKPOINT
       <= 900px = MOBILE / TABLET
       > 900px  = DESKTOP
    ===================================================== */

    function isMobile() {
        return window.innerWidth <= 900;
    }


    /* =====================================================
       UPDATE ARIA
    ===================================================== */

    function updateAria() {

        let isOpen;

        if (isMobile()) {

            isOpen =
                sidebar.classList.contains('open');

        } else {

            isOpen =
                !document.body.classList.contains(
                    'sidebar-closed'
                );

        }

        mobileMenuButton.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );
    }


    /* =====================================================
       BUKA SIDEBAR DESKTOP
    ===================================================== */

    function openDesktopSidebar() {

        /*
         * Hapus status sidebar tertutup
         */
        document.body.classList.remove(
            'sidebar-closed'
        );

        /*
         * Hapus class closed dari sidebar
         */
        sidebar.classList.remove('closed');

        updateAria();
    }


    /* =====================================================
       TUTUP SIDEBAR DESKTOP
    ===================================================== */

    function closeDesktopSidebar() {

        /*
         * Class ini digunakan CSS untuk:
         *
         * 1. mengecilkan / menyembunyikan sidebar
         * 2. menggeser main-content
         */
        document.body.classList.add(
            'sidebar-closed'
        );

        /*
         * Tetap tambahkan class closed
         * untuk kompatibilitas dengan CSS lama.
         */
        sidebar.classList.add('closed');

        updateAria();
    }


    /* =====================================================
       BUKA SIDEBAR MOBILE
    ===================================================== */

    function openMobileSidebar() {

        /*
         * Pastikan sidebar desktop tidak aktif
         */
        document.body.classList.remove(
            'sidebar-closed'
        );

        sidebar.classList.remove('closed');

        /*
         * Buka sidebar mobile
         */
        sidebar.classList.add('open');

        /*
         * Aktifkan overlay
         */
        document.body.classList.add(
            'sidebar-open'
        );

        updateAria();
    }


    /* =====================================================
       TUTUP SIDEBAR MOBILE
    ===================================================== */

    function closeMobileSidebar() {

        /*
         * Tutup sidebar
         */
        sidebar.classList.remove('open');

        /*
         * Hilangkan overlay
         */
        document.body.classList.remove(
            'sidebar-open'
        );

        updateAria();
    }


    /* =====================================================
       TOGGLE SIDEBAR
    ===================================================== */

    mobileMenuButton.addEventListener(
        'click',
        function (event) {

            event.preventDefault();

            /* =================================================
               MOBILE / TABLET
            ================================================= */

            if (isMobile()) {

                const isOpen =
                    sidebar.classList.contains('open');

                if (isOpen) {

                    closeMobileSidebar();

                } else {

                    openMobileSidebar();

                }

                return;
            }


            /* =================================================
               DESKTOP
            ================================================= */

            const isClosed =
                document.body.classList.contains(
                    'sidebar-closed'
                );


            if (isClosed) {

                /*
                 * BUKA SIDEBAR
                 */
                openDesktopSidebar();

            } else {

                /*
                 * TUTUP SIDEBAR
                 */
                closeDesktopSidebar();

            }

        }
    );


    /* =====================================================
       OVERLAY MOBILE
    ===================================================== */

    if (sidebarOverlay) {

        sidebarOverlay.addEventListener(
            'click',
            function () {

                if (isMobile()) {

                    closeMobileSidebar();

                }

            }
        );

    }


    /* =====================================================
       MENU SIDEBAR
       Saat menu diklik di mobile,
       sidebar otomatis ditutup.
    ===================================================== */

    const sidebarMenus =
        document.querySelectorAll(
            '.sidebar-menu'
        );


    sidebarMenus.forEach(function (menu) {

        menu.addEventListener(
            'click',
            function () {

                if (isMobile()) {

                    closeMobileSidebar();

                }

            }
        );

    });


    /* =====================================================
       HANDLE ESCAPE
       Tekan ESC untuk menutup sidebar mobile.
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                if (isMobile()) {

                    closeMobileSidebar();

                }

            }

        }
    );


    /* =====================================================
       HANDLE RESIZE
    ===================================================== */

    let previousMobileState =
        isMobile();


    window.addEventListener(
        'resize',
        function () {

            const currentMobileState =
                isMobile();


            /*
             * Tidak ada perubahan jenis device
             */
            if (
                currentMobileState ===
                previousMobileState
            ) {

                updateAria();

                return;
            }


            /* =================================================
               DESKTOP -> MOBILE
            ================================================= */

            if (currentMobileState) {

                /*
                 * Bersihkan status desktop
                 */
                document.body.classList.remove(
                    'sidebar-closed'
                );

                sidebar.classList.remove(
                    'closed'
                );

                /*
                 * Sidebar mobile
                 * dimulai dalam keadaan tertutup
                 */
                sidebar.classList.remove(
                    'open'
                );

                document.body.classList.remove(
                    'sidebar-open'
                );

            }


            /* =================================================
               MOBILE -> DESKTOP
            ================================================= */

            else {

                /*
                 * Bersihkan status mobile
                 */
                sidebar.classList.remove(
                    'open'
                );

                document.body.classList.remove(
                    'sidebar-open'
                );

                /*
                 * Saat kembali ke desktop,
                 * sidebar dibuka.
                 */
                openDesktopSidebar();

            }


            previousMobileState =
                currentMobileState;

            updateAria();

        }
    );


    /* =====================================================
       STATUS AWAL
    ===================================================== */

    if (isMobile()) {

        /*
         * MOBILE:
         * sidebar tertutup terlebih dahulu
         */
        sidebar.classList.remove('open');

        sidebar.classList.remove('closed');

        document.body.classList.remove(
            'sidebar-closed'
        );

        document.body.classList.remove(
            'sidebar-open'
        );

    } else {

        /*
         * DESKTOP:
         * sidebar terbuka
         */
        sidebar.classList.remove('closed');

        document.body.classList.remove(
            'sidebar-closed'
        );

        document.body.classList.remove(
            'sidebar-open'
        );

    }


    /* =====================================================
       SET ARIA AWAL
    ===================================================== */

    updateAria();

});