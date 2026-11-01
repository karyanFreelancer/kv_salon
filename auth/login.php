<?php

session_start();

require "../config/connection.php";

$err = "";


/* =========================================================
   LOGIN
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {

        $err = "Please enter your email and password.";

    } else {

        $email = $conn->real_escape_string($email);

        $p = hash('sha256', $password);

        $r = $conn->query("
            SELECT *
            FROM users
            WHERE email = '$email'
            AND password = '$p'
            LIMIT 1
        ");

        if ($r && $r->num_rows) {

            $u = $r->fetch_assoc();

            $_SESSION['user'] = $u;


            /* =================================================
               REDIRECT
            ================================================= */

            if ($u['role'] === 'admin') {

                header("Location: ../admin/dashboard.php");
                exit;

            } else {

                header("Location: ../user/dashboard.php");
                exit;

            }

        } else {

            $err = "Email or password is incorrect.";

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

    <title>Login — KV SALON</title>


    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- Existing CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/app.css"
    >

</head>


<body class="kv-auth">


    <!-- =====================================================
         BACKGROUND DECORATION
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
         LOGIN WRAPPER
    ====================================================== -->

    <main class="auth-page">


        <!-- =================================================
             LEFT BRAND PANEL
        ================================================== -->

        <section class="auth-visual">


            <div class="visual-content">


                <div class="visual-logo">

                    <img
                        src="../assets/images/logo.png"
                        alt="KV Salon"
                    >

                </div>


                <p class="visual-eyebrow">
                    WELCOME BACK
                </p>


                <h2>
                    Your style
                    <br>
                    <span>starts here.</span>
                </h2>


                <p class="visual-text">
                    Manage your appointments, explore our
                    services and keep your salon experience
                    beautifully simple.
                </p>


                <!-- Decorative shape -->

                <div class="visual-circle">

                    <span>KV</span>

                </div>


            </div>


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
             RIGHT LOGIN PANEL
        ================================================== -->

        <section class="auth-form-area">


            <div class="auth-form-box">


                <!-- Mobile Logo -->

                <div class="mobile-logo">

                    <img
                        src="../assets/images/logo.png"
                        alt="KV Salon"
                    >

                </div>


                <div class="auth-heading">

                    <p class="auth-eyebrow">
                        ACCOUNT LOGIN
                    </p>

                    <h1>
                        Welcome <span>back.</span>
                    </h1>

                    <p>
                        Login to manage your appointments
                        and profile.
                    </p>

                </div>


                <!-- =================================================
                     ERROR
                ================================================== -->

                <?php if ($err): ?>

                    <div class="auth-alert auth-alert-error">

                        <span class="alert-icon">!</span>

                        <span>
                            <?= htmlspecialchars($err) ?>
                        </span>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     EMAIL ALREADY EXISTS
                ================================================== -->

                <?php if (
                    isset($_GET['error']) &&
                    $_GET['error'] === 'email_exists'
                ): ?>

                    <div class="auth-alert auth-alert-warning">

                        <span class="alert-icon">!</span>

                        <span>
                            This email is already registered.
                            Please login instead.
                        </span>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     REGISTRATION SUCCESS
                ================================================== -->

                <?php if (isset($_GET['registered'])): ?>

                    <div class="auth-alert auth-alert-success">

                        <span class="alert-icon">✓</span>

                        <span>
                            Registration successful.
                            Please login.
                        </span>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                <form
                    method="POST"
                    class="kv-login-form"
                    id="loginForm"
                >


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
                                required
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <div class="password-label">

                            <label for="password">
                                Password
                            </label>

                        </div>


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
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >


                            <!-- SHOW PASSWORD -->

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


                    <!-- =================================================
                         LOGIN BUTTON
                    ================================================== -->

                    <button
                        type="submit"
                        class="login-submit"
                        id="loginSubmit"
                    >

                        <span class="button-text">
                            Login to KV Salon
                        </span>

                        <span class="button-arrow">
                            →
                        </span>

                    </button>


                </form>


                <!-- =================================================
                     REGISTER
                ================================================== -->

                <div class="auth-register">

                    <span>
                        Don't have an account?
                    </span>

                    <a href="register.php">
                        Create account
                        <span>→</span>
                    </a>

                </div>


                <!-- =================================================
                     FOOTER
                ================================================== -->

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
           PASSWORD SHOW / HIDE
        ====================================================== */

        const password =
            document.getElementById("password");

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


                    passwordToggle.setAttribute(
                        "aria-label",
                        isPassword
                            ? "Hide password"
                            : "Show password"
                    );

                }
            );

        }


        /* =====================================================
           LOGIN BUTTON LOADING
        ====================================================== */

        const loginForm =
            document.getElementById("loginForm");

        const loginSubmit =
            document.getElementById("loginSubmit");


        if (loginForm) {

            loginForm.addEventListener(
                "submit",
                function () {

                    loginSubmit.classList.add("loading");

                    loginSubmit.querySelector(
                        ".button-text"
                    ).textContent = "Signing in...";

                }
            );

        }


        /* =====================================================
           INPUT FOCUS EFFECT
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