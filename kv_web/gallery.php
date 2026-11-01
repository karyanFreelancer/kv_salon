<?php
session_start();
require __DIR__ . '../../config/connection.php';

// function e($value)
// {
//     return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gallery | KV SALON</title>
    <meta name="description"
          content="Explore KV SALON hair styling, haircut, beauty and salon transformation gallery.">

   <?php include ('../templates/meta_tag.php'); ?>

    <style>
        /* =====================================================
           KV SALON GALLERY
        ===================================================== */

        .gallery-page {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 10% 10%, rgba(255, 218, 224, .55), transparent 25%),
                radial-gradient(circle at 90% 30%, rgba(221, 211, 255, .45), transparent 25%),
                #fffaf5;
        }

        /* decorative objects */

        .gallery-float {
            position: absolute;
            font-size: 42px;
            pointer-events: none;
            z-index: 0;
            animation: galleryFloat 5s ease-in-out infinite;
        }

        .gf-1 {
            top: 170px;
            left: 4%;
        }

        .gf-2 {
            top: 430px;
            right: 4%;
            animation-delay: 1s;
        }

        .gf-3 {
            top: 900px;
            left: 3%;
            animation-delay: 2s;
        }

        .gf-4 {
            top: 1300px;
            right: 5%;
            animation-delay: 1.5s;
        }

        @keyframes galleryFloat {
            0%,100% {
                transform: translateY(0) rotate(-8deg);
            }

            50% {
                transform: translateY(-18px) rotate(8deg);
            }
        }


        /* =====================================================
           HERO
        ===================================================== */

        .gallery-hero {
            position: relative;
            min-height: 470px;
            padding: 125px 0 80px;
            z-index: 1;
        }

        .gallery-kicker {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 18px;
            border: 3px solid #211d26;
            border-radius: 50px;
            background: #ffe08a;
            box-shadow: 5px 5px 0 #211d26;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
        }

        .gallery-title {
            margin-top: 28px;
            font-size: clamp(48px, 8vw, 92px);
            line-height: .9;
            font-weight: 950;
            letter-spacing: -5px;
            color: #211d26;
        }

        .gallery-title span {
            color: #ff6690;
            display: inline-block;
            transform: rotate(-2deg);
        }

        .gallery-description {
            max-width: 650px;
            margin: 28px auto 0;
            color: #655d67;
            font-size: 18px;
            line-height: 1.7;
        }

        .gallery-hero-buttons {
            margin-top: 32px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .gallery-main-btn,
        .gallery-outline-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 14px 23px;
            border-radius: 16px;
            border: 3px solid #211d26;
            font-weight: 900;
            text-decoration: none;
            transition: .25s ease;
        }

        .gallery-main-btn {
            background: #ff6690;
            color: #fff;
            box-shadow: 6px 6px 0 #211d26;
        }

        .gallery-outline-btn {
            background: #fff;
            color: #211d26;
            box-shadow: 5px 5px 0 #211d26;
        }

        .gallery-main-btn:hover,
        .gallery-outline-btn:hover {
            transform: translate(-3px,-3px);
            box-shadow: 9px 9px 0 #211d26;
            color: inherit;
        }


        /* =====================================================
           FILTER
        ===================================================== */

        .gallery-filter {
            position: relative;
            z-index: 5;
            padding: 25px 0 50px;
        }

        .filter-box {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .filter-btn {
            border: 3px solid #211d26;
            background: #fff;
            color: #211d26;
            border-radius: 50px;
            padding: 11px 20px;
            font-weight: 850;
            cursor: pointer;
            box-shadow: 4px 4px 0 #211d26;
            transition: .25s ease;
        }

        .filter-btn:hover {
            transform: translateY(-4px) rotate(-1deg);
        }

        .filter-btn.active {
            background: #211d26;
            color: #fff;
            transform: translateY(-3px);
        }


        /* =====================================================
           GALLERY GRID
        ===================================================== */

        .gallery-section {
            position: relative;
            z-index: 2;
            padding: 20px 0 100px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 22px;
        }

        .gallery-card {
            position: relative;
            overflow: hidden;
            min-height: 310px;
            border: 4px solid #211d26;
            border-radius: 27px;
            background: #fff;
            box-shadow: 8px 8px 0 #211d26;
            cursor: pointer;
            transition:
                transform .35s cubic-bezier(.2,.8,.2,1),
                box-shadow .35s ease;
        }

        .gallery-card:hover {
            transform: translateY(-10px) rotate(-1deg);
            box-shadow: 13px 13px 0 #211d26;
        }

        .gallery-card:nth-child(2n):hover {
            transform: translateY(-10px) rotate(1deg);
        }

        .gallery-card:nth-child(1),
        .gallery-card:nth-child(6) {
            grid-column: span 6;
        }

        .gallery-card:nth-child(2),
        .gallery-card:nth-child(3),
        .gallery-card:nth-child(4),
        .gallery-card:nth-child(5) {
            grid-column: span 3;
        }

        .gallery-card:nth-child(7),
        .gallery-card:nth-child(8) {
            grid-column: span 4;
        }

        .gallery-card:nth-child(9) {
            grid-column: span 4;
        }

        .gallery-card:nth-child(10) {
            grid-column: span 4;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            min-height: 310px;
            object-fit: cover;
            display: block;
            transition: transform .6s cubic-bezier(.2,.8,.2,1);
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.09);
        }

        .gallery-overlay {
            position: absolute;
            inset: auto 0 0 0;
            padding: 60px 22px 20px;
            background: linear-gradient(
                to top,
                rgba(20,17,22,.92),
                rgba(20,17,22,0)
            );
            color: #fff;
            transform: translateY(10px);
            transition: .3s ease;
        }

        .gallery-card:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-category {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 30px;
            background: #ffe08a;
            color: #211d26;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid #211d26;
        }

        .gallery-overlay h3 {
            margin: 9px 0 0;
            font-size: 22px;
            font-weight: 900;
        }

        .gallery-view {
            position: absolute;
            top: 17px;
            right: 17px;
            width: 47px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff;
            color: #211d26;
            border: 3px solid #211d26;
            box-shadow: 4px 4px 0 #211d26;
            font-size: 20px;
            transform: scale(.7) rotate(-20deg);
            opacity: 0;
            transition: .3s ease;
        }

        .gallery-card:hover .gallery-view {
            opacity: 1;
            transform: scale(1) rotate(0);
        }


        /* =====================================================
           STATS
        ===================================================== */

        .gallery-stats {
            padding: 30px 0 100px;
        }

        .stat-card {
            height: 100%;
            padding: 28px;
            border: 3px solid #211d26;
            border-radius: 25px;
            background: #fff;
            box-shadow: 7px 7px 0 #211d26;
            text-align: center;
            transition: .3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px) rotate(-1deg);
        }

        .stat-icon {
            font-size: 35px;
        }

        .stat-number {
            margin-top: 8px;
            font-size: 38px;
            font-weight: 950;
        }

        .stat-text {
            color: #756d76;
            font-weight: 700;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .gallery-cta {
            margin: 40px 0 100px;
            padding: 65px 35px;
            position: relative;
            overflow: hidden;
            border: 4px solid #211d26;
            border-radius: 35px;
            background: #cbbaff;
            box-shadow: 10px 10px 0 #211d26;
            text-align: center;
        }

        .gallery-cta::before {
            content: "✂";
            position: absolute;
            left: 5%;
            top: 20%;
            font-size: 75px;
            opacity: .25;
            transform: rotate(-25deg);
        }

        .gallery-cta::after {
            content: "♥";
            position: absolute;
            right: 6%;
            bottom: 15%;
            font-size: 80px;
            opacity: .25;
            transform: rotate(18deg);
        }

        .gallery-cta h2 {
            position: relative;
            z-index: 2;
            font-size: clamp(35px, 5vw, 65px);
            font-weight: 950;
            letter-spacing: -2px;
        }

        .gallery-cta p {
            position: relative;
            z-index: 2;
            max-width: 650px;
            margin: 15px auto 28px;
            font-size: 17px;
            color: #514b58;
        }


        /* =====================================================
           LIGHTBOX
        ===================================================== */

        .gallery-lightbox {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 25px;
            background: rgba(19,16,23,.90);
            backdrop-filter: blur(10px);
        }

        .gallery-lightbox.show {
            display: flex;
        }

        .lightbox-inner {
            position: relative;
            width: min(1000px, 100%);
            max-height: 90vh;
            text-align: center;
        }

        .lightbox-inner img {
            max-width: 100%;
            max-height: 78vh;
            object-fit: contain;
            border: 4px solid #211d26;
            border-radius: 25px;
            box-shadow: 12px 12px 0 rgba(0,0,0,.6);
        }

        .lightbox-close {
            position: absolute;
            top: -20px;
            right: -10px;
            width: 50px;
            height: 50px;
            border: 3px solid #211d26;
            border-radius: 50%;
            background: #ff6690;
            color: #fff;
            font-size: 23px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 5px 5px 0 #211d26;
        }

        .lightbox-title {
            color: #fff;
            margin-top: 17px;
            font-size: 24px;
            font-weight: 900;
        }


        /* =====================================================
           FIXED BOOKING
        ===================================================== */

        .gallery-fixed-book {
            position: fixed;
            right: 22px;
            bottom: 24px;
            z-index: 9000;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 13px 20px;
            border: 3px solid #211d26;
            border-radius: 50px;
            background: #ff6690;
            color: #fff;
            text-decoration: none;
            font-weight: 950;
            box-shadow: 6px 6px 0 #211d26;
            animation: bookFloat 2.2s ease-in-out infinite;
        }

        .gallery-fixed-book:hover {
            color: #fff;
            transform: translateY(-4px);
        }

        @keyframes bookFloat {
            0%,100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 991px) {

            .gallery-card:nth-child(1),
            .gallery-card:nth-child(6) {
                grid-column: span 6;
            }

            .gallery-card:nth-child(2),
            .gallery-card:nth-child(3),
            .gallery-card:nth-child(4),
            .gallery-card:nth-child(5),
            .gallery-card:nth-child(7),
            .gallery-card:nth-child(8),
            .gallery-card:nth-child(9),
            .gallery-card:nth-child(10) {
                grid-column: span 6;
            }
        }

        @media(max-width: 575px) {

            .gallery-hero {
                min-height: 430px;
                padding: 105px 15px 60px;
            }

            .gallery-title {
                letter-spacing: -3px;
            }

            .gallery-description {
                font-size: 16px;
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }

            .gallery-card,
            .gallery-card:nth-child(1),
            .gallery-card:nth-child(2),
            .gallery-card:nth-child(3),
            .gallery-card:nth-child(4),
            .gallery-card:nth-child(5),
            .gallery-card:nth-child(6),
            .gallery-card:nth-child(7),
            .gallery-card:nth-child(8),
            .gallery-card:nth-child(9),
            .gallery-card:nth-child(10) {
                grid-column: span 1;
                min-height: 230px;
                border-width: 3px;
                border-radius: 20px;
                box-shadow: 5px 5px 0 #211d26;
            }

            .gallery-card:first-child,
            .gallery-card:nth-child(6) {
                grid-column: span 2;
            }

            .gallery-image {
                min-height: 230px;
            }

            .gallery-overlay {
                padding: 45px 12px 12px;
            }

            .gallery-overlay h3 {
                font-size: 16px;
            }

            .gallery-category {
                font-size: 9px;
                padding: 4px 8px;
            }

            .gallery-view {
                width: 38px;
                height: 38px;
                font-size: 16px;
                top: 9px;
                right: 9px;
            }

            .filter-box {
                justify-content: flex-start;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding: 4px 5px 12px;
            }

            .filter-btn {
                white-space: nowrap;
                padding: 9px 15px;
                font-size: 13px;
            }

            .gallery-fixed-book {
                right: 14px;
                bottom: 15px;
                padding: 11px 16px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="gallery-page">

    <!-- Decorative -->
    <div class="gallery-float gf-1">✂️</div>
    <div class="gallery-float gf-2">✨</div>
    <div class="gallery-float gf-3">🪮</div>
    <div class="gallery-float gf-4">♥</div>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

   <?php include ('../templates/navbar.php'); ?>

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="gallery-hero text-center">

        <div class="container">

            <div class="gallery-kicker">
                ✨ KV SALON • STYLE GALLERY
            </div>

            <h1 class="gallery-title">
                Our <span>Beauty</span><br>
                Gallery
            </h1>

            <p class="gallery-description">
                Take a little tour through our salon world —
                beautiful haircuts, styling, transformations,
                beauty moments and the KV SALON experience.
            </p>

            <div class="gallery-hero-buttons">

                <a href="gallery.php" class="gallery-main-btn">
                    Explore Gallery ✨
                </a>

                <a href="booking-form.php" class="gallery-outline-btn">
                    Book Your Look ✂
                </a>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FILTER
    ====================================================== -->

    <section class="gallery-filter" id="gallery">

        <div class="container">

            <div class="filter-box">

                <button class="filter-btn active" data-filter="all">
                    All
                </button>

                <button class="filter-btn" data-filter="hair">
                    Hair
                </button>

                <button class="filter-btn" data-filter="cut">
                    Haircut
                </button>

                <button class="filter-btn" data-filter="style">
                    Styling
                </button>

                <button class="filter-btn" data-filter="beauty">
                    Beauty
                </button>

                <button class="filter-btn" data-filter="salon">
                    Salon
                </button>

            </div>

        </div>

    </section>


    <!-- =====================================================
         GALLERY
    ====================================================== -->

    <section class="gallery-section">

        <div class="container">

            <div class="gallery-grid">

                <!-- 1 -->
                <div class="gallery-card" data-category="hair">

                    <img
                        src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=85"
                        class="gallery-image"
                        alt="Professional hair styling"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Hair</span>
                        <h3>Signature Hair Style</h3>
                    </div>

                </div>


                <!-- 2 -->
                <div class="gallery-card" data-category="cut">

                    <img
                        src="https://images.unsplash.com/photo-1599351431202-1e0f0d3b1d6c?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Modern haircut"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Haircut</span>
                        <h3>Fresh Cut</h3>
                    </div>

                </div>


                <!-- 3 -->
                <div class="gallery-card" data-category="style">

                    <img
                        src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Hair styling"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Styling</span>
                        <h3>Beautiful Finish</h3>
                    </div>

                </div>


                <!-- 4 -->
                <div class="gallery-card" data-category="beauty">

                    <img
                        src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Beauty salon"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Beauty</span>
                        <h3>Beauty Moment</h3>
                    </div>

                </div>


                <!-- 5 -->
                <div class="gallery-card" data-category="hair">

                    <img
                        src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Salon hair service"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Hair</span>
                        <h3>Salon Glow</h3>
                    </div>

                </div>


                <!-- 6 -->
                <div class="gallery-card" data-category="style">

                    <img
                        src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?auto=format&fit=crop&w=1200&q=85"
                        class="gallery-image"
                        alt="Hair transformation"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Styling</span>
                        <h3>Complete Transformation</h3>
                    </div>

                </div>


                <!-- 7 -->
                <div class="gallery-card" data-category="cut">

                    <img
                        src="https://images.unsplash.com/photo-1593702288056-f8b7f0f0a9bb?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Haircut salon"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Haircut</span>
                        <h3>Modern Look</h3>
                    </div>

                </div>


                <!-- 8 -->
                <div class="gallery-card" data-category="salon">

                    <img
                        src="https://images.unsplash.com/photo-1633681926022-84c23e8cb2d6?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Salon interior"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Salon</span>
                        <h3>Our Happy Place</h3>
                    </div>

                </div>


                <!-- 9 -->
                <div class="gallery-card" data-category="beauty">

                    <img
                        src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Beauty treatment"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Beauty</span>
                        <h3>Self Care</h3>
                    </div>

                </div>


                <!-- 10 -->
                <div class="gallery-card" data-category="hair">

                    <img
                        src="https://images.unsplash.com/photo-1560869713-da86a9ec0320?auto=format&fit=crop&w=900&q=85"
                        class="gallery-image"
                        alt="Professional hair salon"
                    >

                    <div class="gallery-view">↗</div>

                    <div class="gallery-overlay">
                        <span class="gallery-category">Hair</span>
                        <h3>Styled With Love</h3>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         STATS
    ====================================================== -->

    <section class="gallery-stats">

        <div class="container">

            <div class="row g-4">

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">✂️</div>
                        <div class="stat-number">5K+</div>
                        <div class="stat-text">Happy Clients</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">💇</div>
                        <div class="stat-number">10K+</div>
                        <div class="stat-text">Hair Services</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">✨</div>
                        <div class="stat-number">8+</div>
                        <div class="stat-text">Years Experience</div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">♥</div>
                        <div class="stat-number">4.9</div>
                        <div class="stat-text">Client Rating</div>
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="container">

        <div class="gallery-cta">

            <h2>
                Ready for your<br>
                <span>next look?</span>
            </h2>

            <p>
                Don't just look at the transformation.
                Come experience it yourself at KV SALON.
            </p>

            <a href="booking-form.php" class="gallery-main-btn">
                Book Appointment ✂
            </a>

        </div>

    </section>

<!-- =====================================================
     LIGHTBOX
====================================================== -->

<div class="gallery-lightbox" id="galleryLightbox">

    <div class="lightbox-inner">

        <button class="lightbox-close" id="lightboxClose">
            ×
        </button>

        <img id="lightboxImage" src="" alt="Gallery preview">

        <div class="lightbox-title" id="lightboxTitle"></div>

    </div>

</div>


<?php include ('../templates/footer.php'); ?>
<script>
document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       FILTER
    ===================================================== */

    const buttons = document.querySelectorAll(".filter-btn");
    const cards = document.querySelectorAll(".gallery-card");

    buttons.forEach(button => {

        button.addEventListener("click", () => {

            const filter = button.dataset.filter;

            buttons.forEach(btn => {
                btn.classList.remove("active");
            });

            button.classList.add("active");

            cards.forEach(card => {

                const category = card.dataset.category;

                if (filter === "all" || category === filter) {

                    card.style.display = "";

                    gsap.fromTo(
                        card,
                        {
                            opacity: 0,
                            scale: .88,
                            y: 25
                        },
                        {
                            opacity: 1,
                            scale: 1,
                            y: 0,
                            duration: .45,
                            ease: "back.out(1.5)"
                        }
                    );

                } else {

                    card.style.display = "none";

                }

            });

        });

    });


    /* =====================================================
       LIGHTBOX
    ===================================================== */

    const lightbox = document.getElementById("galleryLightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxTitle = document.getElementById("lightboxTitle");
    const closeButton = document.getElementById("lightboxClose");

    cards.forEach(card => {

        card.addEventListener("click", () => {

            const image = card.querySelector(".gallery-image");
            const title = card.querySelector("h3");

            lightboxImage.src = image.src;
            lightboxTitle.textContent = title.textContent;

            lightbox.classList.add("show");

            document.body.style.overflow = "hidden";

            gsap.fromTo(
                ".lightbox-inner",
                {
                    scale: .75,
                    opacity: 0,
                    y: 30
                },
                {
                    scale: 1,
                    opacity: 1,
                    y: 0,
                    duration: .4,
                    ease: "back.out(1.5)"
                }
            );

        });

    });


    function closeLightbox() {

        lightbox.classList.remove("show");

        document.body.style.overflow = "";

    }

    closeButton.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", e => {

        if (e.target === lightbox) {
            closeLightbox();
        }

    });


    document.addEventListener("keydown", e => {

        if (e.key === "Escape") {
            closeLightbox();
        }

    });


    /* =====================================================
       CARD ENTRANCE
    ===================================================== */

    gsap.from(".gallery-card", {
        opacity: 0,
        y: 45,
        scale: .96,
        duration: .8,
        stagger: .08,
        ease: "power3.out"
    });


    /* =====================================================
       DECORATIONS
    ===================================================== */

    gsap.to(".gallery-float", {
        y: -15,
        rotation: 8,
        duration: 2.5,
        stagger: .4,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

});
</script>

</body>
</html>