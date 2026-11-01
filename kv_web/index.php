<?php

session_start();

require __DIR__ . '../../config/connection.php';
/* =========================================================
   SERVICES
========================================================= */

$services = [];

$stmt = $conn->prepare("
    SELECT *
    FROM services
    ORDER BY id DESC
    LIMIT 12
");

if ($stmt) {

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {

        $services[] = $row;

    }

    $stmt->close();
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
   <?php include ('../templates/meta_tag.php'); ?>

    <!-- =====================================================
         BASIC SEO
    ====================================================== -->

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <meta
        name="description"
        content="<?= htmlspecialchars($pageDescription) ?>"
    >

    <meta
        name="keywords"
        content="<?= htmlspecialchars($pageKeywords) ?>"
    >

    <meta
        name="author"
        content="KV Salon"
    >

    <meta
        name="robots"
        content="index, follow, max-image-preview:large"
    >

    <link
        rel="canonical"
        href="<?= htmlspecialchars($canonicalUrl) ?>"
    >

    <!-- =====================================================
         OPEN GRAPH — FACEBOOK / WHATSAPP / LINK PREVIEW
    ====================================================== -->

    <meta
        property="og:type"
        content="website"
    >

    <meta
        property="og:title"
        content="<?= htmlspecialchars($pageTitle) ?>"
    >

    <meta
        property="og:description"
        content="<?= htmlspecialchars($pageDescription) ?>"
    >

    <meta
        property="og:url"
        content="<?= htmlspecialchars($canonicalUrl) ?>"
    >

    <meta
        property="og:site_name"
        content="KV Salon"
    >

    <meta
        property="og:image"
        content="https://yourdomain.com/assets/images/kv-salon-og.jpg"
    >

    <meta
        property="og:image:alt"
        content="KV Salon - Hair, Beauty & Style"
    >


    <!-- =====================================================
         TWITTER / X
    ====================================================== -->

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="<?= htmlspecialchars($pageTitle) ?>"
    >

    <meta
        name="twitter:description"
        content="<?= htmlspecialchars($pageDescription) ?>"
    >

    <meta
        name="twitter:image"
        content="https://yourdomain.com/assets/images/kv-salon-og.jpg"
    >


    <!-- =====================================================
         THEME
    ====================================================== -->

    <meta
        name="theme-color"
        content="#ffb9d0"
    >

</head>

<body class="salon-page">
<?php include ('../templates/navbar.php'); ?>
<!-- ========================================================
     HERO CAROUSEL
======================================================== -->

<section class="kv-hero">

    <div class="hero-decoration hero-star">
        ✦
    </div>

    <div class="hero-decoration hero-heart">
        ♥
    </div>

    <div class="hero-decoration hero-scissors">
        ✂
    </div>

    <div class="hero-decoration hero-spark">
        ✨
    </div>


    <div class="container">

        <div
            id="salonHeroCarousel"
            class="carousel slide"
            data-bs-ride="carousel"
            data-bs-interval="5000"
        >

            <div class="carousel-inner">


                <!-- SLIDE 1 -->

                <div class="carousel-item active">

                    <div class="row align-items-center">

                        <div class="col-lg-6">

                            <div class="hero-content">

                                <span class="eyebrow">
                                    ✦ WELCOME TO KV SALON
                                </span>

                                <h1>

                                    Your hair.

                                    <br>

                                    Your

                                    <span>
                                        style.
                                    </span>

                                </h1>

                                <p>

                                    A playful, modern and
                                    professional salon experience
                                    created around you.

                                </p>


                                <div class="hero-buttons">

                                    <a
                                        href="booking-form.php"
                                        class="cartoon-btn pink-btn"
                                    >
                                        Book Appointment
                                        →
                                    </a>


                                    <a
                                        href="services.php"
                                        class="cartoon-btn yellow-btn"
                                    >
                                        Explore Services
                                    </a>

                                </div>


                                <div class="hero-rating">

                                    <div class="rating-stars">
                                        ★★★★★
                                    </div>

                                    <span>
                                        Loved by our clients
                                    </span>

                                </div>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="hero-visual">

                                <div class="hero-circle">
                                </div>


                                <div class="hero-photo-card">

                                    <div class="fake-salon-person">

                                        <div class="fake-hair">
                                        </div>

                                        <div class="fake-face">

                                            <span></span>
                                            <span></span>

                                            <b>
                                                ◡
                                            </b>

                                        </div>

                                        <div class="fake-body">
                                        </div>

                                    </div>

                                </div>


                                <div class="hero-sticker sticker-one">
                                    ✂
                                </div>

                                <div class="hero-sticker sticker-two">
                                    ♥
                                </div>

                                <div class="hero-sticker sticker-three">
                                    ★
                                </div>


                                <div class="hero-mini-card">

                                    <strong>
                                        2K+
                                    </strong>

                                    <span>
                                        Happy Clients
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- SLIDE 2 -->

                <div class="carousel-item">

                    <div class="row align-items-center">

                        <div class="col-lg-6">

                            <div class="hero-content">

                                <span class="eyebrow">
                                    ✦ HAIR & BEAUTY
                                </span>

                                <h1>

                                    Feel

                                    <span>
                                        fresh.
                                    </span>

                                    <br>

                                    Look amazing.

                                </h1>

                                <p>

                                    From everyday cuts to special
                                    occasion styling, let's create
                                    your perfect look.

                                </p>


                                <div class="hero-buttons">

                                    <a
                                        href="services.php"
                                        class="cartoon-btn pink-btn"
                                    >
                                        See Services →
                                    </a>

                                    <a
                                        href="booking-form.php"
                                        class="cartoon-btn purple-btn"
                                    >
                                        Book Now
                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="hero-color-art">

                                <div class="color-blob blob-pink">
                                </div>

                                <div class="color-blob blob-yellow">
                                </div>

                                <div class="color-blob blob-purple">
                                </div>

                                <div class="big-scissors">
                                    ✂
                                </div>

                                <div class="big-comb">
                                    🪮
                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- SLIDE 3 -->

                <div class="carousel-item">

                    <div class="row align-items-center">

                        <div class="col-lg-6">

                            <div class="hero-content">

                                <span class="eyebrow">
                                    ✦ YOUR SALON DAY
                                </span>

                                <h1>

                                    Relax.

                                    <br>

                                    Refresh.

                                    <span>
                                        Glow.
                                    </span>

                                </h1>

                                <p>

                                    Take some time for yourself.
                                    You deserve a little beauty
                                    break.

                                </p>


                                <div class="hero-buttons">

                                    <a
                                        href="booking-form.php"
                                        class="cartoon-btn dark-btn"
                                    >
                                        Reserve Your Chair
                                        →
                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="hero-quote-card">

                                <div class="quote-mark">
                                    “
                                </div>

                                <h3>

                                    Good hair days
                                    start here.

                                </h3>

                                <p>

                                    Professional care,
                                    creative styling and
                                    a friendly atmosphere.

                                </p>

                                <div class="quote-heart">
                                    ♥
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CONTROLS -->

            <button
                class="carousel-control-prev kv-carousel-control"
                type="button"
                data-bs-target="#salonHeroCarousel"
                data-bs-slide="prev"
            >

                <span>
                    ←
                </span>

            </button>


            <button
                class="carousel-control-next kv-carousel-control"
                type="button"
                data-bs-target="#salonHeroCarousel"
                data-bs-slide="next"
            >

                <span>
                    →
                </span>

            </button>


            <!-- INDICATORS -->

            <div class="carousel-indicators kv-carousel-indicators">

                <button
                    type="button"
                    data-bs-target="#salonHeroCarousel"
                    data-bs-slide-to="0"
                    class="active"
                ></button>

                <button
                    type="button"
                    data-bs-target="#salonHeroCarousel"
                    data-bs-slide-to="1"
                ></button>

                <button
                    type="button"
                    data-bs-target="#salonHeroCarousel"
                    data-bs-slide-to="2"
                ></button>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================
     INFINITE SERVICE TICKER
======================================================== -->

<section class="service-marquee">

    <div class="marquee-track">

        <span>
            HAIR CUT
        </span>

        <b>✂</b>

        <span>
            HAIR COLOR
        </span>

        <b>♥</b>

        <span>
            STYLING
        </span>

        <b>★</b>

        <span>
            BEAUTY CARE
        </span>

        <b>✂</b>

        <span>
            HAIR SPA
        </span>

        <b>♥</b>

        <span>
            HAIR CUT
        </span>

        <b>✂</b>

        <span>
            HAIR COLOR
        </span>

        <b>★</b>

    </div>

</section>



<!-- ========================================================
     QUICK INTRO
======================================================== -->

<section class="section-space home-intro">

    <div class="container">

        <div class="row align-items-center g-5">


            <div class="col-lg-6">

                <span class="eyebrow">
                    ✦ A LITTLE ABOUT US
                </span>

                <h2 class="large-title">

                    A salon made

                    <span>
                        for you.
                    </span>

                </h2>

                <p class="intro-text">

                    KV Salon brings together professional
                    hair care, beauty treatments and a
                    relaxed atmosphere where you can
                    simply be yourself.

                </p>


                <div class="intro-points">

                    <div>
                        <span>✓</span>
                        Professional care
                    </div>

                    <div>
                        <span>✓</span>
                        Comfortable environment
                    </div>

                    <div>
                        <span>✓</span>
                        Personalized styling
                    </div>

                </div>


                <a
                    href="about.php"
                    class="text-arrow-btn"
                >
                    More about KV Salon
                    →
                </a>

            </div>


            <div class="col-lg-6">

                <div class="intro-art">

                    <div class="intro-main-circle">
                    </div>

                    <div class="intro-card intro-card-one">

                        <strong>
                            5+
                        </strong>

                        <span>
                            Years Experience
                        </span>

                    </div>


                    <div class="intro-card intro-card-two">

                        <strong>
                            20+
                        </strong>

                        <span>
                            Services
                        </span>

                    </div>


                    <div class="intro-tool">
                        ✂
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================
     SERVICES
======================================================== -->

<section class="home-services section-space">

    <div class="container">


        <div class="section-heading-row">

            <div>

                <span>
                    ✦ OUR SERVICES
                </span>

                <h2>
                    What can we
                    <span>do for you?</span>
                </h2>

            </div>


            <a
                href="services.php"
                class="cartoon-outline-btn"
            >
                View All Services →
            </a>

        </div>


        <div class="service-carousel-wrap">


            <button
                class="service-arrow service-prev"
                type="button"
            >
                ←
            </button>


            <div
                class="service-carousel"
                id="serviceCarousel"
            >


                <?php if (!empty($services)): ?>


                    <?php foreach ($services as $index => $service): ?>

                        <article class="home-service-card">


                            <div class="home-service-art">

                                <div class="service-icon-circle">

                                    <?php

                                    $icons = [
                                        '✂',
                                        '💇',
                                        '★',
                                        '♥',
                                        '🪮',
                                        '✨'
                                    ];

                                    echo $icons[
                                        $index % count($icons)
                                    ];

                                    ?>

                                </div>


                                <span class="service-floating-star">
                                    ✦
                                </span>

                            </div>


                            <div class="home-service-content">

                                <span class="service-small-number">

                                    <?= str_pad(
                                        (string)($index + 1),
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) ?>

                                </span>


                                <h3>

                                    <?= e(
                                        $service['name']
                                        ?? 'Salon Service'
                                    ) ?>

                                </h3>


                                <p>

                                    <?= e(
                                        $service['description']
                                        ?? 'Professional salon service with quality care.'
                                    ) ?>

                                </p>


                                <div class="home-service-bottom">

                                    <strong>

                                        ₹<?= number_format(
                                            (float)(
                                                $service['price']
                                                ?? 0
                                            ),
                                            0
                                        ) ?>

                                    </strong>


                                    <a
                                        href="booking-form.php?service=<?= (int)$service['id'] ?>"
                                    >
                                        Book →
                                    </a>

                                </div>

                            </div>

                        </article>

                    <?php endforeach; ?>


                <?php else: ?>


                    <div class="empty-soft-card">

                        <div class="soft-icon pink">
                            ✂
                        </div>

                        <h3>
                            Services coming soon
                        </h3>

                        <p>
                            Our service menu is being updated.
                        </p>

                    </div>


                <?php endif; ?>


            </div>


            <button
                class="service-arrow service-next"
                type="button"
            >
                →
            </button>


        </div>

    </div>

</section>



<!-- ========================================================
     WHY US
======================================================== -->

<section class="why-section">

    <div class="container">

        <div class="section-heading text-center">

            <span>
                ✦ WHY CHOOSE US
            </span>

            <h2>

                Salon care with a
                <span>
                    little more love.
                </span>

            </h2>

        </div>


        <div class="row g-4 mt-5">


            <div class="col-md-6 col-lg-3">

                <div class="why-card">

                    <div class="why-number">
                        01
                    </div>

                    <div class="why-icon">
                        ✂
                    </div>

                    <h3>
                        Skilled Styling
                    </h3>

                    <p>
                        Professional attention to
                        every cut and style.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="why-card">

                    <div class="why-number">
                        02
                    </div>

                    <div class="why-icon">
                        ♥
                    </div>

                    <h3>
                        Personal Care
                    </h3>

                    <p>
                        Your preferences always
                        come first.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="why-card">

                    <div class="why-number">
                        03
                    </div>

                    <div class="why-icon">
                        ★
                    </div>

                    <h3>
                        Quality Products
                    </h3>

                    <p>
                        We care about the products
                        used on your hair.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="why-card">

                    <div class="why-number">
                        04
                    </div>

                    <div class="why-icon">
                        ✨
                    </div>

                    <h3>
                        Happy Results
                    </h3>

                    <p>
                        Walk out feeling fresh,
                        confident and happy.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- ========================================================
     SALON EXPERIENCE
======================================================== -->

<section class="experience-section">

    <div class="container">

        <div class="row align-items-center g-5">


            <div class="col-lg-6">

                <div class="experience-visual">

                    <div class="experience-circle">
                    </div>

                    <div class="experience-word">
                        GLOW
                    </div>

                    <div class="experience-scissors">
                        ✂
                    </div>

                    <div class="experience-heart">
                        ♥
                    </div>

                    <div class="experience-star">
                        ★
                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <span class="eyebrow">
                    ✦ THE KV EXPERIENCE
                </span>

                <h2 class="large-title">

                    Come for the
                    <span>
                        hair.
                    </span>

                    <br>

                    Stay for the
                    <span>
                        feeling.
                    </span>

                </h2>

                <p>

                    We want your appointment to feel
                    like a little break from your day.
                    Sit back, relax and let us take care
                    of the details.

                </p>


                <div class="experience-list">

                    <div>

                        <span>
                            01
                        </span>

                        <div>

                            <strong>
                                Consultation
                            </strong>

                            <p>
                                Tell us what you're looking for.
                            </p>

                        </div>

                    </div>


                    <div>

                        <span>
                            02
                        </span>

                        <div>

                            <strong>
                                Styling
                            </strong>

                            <p>
                                Sit back while we work our magic.
                            </p>

                        </div>

                    </div>


                    <div>

                        <span>
                            03
                        </span>

                        <div>

                            <strong>
                                Final Look
                            </strong>

                            <p>
                                Check the mirror and enjoy.
                            </p>

                        </div>

                    </div>

                </div>


                <a
                    href="booking-form.php"
                    class="cartoon-btn dark-btn"
                >
                    Start Your Experience →
                </a>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================
     GALLERY
======================================================== -->

<section
    class="gallery-section section-space"
    id="gallery"
>

    <div class="container">

        <div class="section-heading text-center">

            <span>
                ✦ OUR WORLD
            </span>

            <h2>

                A little
                <span>
                    salon inspiration.
                </span>

            </h2>

        </div>


        <div class="gallery-grid">


            <div class="gallery-box gallery-large">

                <div>
                    ✂
                </div>

                <span>
                    HAIR
                </span>

            </div>


            <div class="gallery-box gallery-pink">

                <div>
                    ♥
                </div>

                <span>
                    BEAUTY
                </span>

            </div>


            <div class="gallery-box gallery-yellow">

                <div>
                    ★
                </div>

                <span>
                    STYLE
                </span>

            </div>


            <div class="gallery-box gallery-purple">

                <div>
                    ✨
                </div>

                <span>
                    GLOW
                </span>

            </div>


            <div class="gallery-box gallery-small">

                <div>
                    🪮
                </div>

                <span>
                    CARE
                </span>

            </div>


        </div>

    </div>

</section>



<!-- ========================================================
     TESTIMONIAL CAROUSEL
======================================================== -->

<section class="testimonial-section">

    <div class="container">

        <div class="section-heading text-center">

            <span>
                ✦ CLIENT LOVE
            </span>

            <h2>
                Don't just take
                <span>our word for it.</span>
            </h2>

        </div>


        <div
            id="testimonialCarousel"
            class="carousel slide testimonial-carousel"
            data-bs-ride="carousel"
            data-bs-interval="4500"
        >


            <div class="carousel-inner">


                <div class="carousel-item active">

                    <div class="testimonial-card">

                        <div class="testimonial-stars">
                            ★★★★★
                        </div>

                        <blockquote>

                            “Amazing service and such a
                            comfortable atmosphere. I loved
                            my new hairstyle.”

                        </blockquote>

                        <div class="testimonial-person">

                            <div class="testimonial-avatar">
                                A
                            </div>

                            <div>

                                <strong>
                                    Happy Client
                                </strong>

                                <span>
                                    Regular Customer
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="carousel-item">

                    <div class="testimonial-card">

                        <div class="testimonial-stars">
                            ★★★★★
                        </div>

                        <blockquote>

                            “The staff is friendly and the
                            overall experience is wonderful.
                            Definitely coming back.”

                        </blockquote>

                        <div class="testimonial-person">

                            <div class="testimonial-avatar">
                                R
                            </div>

                            <div>

                                <strong>
                                    Happy Client
                                </strong>

                                <span>
                                    Beauty Customer
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="carousel-item">

                    <div class="testimonial-card">

                        <div class="testimonial-stars">
                            ★★★★★
                        </div>

                        <blockquote>

                            “Finally found a salon where
                            they actually listen to what
                            I want.”

                        </blockquote>

                        <div class="testimonial-person">

                            <div class="testimonial-avatar">
                                S
                            </div>

                            <div>

                                <strong>
                                    Happy Client
                                </strong>

                                <span>
                                    Salon Customer
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


            <button
                class="testimonial-prev"
                type="button"
                data-bs-target="#testimonialCarousel"
                data-bs-slide="prev"
            >
                ←
            </button>


            <button
                class="testimonial-next"
                type="button"
                data-bs-target="#testimonialCarousel"
                data-bs-slide="next"
            >
                →
            </button>


        </div>

    </div>

</section>



<!-- ========================================================
     BOOKING CTA
======================================================== -->

<section class="home-booking-cta">

    <div class="container">

        <div class="booking-cta-box">

            <div class="cta-decoration">
                ✂
            </div>

            <div class="cta-decoration-two">
                ♥
            </div>


            <span>
                ✦ YOUR CHAIR IS WAITING
            </span>

            <h2>

                Ready for your
                <br>

                next
                <span>
                    salon day?
                </span>

            </h2>

            <p>

                Pick your service, choose your
                time and let KV Salon take care
                of the rest.

            </p>


            <a
                href="booking-form.php"
                class="big-book-btn"
            >

                Book My Appointment

                <span>
                    →
                </span>

            </a>

        </div>

    </div>

</section>



<!-- ========================================================
     CONTACT
======================================================== -->

<section
    class="contact-section section-space"
    id="contact"
>

    <div class="container">

        <div class="row g-4">


            <div class="col-lg-7">

                <span class="eyebrow">
                    ✦ COME SAY HELLO
                </span>

                <h2 class="large-title">

                    Let's talk
                    <span>
                        beauty.
                    </span>

                </h2>

                <p>

                    Have a question about a service,
                    appointment or styling? We'd love
                    to hear from you.

                </p>

            </div>


            <div class="col-lg-5">

                <div class="contact-card">

                    <div class="contact-item">

                        <span>
                            ☎
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


                    <div class="contact-item">

                        <span>
                            ✉
                        </span>

                        <div>

                            <small>
                                EMAIL
                            </small>

                            <a href="mailto:hello@kvsalon.com">
                                hello@kvsalon.com
                            </a>

                        </div>

                    </div>


                    <div class="contact-item">

                        <span>
                            📍
                        </span>

                        <div>

                            <small>
                                VISIT
                            </small>

                            <strong>
                                KV Salon
                            </strong>

                            <p>
                                Your City, Bihar
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================
     FOOTER
======================================================== -->

<?php include ('../templates/footer.php'); ?>