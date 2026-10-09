document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       SIDEBAR
    ===================================================== */

    const sidebar =
        document.getElementById('sidebar');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    const menuToggle =
        document.getElementById('menuToggle') ||
        document.querySelector('.menu-toggle') ||
        document.querySelector('.sidebar-toggle') ||
        document.querySelector('.header-menu-btn') ||
        document.querySelector('.mobile-menu-button');


    /* =====================================================
       TOGGLE SIDEBAR
    ===================================================== */

    function toggleSidebar() {

        if (!sidebar) return;


        /* ================================
           DESKTOP
        ================================= */

        if (window.innerWidth > 992) {

            sidebar.classList.toggle('closed');

            document.body.classList.toggle(
                'sidebar-closed'
            );

        }


        /* ================================
           MOBILE / TABLET
        ================================= */

        else {

            sidebar.classList.toggle('show');

            if (sidebarOverlay) {

                sidebarOverlay.classList.toggle(
                    'show'
                );

            }

        }

    }


    /* =====================================================
       HAMBURGER
    ===================================================== */

    if (menuToggle) {

        menuToggle.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                toggleSidebar();

            }
        );

    }


    /* =====================================================
       OVERLAY MOBILE
    ===================================================== */

    if (sidebarOverlay) {

        sidebarOverlay.addEventListener(
            'click',
            function () {

                sidebar.classList.remove(
                    'show'
                );

                sidebarOverlay.classList.remove(
                    'show'
                );

            }
        );

    }


    /* =====================================================
       SUBMENU PENGATURAN
    ===================================================== */

    const pengaturanMenu =
        document.getElementById(
            'pengaturanMenu'
        );

    const pengaturanSubmenu =
        document.getElementById(
            'pengaturanSubmenu'
        );


    if (
        pengaturanMenu &&
        pengaturanSubmenu
    ) {

        pengaturanMenu.addEventListener(
            'click',
            function (e) {

                e.preventDefault();

                pengaturanMenu.classList.toggle(
                    'open'
                );

                pengaturanSubmenu.classList.toggle(
                    'show'
                );

            }
        );

    }


    /* =====================================================
       ESC
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (e) {

            if (e.key !== 'Escape') return;


            if (window.innerWidth > 992) {

                sidebar?.classList.remove(
                    'closed'
                );

                document.body.classList.remove(
                    'sidebar-closed'
                );

            }


            else {

                sidebar?.classList.remove(
                    'show'
                );

                sidebarOverlay?.classList.remove(
                    'show'
                );

            }

        }
    );


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    window.addEventListener(
        'resize',
        function () {

            if (!sidebar) return;


            if (window.innerWidth > 992) {

                sidebar.classList.remove(
                    'show'
                );

                sidebarOverlay?.classList.remove(
                    'show'
                );

            }

            else {

                sidebar.classList.remove(
                    'closed'
                );

                document.body.classList.remove(
                    'sidebar-closed'
                );

            }

        }
    );


    /* =====================================================
       AUTO OPEN SUBMENU
    ===================================================== */

    if (
        pengaturanMenu &&
        pengaturanSubmenu
    ) {

        if (
            pengaturanMenu.classList.contains(
                'open'
            ) ||
            pengaturanSubmenu.classList.contains(
                'show'
            )
        ) {

            pengaturanMenu.classList.add(
                'open'
            );

            pengaturanSubmenu.classList.add(
                'show'
            );

        }

    }


    /* =====================================================
       SUCCESS ALERT
       HILANG SETELAH 4 DETIK
    ===================================================== */

    const successAlert =
        document.getElementById(
            'successAlert'
        );


    if (successAlert) {

        setTimeout(
            function () {

                successAlert.classList.add(
                    'hide'
                );


                setTimeout(
                    function () {

                        successAlert.remove();

                    },
                    300
                );

            },
            4000
        );

    }

});