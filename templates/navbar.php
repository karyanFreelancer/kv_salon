<?php
/* =========================================================
   KV SALON - NAVBAR
========================================================= */


/* =========================================================
   SESSION
========================================================= */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =========================================================
   BASE URL
========================================================= */

$baseUrl = "/kv_salon";


/* =========================================================
   LOGIN STATUS
========================================================= */

$isLoggedIn = isset($_SESSION['user']['id']);

$userName = $_SESSION['user']['name'] ?? 'User';

$userRole = $_SESSION['user']['role'] ?? '';


/* =========================================================
   HELPER FUNCTION
========================================================= */

if (!function_exists('e')) {

    function e($value)
    {
        return htmlspecialchars(
            (string)($value ?? ''),
            ENT_QUOTES,
            'UTF-8'
        );
    }

}


/* =========================================================
   CURRENT PAGE
========================================================= */

$currentPage = basename(
    $_SERVER['PHP_SELF'] ?? ''
);

?>

<!-- ========================================================
     NAVBAR
======================================================== -->

<nav
    class="salon-navbar"
    id="salonNavbar"
    data-logged-in="<?= $isLoggedIn ? 'true' : 'false' ?>"
>

    <div class="nav-inner">


        <!-- ==================================================
             LOGO
        ================================================== -->

        <div class="nav-brand">

            <a
                href="<?= $baseUrl ?>/kv_web/index.php"
                aria-label="KV Salon Home"
            >

                <img
                    src="<?= $baseUrl ?>/assets/images/logo.png"
                    alt="KV Salon"
                >

            </a>

        </div>


        <!-- ==================================================
             NAV LINKS
        ================================================== -->

        <div
            class="nav-links"
            id="navLinks"
        >

            <!-- HOME -->

            <a
                href="<?= $baseUrl ?>/kv_web/index.php"
                class="<?= $currentPage === 'index.php' ? 'active' : '' ?>"
            >
                <span>Home</span>
            </a>


            <!-- ABOUT -->

            <a
                href="<?= $baseUrl ?>/kv_web/about.php"
                class="<?= $currentPage === 'about.php' ? 'active' : '' ?>"
            >
                <span>About</span>
            </a>


            <!-- SERVICES -->

            <a
                href="<?= $baseUrl ?>/kv_web/services.php"
                class="<?= $currentPage === 'services.php' ? 'active' : '' ?>"
            >
                <span>Services</span>
            </a>


            <!-- GALLERY -->

            <a
                href="<?= $baseUrl ?>/kv_web/gallery.php"
                class="<?= $currentPage === 'gallery.php' ? 'active' : '' ?>"
            >
                <span>Gallery</span>
            </a>


            <!-- CONTACT -->

            <a
                href="<?= $baseUrl ?>/kv_web/contact.php"
                class="<?= $currentPage === 'contact.php' ? 'active' : '' ?>"
            >
                <span>Contact</span>
            </a>


            <!-- BOOK APPOINTMENT -->

            <a
                href="<?= $baseUrl ?>/kv_web/booking-form.php"
                class="nav-book <?= $currentPage === 'booking-form.php' ? 'active' : '' ?>"
            >

                <span>
                    Book Appointment
                </span>

                <span class="nav-arrow">
                    →
                </span>

            </a>

        </div>


        <!-- ==================================================
             RIGHT SIDE
        ================================================== -->

        <div class="nav-right">


            <!-- =================================================
                 ACCOUNT
            ================================================= -->

            <div class="account-wrap">


                <!-- ACCOUNT BUTTON -->

                <button
                    type="button"
                    class="nav-account"
                    id="accountToggle"
                    aria-label="Open account menu"
                    aria-expanded="false"
                    aria-haspopup="true"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
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


                    <?php if ($isLoggedIn): ?>

                        <span
                            class="account-dot"
                            aria-hidden="true"
                        ></span>

                    <?php endif; ?>

                </button>


                <!-- =================================================
                     ACCOUNT MENU
                ================================================= -->

                <div
                    class="account-menu"
                    id="accountMenu"
                    aria-hidden="true"
                >


                    <?php if ($isLoggedIn): ?>


                        <!-- =========================================
                             USER INFO
                        ========================================== -->

                        <div class="account-user-info">

                            <div class="account-avatar">

                                <?= e(
                                    strtoupper(
                                        substr(
                                            $userName,
                                            0,
                                            1
                                        )
                                    )
                                ) ?>

                            </div>


                            <div class="account-user-text">

                                <strong>
                                    <?= e($userName) ?>
                                </strong>

                                <small>

                                    <?php if ($userRole === 'admin'): ?>

                                        Administrator

                                    <?php else: ?>

                                        Customer

                                    <?php endif; ?>

                                </small>

                            </div>

                        </div>


                        <div class="account-menu-divider"></div>


                        <!-- =========================================
                             DASHBOARD
                        ========================================== -->

                        <?php if ($userRole === 'admin'): ?>

                            <a
                                href="<?= $baseUrl ?>/admin/dashboard.php"
                                class="account-menu-link"
                            >

                                <span class="menu-icon">
                                    ⌂
                                </span>

                                <span class="menu-link-text">
                                    Dashboard
                                </span>

                                <span class="menu-arrow">
                                    →
                                </span>

                            </a>

                        <?php else: ?>

                            <a
                                href="<?= $baseUrl ?>/user/dashboard.php"
                                class="account-menu-link"
                            >

                                <span class="menu-icon">
                                    ⌂
                                </span>

                                <span class="menu-link-text">
                                    Dashboard
                                </span>

                                <span class="menu-arrow">
                                    →
                                </span>

                            </a>

                        <?php endif; ?>


                        <!-- =========================================
                             PROFILE
                        ========================================== -->

                        <?php if ($userRole !== 'admin'): ?>

                            <a
                                href="<?= $baseUrl ?>/user/profile.php"
                                class="account-menu-link"
                            >

                                <span class="menu-icon">
                                    ◯
                                </span>

                                <span class="menu-link-text">
                                    My Profile
                                </span>

                                <span class="menu-arrow">
                                    →
                                </span>

                            </a>

                        <?php endif; ?>


                        <!-- =========================================
                             APPOINTMENTS
                        ========================================== -->

                        <?php if ($userRole === 'customer'): ?>

                            <a
                                href="<?= $baseUrl ?>/user/dashboard.php#appointments"
                                class="account-menu-link"
                            >

                                <span class="menu-icon">
                                    ◷
                                </span>

                                <span class="menu-link-text">
                                    My Appointments
                                </span>

                                <span class="menu-arrow">
                                    →
                                </span>

                            </a>

                        <?php endif; ?>


                        <div class="account-menu-divider"></div>


                        <!-- =========================================
                             LOGOUT
                        ========================================== -->

                        <a
                            href="<?= $baseUrl ?>/auth/logout.php"
                            class="account-menu-link account-logout"
                        >

                            <span class="menu-icon">
                                ↪
                            </span>

                            <span class="menu-link-text">
                                Logout
                            </span>

                            <span class="menu-arrow">
                                →
                            </span>

                        </a>


                    <?php else: ?>


                        <!-- =========================================
                             GUEST
                        ========================================== -->

                        <div class="account-menu-title">

                            Welcome to KV Salon

                        </div>


                        <p class="account-menu-subtitle">

                            Login to manage your appointments.

                        </p>


                        <!-- LOGIN -->

                        <a
                            href="<?= $baseUrl ?>/auth/login.php"
                            class="account-menu-link"
                        >

                            <span class="menu-icon">
                                →
                            </span>

                            <span class="menu-link-text">
                                Login
                            </span>

                            <span class="menu-arrow">
                                →
                            </span>

                        </a>


                        <!-- REGISTER -->

                        <a
                            href="<?= $baseUrl ?>/auth/register.php"
                            class="account-menu-link"
                        >

                            <span class="menu-icon">
                                +
                            </span>

                            <span class="menu-link-text">
                                Create Account
                            </span>

                            <span class="menu-arrow">
                                →
                            </span>

                        </a>


                    <?php endif; ?>


                </div>

            </div>


            <!-- =================================================
                 MOBILE MENU BUTTON
            ================================================= -->

            <button
                class="mobile-menu-btn"
                id="mobileMenuBtn"
                type="button"
                aria-label="Open navigation menu"
                aria-expanded="false"
                aria-controls="navLinks"
            >

                <span></span>
                <span></span>
                <span></span>

            </button>


        </div>

    </div>

</nav>