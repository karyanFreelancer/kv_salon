<?php

session_start();

require "../config/connection.php";

$err = "";


/* =========================================================
   REGISTER
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';


    /* =====================================================
       VALIDATION
    ===================================================== */

    if (
        $name === '' ||
        $email === '' ||
        $password === ''
    ) {

        $err = "Please fill in all required fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $err = "Please enter a valid email address.";

    } elseif (strlen($password) < 6) {

        $err = "Password must be at least 6 characters.";

    } elseif ($password !== $confirmPassword) {

        $err = "Passwords do not match.";

    } else {


        /* =================================================
           ESCAPE DATA
        ================================================= */

        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);

        $p = hash('sha256', $password);


        /* =================================================
           CHECK EMAIL
        ================================================= */

        $check = $conn->query("
            SELECT id
            FROM users
            WHERE email = '$email'
            LIMIT 1
        ");


        if ($check && $check->num_rows > 0) {

            $err = "This email is already registered. Please login instead.";

        } else {


            /* =================================================
               CREATE ACCOUNT
            ================================================= */

            $query = "
                INSERT INTO users
                (
                    name,
                    email,
                    phone,
                    password,
                    role
                )
                VALUES
                (
                    '$name',
                    '$email',
                    '$phone',
                    '$p',
                    'customer'
                )
            ";


            if ($conn->query($query)) {

                header("Location: login.php?registered=1");

                exit;

            } else {

                $err = "Unable to create account. Please try again.";

            }

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Create Account — KV SALON</title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- MAIN CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/app.css"
    >

</head>


<body class="kv-auth">


    <!-- =====================================================
         DECORATION
    ====================================================== -->

    <div class="auth-decoration decoration-one"></div>

    <div class="auth-decoration decoration-two"></div>


    <!-- =====================================================
         BACK TO HOME
    ====================================================== -->

    <a
        href="../kv_web/index.php"
        class="auth-home"
    >

        <span>←</span>

        Back to salon

    </a>


    <!-- =====================================================
         REGISTER PAGE
    ====================================================== -->

    <main class="auth-page">


        <!-- =================================================
             LEFT SIDE
        ================================================== -->

        <section class="auth-visual">


            <div class="visual-content">


                <!-- LOGO -->

                <div class="visual-logo">

                    <img
                        src="../assets/images/logo.png"
                        alt="KV Salon"
                    >

                </div>


                <p class="visual-eyebrow">
                    JOIN KV SALON
                </p>


                <h2>

                    Beauty
                    <br>

                    <span>made personal.</span>

                </h2>


                <p class="visual-text">

                    Create your KV Salon account and make
                    appointments, manage your profile and
                    enjoy a smoother salon experience.

                </p>


                <!-- DECORATIVE CIRCLE -->

                <div class="visual-circle">

                    <span>KV</span>

                </div>

            </div>


            <!-- BOTTOM -->

            <div class="visual-bottom">

                <span>
                    BEAUTY • STYLE • YOU
                </span>

                <span>
                    KV SALON
                </span>

            </div>

        </section>


        <!-- =================================================
             RIGHT FORM
        ================================================== -->

        <section class="auth-form-area">


            <div class="auth-form-box">


                <!-- MOBILE LOGO -->

                <div class="mobile-logo">

                    <img
                        src="../assets/images/logo.png"
                        alt="KV Salon"
                    >

                </div>


                <!-- HEADING -->

                <div class="auth-heading">

                    <p class="auth-eyebrow">
                        NEW CUSTOMER
                    </p>

                    <h1>

                        Create
                        <span>account.</span>

                    </h1>

                    <p>
                        Join KV Salon and book your next
                        appointment with ease.
                    </p>

                </div>


                <!-- =================================================
                     ERROR
                ================================================== -->

                <?php if ($err): ?>

                    <div class="auth-alert auth-alert-error">

                        <span class="alert-icon">
                            !
                        </span>

                        <span>
                            <?= htmlspecialchars($err) ?>
                        </span>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     FORM
                ================================================== -->

                <form
                    method="POST"
                    class="kv-login-form"
                    id="registerForm"
                >


                    <!-- NAME -->

                    <div class="form-group">

                        <label for="name">
                            Full name
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="3.5"
                                    />

                                    <path
                                        d="M5 20C5.8 16.3 8.1 14.5 12 14.5C15.9 14.5 18.2 16.3 19 20"
                                    />

                                </svg>

                            </span>


                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Your full name"
                                autocomplete="name"
                                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email address
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />

                                    <path
                                        d="M3 7L12 13L21 7"
                                    />

                                </svg>

                            </span>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                autocomplete="email"
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- PHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Phone number
                            <span class="optional">
                                Optional
                            </span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M6.5 3H9L10.5 7L8.5 8.5C9.4 10.5 11 12.1 13 13L14.5 11L18.5 12.5V15C18.5 17 17 18.5 15 18.5C9 18 5 14 4.5 8C4.5 6 5 4.5 6.5 3Z"
                                    />

                                </svg>

                            </span>


                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder="Your phone number"
                                autocomplete="tel"
                                value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <rect
                                        x="4"
                                        y="10"
                                        width="16"
                                        height="11"
                                        rx="2"
                                    />

                                    <path
                                        d="M8 10V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V10"
                                    />

                                </svg>

                            </span>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="At least 6 characters"
                                minlength="6"
                                autocomplete="new-password"
                                required
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                aria-label="Show password"
                            >

                                <svg
                                    id="eyeOpen"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <path
                                        d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                    />

                                </svg>


                                <svg
                                    id="eyeClosed"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    style="display:none;"
                                >

                                    <path
                                        d="M3 3L21 21"
                                    />

                                    <path
                                        d="M10.6 5.2C11.05 5.08 11.52 5 12 5C18.5 5 22 12 22 12C22 12 20.8 14.4 18.5 16.3"
                                    />

                                    <path
                                        d="M6.2 6.2C3.4 8.3 2 12 2 12C2 12 5.5 19 12 19C13.5 19 14.8 18.7 16 18.2"
                                    />

                                </svg>

                            </button>

                        </div>

                    </div>


                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label for="confirm_password">
                            Confirm password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >

                                    <rect
                                        x="4"
                                        y="10"
                                        width="16"
                                        height="11"
                                        rx="2"
                                    />

                                    <path
                                        d="M8 10V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V10"
                                    />

                                </svg>

                            </span>


                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                placeholder="Repeat your password"
                                minlength="6"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        <small
                            class="password-message"
                            id="passwordMessage"
                        ></small>

                    </div>


                    <!-- SUBMIT -->

                    <button
                        type="submit"
                        class="login-submit"
                        id="registerSubmit"
                    >

                        <span class="button-text">
                            Create KV Salon Account
                        </span>

                        <span class="button-arrow">
                            →
                        </span>

                    </button>


                </form>


                <!-- LOGIN -->

                <div class="auth-register">

                    <span>
                        Already have an account?
                    </span>

                    <a href="login.php">
                        Login
                        <span>→</span>
                    </a>

                </div>


                <!-- FOOTER -->

                <div class="auth-footer">

                    <span>
                        © <?= date('Y') ?> KV SALON
                    </span>

                    <span class="footer-dot"></span>

                    <span>
                        Beauty • Style • You
                    </span>

                </div>


            </div>

        </section>

    </main>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =====================================================
           PASSWORD TOGGLE
        ====================================================== */

        const password =
            document.getElementById("password");

        const confirmPassword =
            document.getElementById("confirm_password");

        const passwordToggle =
            document.getElementById("passwordToggle");

        const eyeOpen =
            document.getElementById("eyeOpen");

        const eyeClosed =
            document.getElementById("eyeClosed");


        if (passwordToggle) {

            passwordToggle.addEventListener(
                "click",
                function () {

                    const isPassword =
                        password.type === "password";


                    password.type =
                        isPassword ? "text" : "password";


                    eyeOpen.style.display =
                        isPassword ? "none" : "block";


                    eyeClosed.style.display =
                        isPassword ? "block" : "none";

                }
            );

        }


        /* =====================================================
           PASSWORD MATCH
        ====================================================== */

        const passwordMessage =
            document.getElementById("passwordMessage");


        function checkPassword() {

            if (!confirmPassword.value) {

                passwordMessage.textContent = "";

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.remove("password-valid");

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.remove("password-invalid");

                return;

            }


            if (password.value === confirmPassword.value) {

                passwordMessage.textContent =
                    "✓ Passwords match";

                passwordMessage.className =
                    "password-message valid";

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.add("password-valid");

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.remove("password-invalid");

            } else {

                passwordMessage.textContent =
                    "Passwords do not match";

                passwordMessage.className =
                    "password-message invalid";

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.add("password-invalid");

                confirmPassword
                    .closest(".input-wrapper")
                    .classList.remove("password-valid");

            }

        }


        password.addEventListener(
            "input",
            checkPassword
        );

        confirmPassword.addEventListener(
            "input",
            checkPassword
        );


        /* =====================================================
           FORM SUBMIT
        ====================================================== */

        const registerForm =
            document.getElementById("registerForm");

        const registerSubmit =
            document.getElementById("registerSubmit");


        registerForm.addEventListener(
            "submit",
            function (event) {

                if (
                    password.value !==
                    confirmPassword.value
                ) {

                    event.preventDefault();

                    checkPassword();

                    confirmPassword.focus();

                    return;

                }


                registerSubmit.classList.add("loading");

                registerSubmit.querySelector(
                    ".button-text"
                ).textContent = "Creating account...";

            }
        );


        /* =====================================================
           INPUT FOCUS
        ====================================================== */

        document
            .querySelectorAll(".input-wrapper input")
            .forEach(function (input) {

                input.addEventListener(
                    "focus",
                    function () {

                        input
                            .closest(".input-wrapper")
                            .classList.add("focused");

                    }
                );


                input.addEventListener(
                    "blur",
                    function () {

                        input
                            .closest(".input-wrapper")
                            .classList.remove("focused");

                    }
                );

            });

    </script>

</body>

</html>