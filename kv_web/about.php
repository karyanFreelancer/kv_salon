<?php
session_start();
require __DIR__ . '../../config/connection.php';

$services = [];

$stmt = $conn->prepare("SELECT id, name, description, price, duration FROM services ORDER BY id DESC LIMIT 6");

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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>About KV Salon | Beauty & Hair Studio</title>

    <meta name="description"
          content="Learn more about KV Salon, our salon experience, professional beauty services and customer-first approach.">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <?php include ('../templates/meta_tag.php'); ?>


</head>

<body class="salon-page">

<?php include ('../templates/navbar.php'); ?>

<!-- ================= HERO ================= -->

<section class="inner-hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <span class="eyebrow">
                    ✦ OUR STORY
                </span>

                <h1>
                    Beauty should feel
                    <span>fun.</span>
                </h1>

                <p>
                    Welcome to KV Salon — a friendly,
                    modern and creative beauty studio
                    designed to make every appointment
                    feel special.
                </p>

                <div class="hero-buttons">

                    <a href="booking-form.php"
                       class="cartoon-btn pink-btn">
                        Book Your Visit
                    </a>

                    <a href="services.php"
                       class="cartoon-btn yellow-btn">
                        Explore Services
                    </a>

                </div>

            </div>


            <div class="col-lg-5">

                <div class="about-illustration">

                    <div class="floating-tool tool-scissors">
                        ✂
                    </div>

                    <div class="floating-tool tool-heart">
                        ♥
                    </div>

                    <div class="salon-character">

                        <div class="character-head">

                            <div class="hair-shape"></div>

                            <div class="face">

                                <span class="eye left"></span>
                                <span class="eye right"></span>

                                <span class="smile">
                                    ◡
                                </span>

                            </div>

                        </div>

                        <div class="character-body">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= INTRO ================= -->

<section class="about-intro section-space">

    <div class="container">

        <div class="section-heading text-center">

            <span>
                WHY KV SALON?
            </span>

            <h2>
                More than a salon,
                <br>
                it's your happy place.
            </h2>

            <p>
                We believe salon appointments should
                be relaxing, creative and enjoyable —
                not stressful.
            </p>

        </div>


        <div class="row g-4 mt-4">

            <div class="col-md-4">

                <div class="soft-card">

                    <div class="soft-icon pink">
                        ✂
                    </div>

                    <h3>
                        Creative
                    </h3>

                    <p>
                        Fresh hairstyles, beautiful
                        finishes and creative beauty
                        ideas tailored to you.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="soft-card">

                    <div class="soft-icon yellow">
                        ♥
                    </div>

                    <h3>
                        Friendly
                    </h3>

                    <p>
                        A comfortable environment where
                        you can relax, talk and enjoy
                        your salon time.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="soft-card">

                    <div class="soft-icon purple">
                        ★
                    </div>

                    <h3>
                        Professional
                    </h3>

                    <p>
                        Quality products, experienced
                        professionals and attention to
                        every little detail.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= STORY ================= -->

<section class="story-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="story-art">

                    <div class="art-circle"></div>

                    <div class="art-card card-one">
                        HAIR
                    </div>

                    <div class="art-card card-two">
                        STYLE
                    </div>

                    <div class="art-card card-three">
                        LOVE ♥
                    </div>

                    <div class="art-scissors">
                        ✂
                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <span class="eyebrow">
                    ✦ OUR PHILOSOPHY
                </span>

                <h2 class="large-title">
                    Small details make
                    a big difference.
                </h2>

                <p>
                    At KV Salon, we focus on the complete
                    experience. From the moment you enter
                    to the final mirror check, every part
                    of your visit is designed with care.
                </p>

                <p>
                    Our goal isn't simply to give you a
                    haircut or beauty treatment. We want
                    you to leave feeling confident,
                    refreshed and happy.
                </p>

                <div class="check-list">

                    <div>
                        ✓ Personal attention
                    </div>

                    <div>
                        ✓ Comfortable environment
                    </div>

                    <div>
                        ✓ Modern styling
                    </div>

                    <div>
                        ✓ Quality service
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= NUMBERS ================= -->

<section class="numbers-section">

    <div class="container">

        <div class="row g-4">

            <div class="col-6 col-lg-3">

                <div class="number-card">

                    <strong>
                        5+
                    </strong>

                    <span>
                        Years Experience
                    </span>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="number-card">

                    <strong>
                        2K+
                    </strong>

                    <span>
                        Happy Clients
                    </span>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="number-card">

                    <strong>
                        20+
                    </strong>

                    <span>
                        Beauty Services
                    </span>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="number-card">

                    <strong>
                        4.9
                    </strong>

                    <span>
                        Client Rating
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= SERVICES PREVIEW ================= -->

<section class="section-space">

    <div class="container">

        <div class="section-heading">

            <span>
                WHAT WE DO
            </span>

            <h2>
                Made for your
                <span>style.</span>
            </h2>

        </div>


        <div class="row g-4">

            <?php if (!empty($services)): ?>

                <?php foreach ($services as $service): ?>

                    <div class="col-md-6 col-lg-4">

                        <div class="service-mini-card">

                            <div class="service-mini-icon">
                                ✂
                            </div>

                            <h3>
                                <?= e($service['name']) ?>
                            </h3>

                            <p>
                                <?= e($service['description'] ?? 'Professional salon service.') ?>
                            </p>

                            <div class="service-price">

                                ₹<?= number_format((float)$service['price'], 0) ?>

                                <?php if (!empty($service['duration'])): ?>

                                    <small>
                                        · <?= e($service['duration']) ?>
                                    </small>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">

                    <div class="empty-soft-card">

                        Services are being updated.
                        Please contact KV Salon.

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>


<!-- ================= CTA ================= -->

<section class="cartoon-cta">

    <div class="container">

        <div class="cta-inner">

            <div>

                <span>
                    READY FOR A LITTLE
                    SELF-CARE?
                </span>

                <h2>
                    Let's make you
                    feel amazing.
                </h2>

            </div>

            <a href="booking-form.php"
               class="cartoon-btn dark-btn">

                Book Appointment →

            </a>

        </div>

    </div>

</section>


<?php include ('../templates/footer.php'); ?>