document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | ROLE TAB
    |--------------------------------------------------------------------------
    */

    const roleTabs = document.querySelectorAll(".role-tab");
    const roleInput = document.getElementById("role");

    roleTabs.forEach(function (tab) {

        tab.addEventListener("click", function () {

            roleTabs.forEach(function (item) {
                item.classList.remove("active");
            });

            this.classList.add("active");

            const selectedRole = this.dataset.role;

            roleInput.value = selectedRole;

        });

    });


    /*
    |--------------------------------------------------------------------------
    | PASSWORD TOGGLE
    |--------------------------------------------------------------------------
    */

    const passwordInput = document.getElementById("password");
    const passwordToggle = document.getElementById("passwordToggle");

    if (passwordToggle) {

        passwordToggle.addEventListener("click", function () {

            const icon = this.querySelector("i");

            if (passwordInput.type === "password") {

                passwordInput.type = "text";

                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");

            } else {

                passwordInput.type = "password";

                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN BUTTON LOADING
    |--------------------------------------------------------------------------
    */

    const loginForm = document.getElementById("loginForm");
    const loginButton = document.querySelector(".login-button");

    if (loginForm) {

        loginForm.addEventListener("submit", function () {

            loginButton.disabled = true;

            loginButton.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin"></i>
                <span>MEMPROSES...</span>
            `;

        });

    }

});