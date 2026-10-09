/* =====================================================
   SITAFAS - MONITOR ANTREAN JAVASCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENT
    ===================================================== */

    const menuButton =
        document.getElementById("mobileMenuButton");

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("sidebarOverlay");

    const searchInput =
        document.getElementById("searchTicket");

    const statusFilter =
        document.getElementById("statusFilter");

    const table =
        document.querySelector(".monitor-table");


    /* =====================================================
       HAMBURGER SIDEBAR
    ===================================================== */

    if (menuButton && sidebar) {

        menuButton.addEventListener("click", function (event) {

            event.preventDefault();
            event.stopPropagation();

            /* MOBILE */

            if (window.innerWidth <= 768) {

                sidebar.classList.toggle("show");

                if (overlay) {
                    overlay.classList.toggle("show");
                }

            }

            /* DESKTOP */

            else {

                sidebar.classList.toggle("closed");

                document.body.classList.toggle(
                    "sidebar-closed"
                );

            }

        });

    }


    /* =====================================================
       OVERLAY MOBILE
    ===================================================== */

    if (overlay && sidebar) {

        overlay.addEventListener("click", function () {

            sidebar.classList.remove("show");

            overlay.classList.remove("show");

        });

    }


    /* =====================================================
       MENU SIDEBAR MOBILE
    ===================================================== */

    if (sidebar) {

        const menuItems =
            sidebar.querySelectorAll("a");

        menuItems.forEach(function (item) {

            item.addEventListener("click", function () {

                if (window.innerWidth <= 768) {

                    sidebar.classList.remove("show");

                    if (overlay) {
                        overlay.classList.remove("show");
                    }

                }

            });

        });

    }


    /* =====================================================
       ESC
    ===================================================== */

    document.addEventListener("keydown", function (event) {

        if (event.key === "Escape") {

            if (sidebar) {

                sidebar.classList.remove("show");
                sidebar.classList.remove("closed");

            }

            if (overlay) {

                overlay.classList.remove("show");

            }

            document.body.classList.remove(
                "sidebar-closed"
            );

        }

    });


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    window.addEventListener("resize", function () {

        if (window.innerWidth > 768) {

            if (sidebar) {
                sidebar.classList.remove("show");
            }

            if (overlay) {
                overlay.classList.remove("show");
            }

        }

    });


    /* =====================================================
       SEARCH
    ===================================================== */

    if (searchInput) {

        searchInput.addEventListener(
            "input",
            function () {

                filterTickets();

            }
        );

    }


    /* =====================================================
       FILTER STATUS
    ===================================================== */

    if (statusFilter) {

        statusFilter.addEventListener(
            "change",
            function () {

                filterTickets();

            }
        );

    }


    /* =====================================================
       FILTER TICKETS
    ===================================================== */

    function filterTickets() {

        if (!table) {
            return;
        }

        const searchValue =
            searchInput
                ? searchInput.value
                    .toLowerCase()
                    .trim()
                : "";


        const statusValue =
            statusFilter
                ? statusFilter.value
                    .toLowerCase()
                : "";


        const rows =
            table.querySelectorAll(
                "tbody tr[data-ticket-row]"
            );


        let visibleCount = 0;


        rows.forEach(function (row) {

            const text =
                row.innerText.toLowerCase();


            const rowStatus =
                row.dataset.status
                    ? row.dataset.status.toLowerCase()
                    : "";


            const matchSearch =
                text.includes(searchValue);


            const matchStatus =
                statusValue === "" ||
                statusValue === "semua" ||
                rowStatus === statusValue;


            if (
                matchSearch &&
                matchStatus
            ) {

                row.style.display = "";

                visibleCount++;

            } else {

                row.style.display = "none";

            }

        });


        updateSearchEmpty(visibleCount);

    }


    /* =====================================================
       SEARCH EMPTY
    ===================================================== */

    function updateSearchEmpty(count) {

        if (!table) {
            return;
        }


        let emptyRow =
            table.querySelector(
                ".search-empty-row"
            );


        if (count === 0) {

            if (!emptyRow) {

                emptyRow =
                    document.createElement("tr");

                emptyRow.className =
                    "search-empty-row";


                emptyRow.innerHTML = `
                    <td colspan="7">
                        <div class="monitor-empty">
                            <div class="monitor-empty-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <strong>
                                Data tidak ditemukan
                            </strong>

                            <span>
                                Tidak ada tiket yang sesuai dengan pencarian.
                            </span>
                        </div>
                    </td>
                `;


                const tbody =
                    table.querySelector("tbody");


                if (tbody) {
                    tbody.appendChild(emptyRow);
                }

            }

        } else {

            if (emptyRow) {
                emptyRow.remove();
            }

        }

    }


    /* =====================================================
       KONFIRMASI PANGGIL
    ===================================================== */

    const callForms =
        document.querySelectorAll(
            ".panggil-ticket-form"
        );


    callForms.forEach(function (form) {

        form.addEventListener(
            "submit",
            function (event) {

                const nomor =
                    form.dataset.ticket ||
                    "tiket ini";


                const confirmation =
                    confirm(
                        "Panggil " +
                        nomor +
                        " sekarang?"
                    );


                if (!confirmation) {

                    event.preventDefault();

                }

            }
        );

    });


    /* =====================================================
       KONFIRMASI SELESAI
    ===================================================== */

    const finishForms =
        document.querySelectorAll(
            ".selesai-ticket-form"
        );


    finishForms.forEach(function (form) {

        form.addEventListener(
            "submit",
            function (event) {

                const nomor =
                    form.dataset.ticket ||
                    "tiket ini";


                const confirmation =
                    confirm(
                        "Apakah pelayanan untuk " +
                        nomor +
                        " sudah selesai?"
                    );


                if (!confirmation) {

                    event.preventDefault();

                }

            }
        );

    });


    /* =====================================================
       AUTO HIDE ALERT
    ===================================================== */

    const alerts =
        document.querySelectorAll(
            ".monitor-alert"
        );


    alerts.forEach(function (alert) {

        setTimeout(function () {

            alert.style.opacity = "0";

            alert.style.transform =
                "translateY(-5px)";

            alert.style.transition =
                "all 0.3s ease";


            setTimeout(function () {

                alert.remove();

            }, 300);

        }, 4000);

    });


});