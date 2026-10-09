document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENT
    ====================================================== */

    const searchInput =
        document.getElementById('searchTiket');

    const wilayahFilter =
        document.getElementById('wilayahFilter');

    const statusFilter =
        document.getElementById('statusFilter');

    const tableBody =
        document.getElementById('tiketTableBody');

    const emptyFilterRow =
        document.getElementById('emptyFilterRow');

    const emptyFilterText =
        document.getElementById('emptyFilterText');

    const visibleCount =
        document.getElementById('visibleCount');


    /* =====================================================
       CEK ELEMENT
    ====================================================== */

    if (!tableBody) {
        return;
    }


    /* =====================================================
       FILTER TIKET
    ====================================================== */

    function filterTiket() {

        const searchValue =
            searchInput
                ? searchInput.value.toLowerCase().trim()
                : '';

        const wilayahValue =
            wilayahFilter
                ? wilayahFilter.value.toLowerCase()
                : '';

        const statusValue =
            statusFilter
                ? statusFilter.value.toLowerCase()
                : '';


        const rows =
            tableBody.querySelectorAll(
                'tr[data-search]'
            );


        let visibleRows = 0;


        /* =================================================
           LOOP DATA
        ================================================= */

        rows.forEach(function (row) {

            const searchData =
                row.dataset.search
                    ? row.dataset.search.toLowerCase()
                    : '';

            const rowWilayah =
                row.dataset.wilayah
                    ? row.dataset.wilayah.toLowerCase()
                    : '';

            const rowStatus =
                row.dataset.status
                    ? row.dataset.status.toLowerCase()
                    : '';


            /* SEARCH */

            const matchSearch =
                searchValue === '' ||
                searchData.includes(searchValue);


            /* WILAYAH */

            const matchWilayah =
                wilayahValue === '' ||
                rowWilayah === wilayahValue;


            /* STATUS */

            const matchStatus =
                statusValue === '' ||
                rowStatus === statusValue;


            /* =================================================
               TAMPILKAN / SEMBUNYIKAN
            ================================================== */

            if (
                matchSearch &&
                matchWilayah &&
                matchStatus
            ) {

                row.style.display = '';

                visibleRows++;

            } else {

                row.style.display = 'none';

            }

        });


        /* =====================================================
           UPDATE JUMLAH DATA
        ====================================================== */

        if (visibleCount) {

            visibleCount.textContent =
                visibleRows;

        }


        /* =====================================================
           DATA FILTER KOSONG
        ====================================================== */

        if (
            rows.length > 0 &&
            visibleRows === 0
        ) {

            if (emptyFilterRow) {

                emptyFilterRow.style.display =
                    'table-row';

            }


            if (emptyFilterText) {

                if (searchValue !== '') {

                    emptyFilterText.textContent =
                        'Data tiket yang dicari tidak ditemukan.';

                } else if (wilayahValue !== '') {

                    emptyFilterText.textContent =
                        'Tidak ada tiket pada wilayah tersebut.';

                } else if (statusValue !== '') {

                    emptyFilterText.textContent =
                        'Tidak ada tiket dengan status tersebut.';

                } else {

                    emptyFilterText.textContent =
                        'Data tiket tidak ditemukan.';

                }

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
    ====================================================== */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            filterTiket
        );

    }


    /* =====================================================
       EVENT FILTER WILAYAH
    ====================================================== */

    if (wilayahFilter) {

        wilayahFilter.addEventListener(
            'change',
            filterTiket
        );

    }


    /* =====================================================
       EVENT FILTER STATUS
    ====================================================== */

    if (statusFilter) {

        statusFilter.addEventListener(
            'change',
            filterTiket
        );

    }


    /* =====================================================
       FILTER SAAT HALAMAN PERTAMA DIBUKA
    ====================================================== */

    filterTiket();

});