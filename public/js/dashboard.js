/* =====================================================
   SITAFAS DASHBOARD JAVASCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", function () {


    /* =================================================
       TANGGAL
    ================================================= */

    const currentDate =
        document.getElementById("currentDate");

    if (currentDate) {

        const today = new Date();

        const options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric"
        };

        currentDate.textContent =
            today.toLocaleDateString(
                "id-ID",
                options
            );
    }


    /* =================================================
       CHART TIKET
    ================================================= */

    const canvas =
        document.getElementById("ticketChart");

    if (
        canvas &&
        typeof Chart !== "undefined"
    ) {

        const ctx =
            canvas.getContext("2d");


        new Chart(ctx, {

            type: "line",

            data: {

                labels: [
                    "Sen",
                    "Sel",
                    "Rab",
                    "Kam",
                    "Jum",
                    "Sab",
                    "Min"
                ],

                datasets: [

                    {
                        label: "Tiket",

                        data: [
                            25,
                            32,
                            28,
                            40,
                            35,
                            42,
                            30
                        ],

                        borderColor: "#1682b4",

                        backgroundColor:
                            "rgba(22, 130, 180, 0.08)",

                        borderWidth: 2,

                        fill: true,

                        tension: 0.4,

                        pointRadius: 3,

                        pointHoverRadius: 5
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            font: {
                                size: 11
                            },

                            color: "#8798a2"
                        },

                        grid: {

                            color:
                                "#edf1f3"
                        }

                    },

                    x: {

                        ticks: {

                            font: {
                                size: 11
                            },

                            color: "#8798a2"
                        },

                        grid: {

                            display: false
                        }

                    }

                }

            }

        });

    }


    /* =================================================
       SIDEBAR
    ================================================= */

    const hamburgerBtn =
        document.getElementById(
            "hamburgerBtn"
        );

    const sidebar =
        document.querySelector(
            ".sidebar"
        );

    const overlay =
        document.getElementById(
            "sidebarOverlay"
        );

    const mainContent =
        document.querySelector(
            ".main-content"
        );


    /* =================================================
       CEK ELEMENT
    ================================================= */

    if (
        !hamburgerBtn ||
        !sidebar
    ) {

        console.warn(
            "SITAFAS: Element sidebar atau hamburger tidak ditemukan."
        );

        return;
    }


    /* =================================================
       HAMBURGER BUTTON
    ================================================= */

    hamburgerBtn.addEventListener(
        "click",
        function () {


            /* -----------------------------------------
               MOBILE
            ----------------------------------------- */

            if (window.innerWidth <= 768) {

                sidebar.classList.toggle("show");

                if (overlay) {

                    overlay.classList.toggle(
                        "show"
                    );

                }

            }


            /* -----------------------------------------
               DESKTOP
            ----------------------------------------- */

            else {

                sidebar.classList.toggle(
                    "collapsed"
                );


                if (mainContent) {

                    mainContent.classList.toggle(
                        "sidebar-collapsed"
                    );

                }

            }


            /* -----------------------------------------
               UBAH ICON
            ----------------------------------------- */

            const icon =
                hamburgerBtn.querySelector("i");


            if (icon) {

                if (
                    window.innerWidth <= 768 &&
                    sidebar.classList.contains("show")
                ) {

                    icon.classList.remove(
                        "fa-bars"
                    );

                    icon.classList.add(
                        "fa-xmark"
                    );

                }

                else {

                    icon.classList.remove(
                        "fa-xmark"
                    );

                    icon.classList.add(
                        "fa-bars"
                    );

                }

            }

        }
    );


    /* =================================================
       OVERLAY
    ================================================= */

    if (overlay) {

        overlay.addEventListener(
            "click",
            function () {

                sidebar.classList.remove(
                    "show"
                );

                overlay.classList.remove(
                    "show"
                );


                /* Kembalikan icon */

                const icon =
                    hamburgerBtn.querySelector(
                        "i"
                    );


                if (icon) {

                    icon.classList.remove(
                        "fa-xmark"
                    );

                    icon.classList.add(
                        "fa-bars"
                    );

                }

            }
        );

    }


    /* =================================================
       RESIZE WINDOW
    ================================================= */

    window.addEventListener(
        "resize",
        function () {


            /* -----------------------------------------
               DESKTOP
            ----------------------------------------- */

            if (window.innerWidth > 768) {

                sidebar.classList.remove(
                    "show"
                );

                if (overlay) {

                    overlay.classList.remove(
                        "show"
                    );

                }

            }


            /* -----------------------------------------
               MOBILE
            ----------------------------------------- */

            else {

                sidebar.classList.remove(
                    "collapsed"
                );

                if (mainContent) {

                    mainContent.classList.remove(
                        "sidebar-collapsed"
                    );

                }

            }


            /* -----------------------------------------
               RESET ICON
            ----------------------------------------- */

            const icon =
                hamburgerBtn.querySelector("i");


            if (icon) {

                icon.classList.remove(
                    "fa-xmark"
                );

                icon.classList.add(
                    "fa-bars"
                );

            }

        }
    );

});