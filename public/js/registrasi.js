document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENT
    ===================================================== */

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    const sidebar =
        document.querySelector('.sidebar');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');

    const searchInput =
        document.getElementById('searchRegistrasi');

    const faswilFilter =
        document.getElementById('faswilFilter');

    const statusFilter =
        document.getElementById('statusFilter');

    const tableBody =
        document.getElementById('registrasiTableBody');

    const emptyFilterRow =
        document.getElementById('emptyFilterRow');

    const emptyFilterText =
        document.getElementById('emptyFilterText');


    /* =====================================================
       SIDEBAR
    ===================================================== */

    function toggleSidebar() {

        if (!sidebar) {
            return;
        }

        sidebar.classList.toggle('sidebar-collapsed');

        document.body.classList.toggle('sidebar-closed');

    }


    /* =====================================================
       HAMBURGER CLICK
    ===================================================== */

    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            'click',
            toggleSidebar
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
                    'sidebar-open'
                );

                sidebarOverlay.classList.remove(
                    'active'
                );

            }
        );

    }


    /* =====================================================
       SEARCH + FILTER
    ===================================================== */

    function filterRegistrasi() {

        if (!tableBody) {
            return;
        }


        const searchValue =
            searchInput
                ? searchInput.value
                    .toLowerCase()
                    .trim()
                : '';


        const faswilValue =
            faswilFilter
                ? faswilFilter.value
                    .toLowerCase()
                : '';


        const statusValue =
            statusFilter
                ? statusFilter.value
                    .toLowerCase()
                : '';


        const rows =
            tableBody.querySelectorAll(
                'tr[data-search]'
            );


        let visibleRows = 0;


        rows.forEach(function (row) {


            const searchData =
                row.dataset.search
                    ? row.dataset.search.toLowerCase()
                    : '';


            const rowFaswil =
                row.dataset.faswil
                    ? row.dataset.faswil.toLowerCase()
                    : '';


            const rowStatus =
                row.dataset.status
                    ? row.dataset.status.toLowerCase()
                    : '';


            /* ---------------------------------------------
               CHECK SEARCH
            --------------------------------------------- */

            const matchSearch =
                searchValue === '' ||
                searchData.includes(searchValue);


            /* ---------------------------------------------
               CHECK FASWIL
            --------------------------------------------- */

            const matchFaswil =
                faswilValue === '' ||
                rowFaswil === faswilValue;


            /* ---------------------------------------------
               CHECK STATUS
            --------------------------------------------- */

            const matchStatus =
                statusValue === '' ||
                rowStatus === statusValue;


            /* ---------------------------------------------
               DISPLAY
            --------------------------------------------- */

            if (
                matchSearch &&
                matchFaswil &&
                matchStatus
            ) {

                row.style.display = '';

                visibleRows++;

            } else {

                row.style.display = 'none';

            }

        });


        /* =================================================
           DATA TIDAK DITEMUKAN
        ================================================= */

        if (
            rows.length > 0 &&
            visibleRows === 0
        ) {

            if (emptyFilterRow) {

                emptyFilterRow.style.display =
                    'table-row';

            }


            if (emptyFilterText) {

                emptyFilterText.textContent =
                    'Data registrasi tidak ditemukan.';

            }

        } else {

            if (emptyFilterRow) {

                emptyFilterRow.style.display =
                    'none';

            }

        }

    }


    /* =====================================================
       EVENT SEARCH
    ===================================================== */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            filterRegistrasi
        );

    }


    /* =====================================================
       EVENT FILTER FASWIL
    ===================================================== */

    if (faswilFilter) {

        faswilFilter.addEventListener(
            'change',
            filterRegistrasi
        );

    }


    /* =====================================================
       EVENT FILTER STATUS
    ===================================================== */

    if (statusFilter) {

        statusFilter.addEventListener(
            'change',
            filterRegistrasi
        );

    }


    /* =====================================================
       CLEAR SEARCH DENGAN ESC
    ===================================================== */

    if (searchInput) {

        searchInput.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    searchInput.value = '';

                    filterRegistrasi();

                }

            }
        );

    }


    /* =====================================================
       AUTO HIDE ALERT
    ===================================================== */

    const alerts =
        document.querySelectorAll('.alert');


    alerts.forEach(function (alert) {

        setTimeout(function () {

            alert.style.transition =
                'opacity 0.4s ease';

            alert.style.opacity = '0';


            setTimeout(function () {

                alert.remove();

            }, 400);

        }, 4000);

    });

});