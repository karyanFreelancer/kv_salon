<?php

session_start();

require __DIR__ . '../../config/connection.php';

$services = [];

$stmt = $conn->prepare("
    SELECT *
    FROM services
    ORDER BY id DESC
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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Salon Services | KV Salon</title>

    <meta name="description"
          content="Explore hair, beauty and salon services available at KV Salon.">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <?php include ('../templates/meta_tag.php'); ?>


</head>

<body class="salon-page">


<!-- NAVBAR -->

<?php include ('../templates/navbar.php'); ?>

<!-- HERO -->

<section class="inner-hero services-hero">

    <div class="container">

        <div class="text-center">

            <span class="eyebrow">
                ✦ OUR SERVICES
            </span>

            <h1>
                Your style.
                <span>Your rules.</span>
            </h1>

            <p class="mx-auto">

                From quick trims to complete
                beauty makeovers, choose the
                service that makes you feel your best.

            </p>

        </div>

    </div>

</section>


<!-- SERVICES -->

<section class="section-space">

    <div class="container">


        <div class="section-heading text-center">

            <span>
                KV SALON MENU
            </span>

            <h2>
                Pick your
                <span>favourite.</span>
            </h2>

        </div>


        <div class="row g-4 mt-4">


            <?php if (!empty($services)): ?>


                <?php foreach ($services as $service): ?>

                    <div class="col-12 col-sm-6 col-lg-4">

                        <article class="big-service-card">


                            <div class="service-doodle">

                                <span>
                                    ✂
                                </span>

                            </div>


                            <div class="service-card-content">


                                <div class="service-number">

                                    <?= str_pad(
                                        (string)($service['id'] ?? 0),
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) ?>

                                </div>


                                <h3>

                                    <?= e(
                                        $service['name'] ?? 'Salon Service'
                                    ) ?>

                                </h3>


                                <p>

                                    <?= e(
                                        $service['description']
                                        ?? 'Professional salon service with quality care.'
                                    ) ?>

                                </p>


                                <div class="service-meta">


                                    <div class="service-price">

                                        ₹<?= number_format(
                                            (float)($service['price'] ?? 0),
                                            0
                                        ) ?>

                                    </div>


                                    <?php if (!empty($service['duration'])): ?>

                                        <div class="service-duration">

                                            ⏱
                                            <?= e(
                                                $service['duration']
                                            ) ?>

                                        </div>

                                    <?php endif; ?>


                                </div>


                                <a href="booking-form.php?service=<?= (int)$service['id'] ?>"
                                   class="service-book-btn">

                                    Book this service

                                    <span>
                                        →
                                    </span>

                                </a>


                            </div>

                        </article>

                    </div>

                <?php endforeach; ?>


            <?php else: ?>


                <div class="col-12">

                    <div class="empty-soft-card">

                        <div class="soft-icon pink">
                            ✂
                        </div>

                        <h3>
                            Services coming soon
                        </h3>

                        <p>
                            Our salon service menu is currently
                            being updated.
                        </p>

                    </div>

                </div>


            <?php endif; ?>


        </div>

    </div>

</section>


<!-- PROCESS -->

<section class="process-section">

    <div class="container">

        <div class="section-heading text-center">

            <span>
                HOW IT WORKS
            </span>

            <h2>
                Easy as
                <span>1, 2, 3.</span>
            </h2>

        </div>


        <div class="row g-4 mt-4">


            <div class="col-md-4">

                <div class="process-card">

                    <div class="process-number">
                        01
                    </div>

                    <h3>
                        Choose
                    </h3>

                    <p>
                        Select the salon service
                        you want.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="process-card">

                    <div class="process-number">
                        02
                    </div>

                    <h3>
                        Book
                    </h3>

                    <p>
                        Select your preferred
                        date and time.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="process-card">

                    <div class="process-number">
                        03
                    </div>

                    <h3>
                        Glow
                    </h3>

                    <p>
                        Come in, relax and
                        enjoy your appointment.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- CTA -->

<section class="cartoon-cta">

    <div class="container">

        <div class="cta-inner">

            <div>

                <span>
                    HAVE A LOOK
                </span>

                <h2>
                    Ready for your
                    next salon day?
                </h2>

            </div>

            <a href="booking-form.php"
               class="cartoon-btn dark-btn">

                Book Now →

            </a>

        </div>

    </div>

</section>


<?php include ('../templates/footer.php'); ?>