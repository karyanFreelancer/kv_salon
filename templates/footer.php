<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn =
    isset($_SESSION['user']) &&
    isset($_SESSION['user']['id']);

?>
<!-- ========================================================
     KV SALON FOOTER
======================================================== -->

<footer class="salon-footer">

    <!-- Decorative background -->
    <div class="footer-decoration footer-decoration-1"></div>
    <div class="footer-decoration footer-decoration-2"></div>


    <div class="footer-container">

        <!-- ==================================================
             TOP FOOTER
        ================================================== -->

        <div class="footer-top">


            <!-- BRAND -->
            <div class="footer-brand">

                <div class="footer-logo-wrap">

                    <img
                        src="../assets/images/logo.png"
                        alt="KV Salon"
                        class="footer-logo"
                    >

                </div>


                <p class="footer-description">
                    Hair, beauty and self-care —
                    created around you.
                </p>


                <div class="footer-socials">

                    <a
                        href="#"
                        aria-label="Instagram"
                    >
                        <span>Instagram</span>
                        <span>↗</span>
                    </a>


                    <a
                        href="#"
                        aria-label="Facebook"
                    >
                        <span>Facebook</span>
                        <span>↗</span>
                    </a>


                    <a
                        href="#"
                        aria-label="WhatsApp"
                    >
                        <span>WhatsApp</span>
                        <span>↗</span>
                    </a>

                </div>

            </div>



            <!-- ==================================================
                 EXPLORE
            ================================================== -->

            <div class="footer-column">

                <span class="footer-label">
                    EXPLORE
                </span>

                <h4>
                    Navigate
                </h4>


                <div class="footer-links">

                    <a href="index.php">
                        <span>Home</span>
                        <span>↗</span>
                    </a>

                    <a href="about.php">
                        <span>About</span>
                        <span>↗</span>
                    </a>

                    <a href="services.php">
                        <span>Services</span>
                        <span>↗</span>
                    </a>

                    <a href="gallery.php">
                        <span>Gallery</span>
                        <span>↗</span>
                    </a>

                    <a href="contact.php">
                        <span>Contact</span>
                        <span>↗</span>
                    </a>

                </div>

            </div>



            <!-- ==================================================
                 SERVICES
            ================================================== -->

            <div class="footer-column">

                <span class="footer-label">
                    BEAUTY
                </span>

                <h4>
                    Our Services
                </h4>


                <div class="footer-links">

                    <a href="services.php">
                        <span>Hair Styling</span>
                        <span>↗</span>
                    </a>

                    <a href="services.php">
                        <span>Hair Care</span>
                        <span>↗</span>
                    </a>

                    <a href="services.php">
                        <span>Makeup</span>
                        <span>↗</span>
                    </a>

                    <a href="services.php">
                        <span>Beauty Care</span>
                        <span>↗</span>
                    </a>

                    <a href="booking-form.php">
                        <span>Appointment</span>
                        <span>↗</span>
                    </a>

                </div>

            </div>



            <!-- ==================================================
                 CONTACT
            ================================================== -->

            <div class="footer-column footer-contact">

                <span class="footer-label">
                    VISIT US
                </span>

                <h4>
                    Let's connect
                </h4>


                <p>
                    We'd love to see you at
                    <strong>KV Salon.</strong>
                </p>


                <div class="footer-contact-item">

                    <span class="contact-icon">
                        ✦
                    </span>

                    <div>
                        <small>
                            LOCATION
                        </small>

                        <span>
                            Your Salon Address
                        </span>
                    </div>

                </div>


                <div class="footer-contact-item">

                    <span class="contact-icon">
                        ✆
                    </span>

                    <div>
                        <small>
                            CALL US
                        </small>

                        <a href="tel:+919999999999">
                            +91 99999 99999
                        </a>
                    </div>

                </div>


                <button
                    type="button"
                    class="footer-book"
                    onclick="openSalonBooking()"
                >
                    <span>
                        Book Appointment
                    </span>

                    <span class="footer-book-arrow">
                        →
                    </span>

                </button>

            </div>

        </div>



        <!-- ==================================================
             HUGE FOOTER TITLE
        ================================================== -->

        <div class="footer-big-title">

            <span>
                LOOK GOOD.
            </span>

            <span class="footer-title-outline">
                FEEL GOOD.
            </span>

        </div>



        <!-- ==================================================
             FOOTER BOTTOM
        ================================================== -->

        <div class="footer-bottom">

            <div class="footer-copy">
                © <?= date('Y') ?> KV Salon.
                All rights reserved.
            </div>


            <div class="footer-made">
                Made with
                <span>♥</span>
                for beautiful days.
            </div>


            <a
                href="#"
                class="footer-top-link"
                id="footerTopLink"
            >
                Back to top
                <span>↑</span>
            </a>

        </div>

    </div>

</footer>



<!-- ========================================================
     FIXED BOOK APPOINTMENT BUTTON
======================================================== -->

<button 
    type="button" 
    class="fixed-book-btn" 
    id="openBooking" 
    aria-label="Book Appointment"
>
    <span class="fixed-book-icon">
        ✂
    </span>

    <span class="fixed-book-text">
        BOOK NOW
    </span>
</button>

<!-- =====================================================
     BOOKING MODAL
===================================================== -->

<div
    class="booking-overlay"
    id="bookingOverlay"
    aria-hidden="true"
>

    <div
        class="booking-sheet"
        role="dialog"
        aria-modal="true"
        aria-labelledby="bookingTitle"
    >

        <!-- =================================================
             HEADER
        ================================================= -->

        <div class="booking-sheet-header">

            <div>

                <span class="booking-eyebrow">
                    ✦ KV SALON
                </span>

                <h3 id="bookingTitle">
                    Book your visit
                </h3>

                <p>
                    Choose your service and preferred time.
                </p>

            </div>


            <!-- CLOSE -->

            <button
                type="button"
                class="booking-close"
                id="closeBooking"
                aria-label="Close booking"
            >
                ×
            </button>

        </div>


        <!-- =================================================
             FORM BODY
        ================================================= -->

        <div class="booking-sheet-body">

            <form
                action="../kv_web/booking.php"
                method="POST"
                id="bookingForm"
                class="kv-booking-form"
            >


                <!-- =================================================
                     NAME
                ================================================= -->

                <div class="kv-field">

                    <label for="booking-name">
                        Your Name
                        <span>*</span>
                    </label>

                    <div class="kv-input">

                        <span>♡</span>

                        <input
                            type="text"
                            id="booking-name"
                            name="name"
                            value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     PHONE
                ================================================= -->

                <div class="kv-field">

                    <label for="booking-phone">
                        Phone Number
                        <span>*</span>
                    </label>

                    <div class="kv-input">

                        <span>☎</span>

                        <input
                            type="tel"
                            id="booking-phone"
                            name="phone"
                            value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>"
                            placeholder="10 digit phone number"
                            inputmode="numeric"
                            maxlength="10"
                            pattern="[0-9]{10}"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     SERVICE
                ================================================= -->

                <div class="kv-field">

                    <label for="service_id">
                        Choose Service
                        <span>*</span>
                    </label>

                    <div class="kv-input kv-select">

                        <span>✂</span>

                        <select
                            name="service_id"
                            id="service_id"
                            required
                        >

                            <option value="">
                                Select a service
                            </option>

                            <?php if ($bookingServices): ?>

                                <?php while ($service = $bookingServices->fetch_assoc()): ?>

                                    <option
                                        value="<?= (int)$service['id'] ?>"
                                    >
                                        <?= htmlspecialchars($service['name']) ?>
                                    </option>

                                <?php endwhile; ?>

                            <?php endif; ?>

                        </select>

                    </div>

                </div>


                <!-- =================================================
                     DATE + TIME
                ================================================= -->

                <div class="kv-form-row">


                    <!-- DATE -->

                    <div class="kv-field">

                        <label for="booking-date">
                            Date
                            <span>*</span>
                        </label>

                        <div class="kv-input">

                            <span>▣</span>

                            <input
                                type="date"
                                id="booking-date"
                                name="date"
                                required
                            >

                        </div>

                    </div>


                    <!-- TIME -->

                    <div class="kv-field">

                        <label for="booking-time">
                            Time
                            <span>*</span>
                        </label>

                        <div class="kv-input">

                            <span>◷</span>

                            <input
                                type="time"
                                id="booking-time"
                                name="time"
                                required
                            >

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     QUICK TIMES
                ================================================= -->

                <div class="kv-quick-time">

                    <div class="kv-quick-title">
                        Popular times
                    </div>

                    <div class="kv-time-buttons">

                        <button
                            type="button"
                            data-time="10:00"
                        >
                            10:00 AM
                        </button>

                        <button
                            type="button"
                            data-time="12:00"
                        >
                            12:00 PM
                        </button>

                        <button
                            type="button"
                            data-time="15:00"
                        >
                            03:00 PM
                        </button>

                        <button
                            type="button"
                            data-time="18:00"
                        >
                            06:00 PM
                        </button>

                    </div>

                </div>


                <!-- =================================================
                     SPECIAL REQUEST
                ================================================= -->

                <div class="kv-field">

                    <label for="booking-notes">

                        Special Request

                        <small>
                            Optional
                        </small>

                    </label>

                    <textarea
                        id="booking-notes"
                        name="notes"
                        rows="3"
                        placeholder="Tell us anything we should know..."
                    ></textarea>

                </div>


                <!-- =================================================
                     APPOINTMENT SUMMARY
                ================================================= -->

                <div class="kv-summary">

                    <div class="kv-summary-head">

                        <span>
                            YOUR APPOINTMENT
                        </span>

                        <span>
                            ✦
                        </span>

                    </div>


                    <div class="kv-summary-row">

                        <span>
                            Service
                        </span>

                        <strong id="summaryService">
                            Not selected
                        </strong>

                    </div>


                    <div class="kv-summary-row">

                        <span>
                            Date
                        </span>

                        <strong id="summaryDate">
                            Not selected
                        </strong>

                    </div>


                    <div class="kv-summary-row">

                        <span>
                            Time
                        </span>

                        <strong id="summaryTime">
                            Not selected
                        </strong>

                    </div>

                </div>


                <!-- =================================================
                     SUBMIT
                ================================================= -->

                <button
                    type="submit"
                    class="kv-submit-btn"
                >

                    <span>
                        Book Appointment
                    </span>

                    <strong>
                        →
                    </strong>

                </button>


                <p class="kv-form-note">
                    🔒 Your information is safe with us.
                    We will contact you to confirm your appointment.
                </p>


            </form>

        </div>

    </div>

</div>

<!-- ========================================================
     BACK TO TOP
======================================================== -->

<button
    class="back-top"
    id="backTop"
    type="button"
    aria-label="Back to top"
>
    ↑
</button>



<!-- ========================================================
     JAVASCRIPT
======================================================== -->

<script src="../assets/js/booking.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<script src="../assets/js/app.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       LOGIN STATUS
    ===================================================== */

    const isLoggedIn =
        <?= $isLoggedIn ? 'true' : 'false' ?>;


    /* =====================================================
       ELEMENTS
    ===================================================== */

    const openBooking =
        document.getElementById("openBooking");

    const bookingOverlay =
        document.getElementById("bookingOverlay");

    const closeBooking =
        document.getElementById("closeBooking");

    const bookingForm =
        document.getElementById("bookingForm");

    const service =
        document.getElementById("service_id");

    const date =
        document.getElementById("booking-date");

    const time =
        document.getElementById("booking-time");

    const phone =
        document.getElementById("booking-phone");

    const summaryService =
        document.getElementById("summaryService");

    const summaryDate =
        document.getElementById("summaryDate");

    const summaryTime =
        document.getElementById("summaryTime");


    /* =====================================================
       OPEN LOGIN PAGE
    ===================================================== */

    function goToLogin() {

        window.location.href =
            "/kv_salon/auth/login.php?redirect=booking";

    }


    /* =====================================================
       OPEN MODAL
    ===================================================== */

    function openBookingModal() {

        /* NOT LOGGED IN */

        if (!isLoggedIn) {

            goToLogin();

            return;

        }


        /* MODAL NOT FOUND */

        if (!bookingOverlay) {

            console.error(
                "bookingOverlay not found"
            );

            return;

        }


        /* OPEN */

        bookingOverlay.classList.add("active");

        bookingOverlay.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "booking-open"
        );

    }


    /* =====================================================
       CLOSE MODAL
    ===================================================== */

    function closeBookingModal() {

        if (!bookingOverlay) return;

        bookingOverlay.classList.remove(
            "active"
        );

        bookingOverlay.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "booking-open"
        );

    }


    /* =====================================================
       MAIN BOOK NOW BUTTON
    ===================================================== */

    if (openBooking) {

        openBooking.addEventListener(
            "click",
            function (e) {

                e.preventDefault();

                openBookingModal();

            }
        );

    }


    /* =====================================================
       FOOTER BOOK APPOINTMENT
    ===================================================== */

    window.openSalonBooking =
        function () {

            openBookingModal();

        };


    /* =====================================================
       CLOSE BUTTON
    ===================================================== */

    if (closeBooking) {

        closeBooking.addEventListener(
            "click",
            function (e) {

                e.preventDefault();

                closeBookingModal();

            }
        );

    }


    /* =====================================================
       OUTSIDE CLICK
    ===================================================== */

    if (bookingOverlay) {

        bookingOverlay.addEventListener(
            "click",
            function (e) {

                if (
                    e.target === bookingOverlay
                ) {

                    closeBookingModal();

                }

            }
        );

    }


    /* =====================================================
       ESC KEY
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (e) {

            if (
                e.key === "Escape" &&
                bookingOverlay &&
                bookingOverlay.classList.contains("active")
            ) {

                closeBookingModal();

            }

        }
    );


    /* =====================================================
       MINIMUM DATE = TODAY
    ===================================================== */

    if (date) {

        const today =
            new Date();

        const year =
            today.getFullYear();

        const month =
            String(
                today.getMonth() + 1
            ).padStart(2, "0");

        const day =
            String(
                today.getDate()
            ).padStart(2, "0");

        date.min =
            `${year}-${month}-${day}`;

    }


    /* =====================================================
       SERVICE SUMMARY
    ===================================================== */

    if (service) {

        service.addEventListener(
            "change",
            function () {

                if (
                    this.value &&
                    this.selectedIndex >= 0
                ) {

                    summaryService.textContent =
                        this.options[
                            this.selectedIndex
                        ].textContent.trim();

                } else {

                    summaryService.textContent =
                        "Not selected";

                }

            }
        );

    }


    /* =====================================================
       DATE SUMMARY
    ===================================================== */

    if (date) {

        date.addEventListener(
            "change",
            function () {

                if (!this.value) {

                    summaryDate.textContent =
                        "Not selected";

                    return;

                }


                const selectedDate =
                    new Date(
                        this.value + "T00:00:00"
                    );


                summaryDate.textContent =
                    selectedDate.toLocaleDateString(
                        "en-IN",
                        {
                            day: "2-digit",
                            month: "short",
                            year: "numeric"
                        }
                    );

            }
        );

    }


    /* =====================================================
       TIME SUMMARY
    ===================================================== */

    function updateTimeSummary() {

        if (!time || !time.value) {

            if (summaryTime) {

                summaryTime.textContent =
                    "Not selected";

            }

            return;

        }


        const parts =
            time.value.split(":");

        let hour =
            parseInt(parts[0], 10);

        const minute =
            parts[1];

        const period =
            hour >= 12
                ? "PM"
                : "AM";

        hour =
            hour % 12 || 12;


        if (summaryTime) {

            summaryTime.textContent =
                `${hour}:${minute} ${period}`;

        }

    }


    if (time) {

        time.addEventListener(
            "change",
            updateTimeSummary
        );

    }


    /* =====================================================
       QUICK TIME BUTTONS
    ===================================================== */

    const quickButtons =
        document.querySelectorAll(
            ".kv-time-buttons button"
        );


    quickButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    /* REMOVE ACTIVE */

                    quickButtons.forEach(
                        function (btn) {

                            btn.classList.remove(
                                "active"
                            );

                        }
                    );


                    /* ADD ACTIVE */

                    this.classList.add(
                        "active"
                    );


                    /* SET TIME */

                    if (time) {

                        time.value =
                            this.dataset.time;

                        updateTimeSummary();

                    }

                }
            );

        }
    );


    /* =====================================================
       PHONE - ONLY NUMBERS
    ===================================================== */

    if (phone) {

        phone.addEventListener(
            "input",
            function () {

                this.value =
                    this.value
                        .replace(/\D/g, "")
                        .slice(0, 10);

            }
        );

    }


    /* =====================================================
       FORM VALIDATION
    ===================================================== */

    if (bookingForm) {

        bookingForm.addEventListener(
            "submit",
            function (e) {

                /* PHONE */

                if (
                    phone &&
                    !/^[0-9]{10}$/.test(
                        phone.value
                    )
                ) {

                    e.preventDefault();

                    alert(
                        "Please enter a valid 10 digit phone number."
                    );

                    phone.focus();

                    return;

                }


                /* DATE */

                if (
                    date &&
                    date.value
                ) {

                    const selectedDate =
                        new Date(
                            date.value +
                            "T00:00:00"
                        );

                    const today =
                        new Date();

                    today.setHours(
                        0,
                        0,
                        0,
                        0
                    );


                    if (
                        selectedDate < today
                    ) {

                        e.preventDefault();

                        alert(
                            "Please select today or a future date."
                        );

                        date.focus();

                        return;

                    }

                }

            }
        );

    }


    /* =====================================================
       AUTO OPEN AFTER LOGIN
       
       Login success:
       index.php?open_booking=1
    ===================================================== */

    const urlParams =
        new URLSearchParams(
            window.location.search
        );

    const openAfterLogin =
        urlParams.get(
            "open_booking"
        );


    if (
        openAfterLogin === "1" &&
        isLoggedIn
    ) {

        setTimeout(
            function () {

                openBookingModal();

            },
            300
        );

    }

});
</script>
</body>
</html>