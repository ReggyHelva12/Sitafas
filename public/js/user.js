document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENT
    ===================================================== */

    const body = document.body;

    const sidebar =
        document.getElementById('sidebar') ||
        document.querySelector('.sidebar');

    const overlay =
        document.getElementById('sidebarOverlay');

    const mainContent =
        document.querySelector('main.main-content') ||
        document.querySelector('.main-content');

    const toggleButton =
        document.getElementById('sidebarToggle') ||
        document.getElementById('mobileMenuButton') ||
        document.querySelector('.sidebar-toggle') ||
        document.querySelector('.mobile-menu-button') ||
        document.querySelector('.hamburger-btn');


    /* =====================================================
       SIDEBAR WIDTH
       Ambil ukuran sidebar saat normal
    ===================================================== */

    let sidebarWidth = 230;

    if (sidebar) {

        const computedSidebar =
            window.getComputedStyle(sidebar);

        const width =
            parseFloat(computedSidebar.width);

        if (!isNaN(width) && width > 0) {
            sidebarWidth = width;
        }

    }


    /* =====================================================
       UPDATE MAIN CONTENT
       INI YANG MEMBUAT HALAMAN IKUT BERGESER
    ===================================================== */

    function updateMainContent() {

        if (!mainContent) {
            return;
        }


        /* =================================================
           MOBILE / TABLET
        ================================================= */

        if (window.innerWidth <= 992) {

            mainContent.style.setProperty(
                'margin-left',
                '0px',
                'important'
            );

            mainContent.style.setProperty(
                'width',
                '100%',
                'important'
            );

            return;
        }


        /* =================================================
           DESKTOP
        ================================================= */

        const isClosed =
            body.classList.contains('sidebar-closed');


        if (isClosed) {

            /*
             * SIDEBAR TERTUTUP
             *
             * Main content menjadi full layar
             */

            mainContent.style.setProperty(
                'margin-left',
                '0px',
                'important'
            );

            mainContent.style.setProperty(
                'width',
                '100%',
                'important'
            );

        } else {

            /*
             * SIDEBAR TERBUKA
             *
             * Main content memberi ruang untuk sidebar
             */

            mainContent.style.setProperty(
                'margin-left',
                sidebarWidth + 'px',
                'important'
            );

            mainContent.style.setProperty(
                'width',
                'calc(100% - ' + sidebarWidth + 'px)',
                'important'
            );

        }

    }


    /* =====================================================
       UPDATE SIDEBAR
    ===================================================== */

    function updateSidebar() {

        if (!sidebar) {
            return;
        }


        /* =================================================
           DESKTOP
        ================================================= */

        if (window.innerWidth > 992) {

            const isClosed =
                body.classList.contains(
                    'sidebar-closed'
                );


            sidebar.classList.toggle(
                'closed',
                isClosed
            );


            sidebar.classList.remove(
                'show'
            );


            body.classList.remove(
                'sidebar-open'
            );


            if (overlay) {

                overlay.classList.remove(
                    'show'
                );

                overlay.classList.remove(
                    'active'
                );

            }

        }


        /* =================================================
           MOBILE / TABLET
        ================================================= */

        else {

            body.classList.remove(
                'sidebar-closed'
            );

            sidebar.classList.remove(
                'closed'
            );


            const isOpen =
                body.classList.contains(
                    'sidebar-open'
                );


            sidebar.classList.toggle(
                'show',
                isOpen
            );


            if (overlay) {

                overlay.classList.toggle(
                    'show',
                    isOpen
                );

                overlay.classList.toggle(
                    'active',
                    isOpen
                );

            }

        }

    }


    /* =====================================================
       TOGGLE SIDEBAR
    ===================================================== */

    function toggleSidebar(event) {

        if (event) {

            event.preventDefault();
            event.stopPropagation();

        }


        if (!sidebar) {
            return;
        }


        /* =================================================
           DESKTOP
        ================================================= */

        if (window.innerWidth > 992) {

            const willClose =
                !body.classList.contains(
                    'sidebar-closed'
                );


            body.classList.toggle(
                'sidebar-closed',
                willClose
            );


            sidebar.classList.toggle(
                'closed',
                willClose
            );


            /*
             * LANGSUNG geser main-content
             */

            updateMainContent();

        }


        /* =================================================
           MOBILE / TABLET
        ================================================= */

        else {

            const willOpen =
                !body.classList.contains(
                    'sidebar-open'
                );


            body.classList.toggle(
                'sidebar-open',
                willOpen
            );


            sidebar.classList.toggle(
                'show',
                willOpen
            );


            if (overlay) {

                overlay.classList.toggle(
                    'show',
                    willOpen
                );

                overlay.classList.toggle(
                    'active',
                    willOpen
                );

            }


            /*
             * Mobile main-content tetap full width
             */

            updateMainContent();

        }

    }


    /* =====================================================
       HAMBURGER CLICK
    ===================================================== */

    if (toggleButton) {

        toggleButton.addEventListener(
            'click',
            toggleSidebar
        );

    } else {

        console.warn(
            'Tombol hamburger tidak ditemukan.'
        );

    }


    /* =====================================================
       OVERLAY MOBILE
    ===================================================== */

    if (overlay) {

        overlay.addEventListener(
            'click',
            function () {

                body.classList.remove(
                    'sidebar-open'
                );

                sidebar?.classList.remove(
                    'show'
                );

                overlay.classList.remove(
                    'show'
                );

                overlay.classList.remove(
                    'active'
                );

            }
        );

    }


    /* =====================================================
       ESC KEY
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            /* MOBILE */

            if (window.innerWidth <= 992) {

                body.classList.remove(
                    'sidebar-open'
                );

                sidebar?.classList.remove(
                    'show'
                );

                overlay?.classList.remove(
                    'show'
                );

                overlay?.classList.remove(
                    'active'
                );

            }


            /* DESKTOP */

            else {

                body.classList.remove(
                    'sidebar-closed'
                );

                sidebar?.classList.remove(
                    'closed'
                );

            }


            updateMainContent();

        }
    );


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    window.addEventListener(
        'resize',
        function () {

            /*
             * Perbarui ukuran sidebar saat resize
             */

            if (sidebar) {

                /*
                 * Hanya ambil ukuran jika sidebar
                 * sedang terbuka secara normal
                 */

                if (
                    !body.classList.contains(
                        'sidebar-closed'
                    )
                ) {

                    const width =
                        parseFloat(
                            window.getComputedStyle(
                                sidebar
                            ).width
                        );

                    if (
                        !isNaN(width) &&
                        width > 0
                    ) {

                        sidebarWidth = width;

                    }

                }

            }


            /*
             * Desktop
             */

            if (window.innerWidth > 992) {

                body.classList.remove(
                    'sidebar-open'
                );

                sidebar?.classList.remove(
                    'show'
                );

                overlay?.classList.remove(
                    'show'
                );

                overlay?.classList.remove(
                    'active'
                );

            }


            /*
             * Mobile
             */

            else {

                body.classList.remove(
                    'sidebar-closed'
                );

                sidebar?.classList.remove(
                    'closed'
                );

            }


            updateSidebar();
            updateMainContent();

        }
    );


    /* =====================================================
       PASSWORD TOGGLE
       Digunakan oleh create/edit user
    ===================================================== */

    const passwordButtons =
        document.querySelectorAll(
            '.password-toggle'
        );


    passwordButtons.forEach(
        function (button) {

            button.addEventListener(
                'click',
                function () {

                    const targetId =
                        this.dataset.target;


                    const input =
                        document.getElementById(
                            targetId
                        );


                    const icon =
                        this.querySelector('i');


                    if (!input) {
                        return;
                    }


                    if (
                        input.type === 'password'
                    ) {

                        input.type = 'text';


                        if (icon) {

                            icon.classList.remove(
                                'fa-eye'
                            );

                            icon.classList.add(
                                'fa-eye-slash'
                            );

                        }


                        this.setAttribute(
                            'aria-label',
                            'Sembunyikan password'
                        );

                    } else {

                        input.type = 'password';


                        if (icon) {

                            icon.classList.remove(
                                'fa-eye-slash'
                            );

                            icon.classList.add(
                                'fa-eye'
                            );

                        }


                        this.setAttribute(
                            'aria-label',
                            'Tampilkan password'
                        );

                    }

                }
            );

        }
    );


    /* =====================================================
       DELETE USER / PT / FASWIL
    ===================================================== */

    const deleteButtons =
        document.querySelectorAll(
            '.delete-user, .delete-pt, .delete-faswil'
        );


    deleteButtons.forEach(
        function (button) {

            button.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();


                    const form =
                        this.closest('form');


                    if (!form) {
                        return;
                    }


                    const nama =
                        this.dataset.name ||
                        this.dataset.nama ||
                        'data ini';


                    /* SWEET ALERT */

                    if (
                        typeof Swal !== 'undefined'
                    ) {

                        Swal.fire({

                            title: 'Hapus Data?',

                            text:
                                'Data "' +
                                nama +
                                '" akan dihapus dan tidak dapat dikembalikan.',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonColor: '#d33',

                            cancelButtonColor:
                                '#6c757d',

                            confirmButtonText:
                                'Ya, Hapus',

                            cancelButtonText:
                                'Batal'

                        }).then(
                            function (result) {

                                if (
                                    result.isConfirmed
                                ) {

                                    form.submit();

                                }

                            }
                        );

                    }


                    /* FALLBACK */

                    else {

                        const confirmed =
                            confirm(
                                'Apakah Anda yakin ingin menghapus ' +
                                nama +
                                '?'
                            );


                        if (confirmed) {

                            form.submit();

                        }

                    }

                }
            );

        }
    );


    /* =====================================================
       PENGATURAN SUBMENU
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
            function (event) {

                event.preventDefault();


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
       INITIAL STATE
    ===================================================== */

    updateSidebar();
    updateMainContent();

});