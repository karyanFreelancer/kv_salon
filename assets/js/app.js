document.addEventListener("DOMContentLoaded", function () {

    /* =========================================================
       ELEMENTS
    ========================================================= */

    const navbar = document.getElementById("salonNavbar");
    const menuBtn = document.getElementById("mobileMenuBtn");
    const navLinks = document.getElementById("navLinks");

    const accountToggle = document.getElementById("accountToggle");
    const accountMenu = document.getElementById("accountMenu");

    const loader = document.getElementById("pageLoader");


    /* =========================================================
       LOGIN STATUS
    ========================================================= */

    const isLoggedIn =
        navbar &&
        navbar.dataset.loggedIn === "true";


    /* =========================================================
       PAGE LOADER
    ========================================================= */

    if (loader) {

        window.addEventListener("load", function () {

            setTimeout(function () {

                loader.classList.add("loader-hide");

            }, 400);

        });

    }


    /* =========================================================
       MOBILE MENU
    ========================================================= */

    function openMobileMenu() {

        if (!navLinks || !menuBtn) {
            return;
        }

        navLinks.classList.add("open");

        menuBtn.classList.add("active");

        menuBtn.setAttribute(
            "aria-expanded",
            "true"
        );

        menuBtn.setAttribute(
            "aria-label",
            "Close navigation menu"
        );

        if (navbar) {

            navbar.classList.remove("nav-hidden");

        }

        document.body.classList.add(
            "mobile-menu-open"
        );

    }


    function closeMobileMenu() {

        if (!navLinks || !menuBtn) {
            return;
        }

        navLinks.classList.remove("open");

        menuBtn.classList.remove("active");

        menuBtn.setAttribute(
            "aria-expanded",
            "false"
        );

        menuBtn.setAttribute(
            "aria-label",
            "Open navigation menu"
        );

        document.body.classList.remove(
            "mobile-menu-open"
        );

    }


    /* =========================================================
       MOBILE MENU BUTTON
    ========================================================= */

    if (menuBtn && navLinks) {

        menuBtn.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                if (
                    navLinks.classList.contains("open")
                ) {

                    closeMobileMenu();

                } else {

                    openMobileMenu();

                }

            }
        );

    }


    /* =========================================================
       NAVIGATION LINKS
       
       IMPORTANT:
       YAHAN preventDefault NAHI HAI.
       Browser naturally page open karega.
    ========================================================= */

    if (navLinks) {

        const links =
            navLinks.querySelectorAll("a");

        links.forEach(function (link) {

            link.addEventListener(
                "click",
                function () {

                    console.log(
                        "Opening:",
                        this.href
                    );

                    closeMobileMenu();

                    /*
                     * Browser ko normally navigate
                     * karne diya ja raha hai.
                     */

                }
            );

        });

    }


    /* =========================================================
       CLICK OUTSIDE MOBILE MENU
    ========================================================= */

    document.addEventListener(
        "click",
        function (event) {

            if (!navbar || !navLinks) {
                return;
            }

            if (
                navLinks.classList.contains("open") &&
                !navbar.contains(event.target)
            ) {

                closeMobileMenu();

            }

        }
    );


    /* =========================================================
       ESCAPE
    ========================================================= */

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                closeMobileMenu();

                closeAccountMenu();

            }

        }
    );


    /* =========================================================
       ACCOUNT MENU
    ========================================================= */

    function openAccountMenu() {

        if (!accountMenu || !accountToggle) {
            return;
        }

        accountMenu.classList.add("show");

        accountMenu.setAttribute(
            "aria-hidden",
            "false"
        );

        accountToggle.setAttribute(
            "aria-expanded",
            "true"
        );

    }


    function closeAccountMenu() {

        if (!accountMenu || !accountToggle) {
            return;
        }

        accountMenu.classList.remove("show");

        accountMenu.setAttribute(
            "aria-hidden",
            "true"
        );

        accountToggle.setAttribute(
            "aria-expanded",
            "false"
        );

    }


    if (accountToggle && accountMenu) {

        accountToggle.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                if (
                    accountMenu.classList.contains("show")
                ) {

                    closeAccountMenu();

                } else {

                    openAccountMenu();

                }

            }
        );


        accountMenu.addEventListener(
            "click",
            function (event) {

                event.stopPropagation();

            }
        );

    }


    /* =========================================================
       ACCOUNT OUTSIDE CLICK
    ========================================================= */

    document.addEventListener(
        "click",
        function (event) {

            if (
                accountMenu &&
                accountToggle &&
                !accountMenu.contains(event.target) &&
                !accountToggle.contains(event.target)
            ) {

                closeAccountMenu();

            }

        }
    );


    /* =========================================================
       NAVBAR SCROLL
    ========================================================= */

    if (navbar) {

        let lastScrollY = window.scrollY;

        let scrollTimer = null;

        function showNavbar() {

            navbar.classList.remove(
                "nav-hidden"
            );

        }


        function hideNavbar() {

            if (
                window.innerWidth <= 768 &&
                navLinks &&
                navLinks.classList.contains("open")
            ) {

                return;

            }

            navbar.classList.add(
                "nav-hidden"
            );

        }


        window.addEventListener(
            "scroll",
            function () {

                const currentScrollY =
                    window.scrollY;


                if (currentScrollY <= 20) {

                    showNavbar();

                    lastScrollY =
                        currentScrollY;

                    return;

                }


                if (
                    currentScrollY >
                    lastScrollY + 8
                ) {

                    hideNavbar();

                }


                if (
                    currentScrollY <
                    lastScrollY - 8
                ) {

                    showNavbar();

                }


                clearTimeout(scrollTimer);


                scrollTimer =
                    setTimeout(function () {

                        showNavbar();

                    }, 600);


                lastScrollY =
                    currentScrollY;

            },
            {
                passive: true
            }
        );

    }


    /* =========================================================
       RESIZE
    ========================================================= */

    window.addEventListener(
        "resize",
        function () {

            if (window.innerWidth > 768) {

                closeMobileMenu();

            }

        }
    );


    /* =========================================================
       DATE MINIMUM
    ========================================================= */

    document
        .querySelectorAll(
            'input[type="date"]'
        )
        .forEach(function (input) {

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

            input.min =
                `${year}-${month}-${day}`;

        });


    /* =========================================================
       BOOKING
    ========================================================= */

    const bookingOverlay =
        document.getElementById(
            "bookingOverlay"
        );

    const closeBookingBtn =
        document.getElementById(
            "closeBooking"
        );

    const openBookingBtn =
        document.getElementById(
            "openBooking"
        );


    function goToLogin() {

        window.location.href =
            "/kv_salon/auth/login.php?redirect=booking";

    }


    function openBookingModal() {

        /*
         * Agar login nahi hai
         * to login page.
         */

        if (!isLoggedIn) {

            goToLogin();

            return;

        }


        if (!bookingOverlay) {

            /*
             * Agar booking overlay nahi hai,
             * to direct booking page.
             */

            window.location.href =
                "/kv_salon/kv_web/booking-form.php";

            return;

        }


        bookingOverlay.classList.add(
            "active"
        );

        bookingOverlay.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "booking-open"
        );

        closeMobileMenu();

    }


    window.openSalonBooking =
        openBookingModal;


    if (openBookingBtn) {

        openBookingBtn.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                openBookingModal();

            }
        );

    }


    /* =========================================================
       CLOSE BOOKING
    ========================================================= */

    function closeBookingModal() {

        if (!bookingOverlay) {
            return;
        }

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


    if (closeBookingBtn) {

        closeBookingBtn.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                closeBookingModal();

            }
        );

    }


    if (bookingOverlay) {

        bookingOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target ===
                    bookingOverlay
                ) {

                    closeBookingModal();

                }

            }
        );

    }


    /* =========================================================
       BOOKING ESC
    ========================================================= */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                bookingOverlay &&
                bookingOverlay.classList.contains("active")
            ) {

                closeBookingModal();

            }

        }
    );


    /* =========================================================
       PHONE
    ========================================================= */

    const phoneInput =
        document.getElementById(
            "booking-phone"
        );

    if (phoneInput) {

        phoneInput.addEventListener(
            "input",
            function () {

                this.value =
                    this.value
                        .replace(/\D/g, "")
                        .slice(0, 10);

            }
        );

    }


    /* =========================================================
       BOOKING FORM
    ========================================================= */

    const bookingForm =
        document.getElementById(
            "bookingForm"
        );

    const dateInput =
        document.getElementById(
            "booking-date"
        );


    if (bookingForm) {

        bookingForm.addEventListener(
            "submit",
            function (event) {

                if (
                    phoneInput &&
                    !/^[0-9]{10}$/.test(
                        phoneInput.value
                    )
                ) {

                    event.preventDefault();

                    alert(
                        "Please enter a valid 10 digit phone number."
                    );

                    phoneInput.focus();

                    return;

                }


                if (
                    dateInput &&
                    dateInput.value
                ) {

                    const selectedDate =
                        new Date(
                            dateInput.value +
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

                        event.preventDefault();

                        alert(
                            "Please select today or a future date."
                        );

                        dateInput.focus();

                        return;

                    }

                }

            }
        );

    }


    /* =========================================================
       BACK TO TOP
    ========================================================= */

    const backTop =
        document.getElementById(
            "backTop"
        );


    if (backTop) {

        window.addEventListener(
            "scroll",
            function () {

                if (
                    window.scrollY > 600
                ) {

                    backTop.classList.add(
                        "show"
                    );

                } else {

                    backTop.classList.remove(
                        "show"
                    );

                }

            },
            {
                passive: true
            }
        );


        backTop.addEventListener(
            "click",
            function () {

                window.scrollTo({

                    top: 0,

                    behavior: "smooth"

                });

            }
        );

    }


    /* =========================================================
       QUICK TIME
    ========================================================= */

    const timeInput =
        document.getElementById(
            "booking-time"
        );

    const summaryTime =
        document.getElementById(
            "summaryTime"
        );


    function updateTimeSummary() {

        if (
            !timeInput ||
            !timeInput.value
        ) {

            if (summaryTime) {

                summaryTime.textContent =
                    "Not selected";

            }

            return;

        }


        const parts =
            timeInput.value.split(":");


        let hour =
            parseInt(
                parts[0],
                10
            );


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


    if (timeInput) {

        timeInput.addEventListener(
            "change",
            updateTimeSummary
        );

    }


    document
        .querySelectorAll(
            ".kv-time-buttons button"
        )
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    document
                        .querySelectorAll(
                            ".kv-time-buttons button"
                        )
                        .forEach(function (btn) {

                            btn.classList.remove(
                                "active"
                            );

                        });


                    this.classList.add(
                        "active"
                    );


                    if (timeInput) {

                        timeInput.value =
                            this.dataset.time;

                        updateTimeSummary();

                    }

                }
            );

        });


    /* =========================================================
       SERVICE CAROUSEL
    ========================================================= */

    const serviceCarousel =
        document.getElementById(
            "serviceCarousel"
        );

    const servicePrev =
        document.querySelector(
            ".service-prev"
        );

    const serviceNext =
        document.querySelector(
            ".service-next"
        );


    if (
        serviceCarousel &&
        servicePrev &&
        serviceNext
    ) {

        serviceNext.addEventListener(
            "click",
            function () {

                serviceCarousel.scrollBy({

                    left: 360,

                    behavior: "smooth"

                });

            }
        );


        servicePrev.addEventListener(
            "click",
            function () {

                serviceCarousel.scrollBy({

                    left: -360,

                    behavior: "smooth"

                });

            }
        );

    }


    /* =========================================================
       GSAP
    ========================================================= */

    if (
        typeof gsap !== "undefined"
    ) {

        if (
            document.querySelector(
                ".hero-inner > *"
            )
        ) {

            gsap.from(
                ".hero-inner > *",
                {
                    y: 40,
                    opacity: 0,
                    duration: 1,
                    stagger: 0.15,
                    delay: 0.4,
                    ease: "power3.out"
                }
            );

        }


        if (
            document.querySelector(
                ".hero-scissors"
            )
        ) {

            gsap.to(
                ".hero-scissors",
                {
                    y: -18,
                    rotation: 12,
                    duration: 2.4,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                }
            );

        }


        if (
            document.querySelector(
                ".hero-heart"
            )
        ) {

            gsap.to(
                ".hero-heart",
                {
                    y: 15,
                    rotation: -10,
                    duration: 3,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                }
            );

        }


        if (
            document.querySelector(
                ".hero-star"
            )
        ) {

            gsap.to(
                ".hero-star",
                {
                    rotation: 360,
                    duration: 7,
                    repeat: -1,
                    ease: "none"
                }
            );

        }

    }


    /* =========================================================
       SCROLL TRIGGER
    ========================================================= */

    if (
        typeof gsap !== "undefined" &&
        typeof ScrollTrigger !== "undefined"
    ) {

        gsap.registerPlugin(
            ScrollTrigger
        );


        gsap.utils
            .toArray(
                ".soft-card, .big-service-card, .process-card, .service-mini-card, .service-card, .booking"
            )
            .forEach(function (card) {

                gsap.from(
                    card,
                    {
                        opacity: 0,
                        y: 40,
                        duration: 0.7,
                        ease: "power3.out",

                        scrollTrigger: {

                            trigger: card,

                            start: "top 88%",

                            once: true

                        }

                    }
                );

            });

    }


    /* =========================================================
       LENIS
    ========================================================= */

    if (
        typeof Lenis !== "undefined"
    ) {

        const lenis =
            new Lenis({
                duration: 1.1,
                smoothWheel: true
            });


        function raf(time) {

            lenis.raf(time);

            requestAnimationFrame(
                raf
            );

        }


        requestAnimationFrame(
            raf
        );

    }


});