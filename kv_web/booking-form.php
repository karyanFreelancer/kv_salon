<?php
/* =========================================================
   SESSION
========================================================= */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =========================================================
   LOGIN CHECK
========================================================= */

if (
    !isset($_SESSION['user']) ||
    !isset($_SESSION['user']['id'])
) {
    header("Location: ../auth/login.php?redirect=booking");
    exit;
}


/* =========================================================
   DATABASE
========================================================= */

if (!isset($conn)) {
    require_once __DIR__ . '../../config/connection.php';
}

/*
|--------------------------------------------------------------------------
| LOAD SERVICES
|--------------------------------------------------------------------------
*/

$bookingServices = $conn->query("
    SELECT id, name
    FROM services
    WHERE active = 1
    ORDER BY name ASC
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Book Appointment — KV Salon
    </title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

   <?php include ('../templates/meta_tag.php'); ?>


</head>


<body>


<!-- =====================================================
     BACKGROUND DECORATIONS
===================================================== -->

<div class="bg-dot bg-dot-one"></div>

<div class="bg-dot bg-dot-two"></div>

<div class="bg-circle bg-circle-one"></div>

<div class="bg-circle bg-circle-two"></div>



<?php include ('../templates/navbar.php'); ?>


<!-- =====================================================
     MAIN
===================================================== -->

<main class="booking-page">


    <!-- =================================================
         LEFT SIDE
    ================================================= -->

    <section class="booking-intro">


        <div class="intro-top">


            <span class="eyebrow">
                ✦ KV SALON
            </span>


            <h1>

                Let's make
                <br>

                your next
                <br>

                <em>look special.</em>

            </h1>


            <p>

                A little time for you.
                A little magic for your style.

                Choose your service, pick a time,
                and let us take care of the rest.

            </p>


        </div>



        <!-- SALON CARD -->

        <div class="salon-card">


            <div class="salon-card-top">

                <span>
                    EST. 2026
                </span>

                <span>
                    ✦
                </span>

            </div>


            <div class="salon-card-center">

                <div class="scissors">
                    ✂
                </div>


                <h2>
                    KV
                    <br>
                    SALON
                </h2>


                <p>
                    BEAUTY MADE PERSONAL
                </p>

            </div>


            <div class="salon-card-bottom">

                <span>
                    HAIR
                </span>

                <span>
                    BEAUTY
                </span>

                <span>
                    GLOW
                </span>

            </div>


        </div>



        <!-- INFO -->

        <div class="intro-info">


            <div class="info-item">

                <span class="info-icon">
                    ♡
                </span>

                <div>

                    <strong>
                        Personalised Experience
                    </strong>

                    <p>
                        Every appointment is designed
                        around you.
                    </p>

                </div>

            </div>



            <div class="info-item">

                <span class="info-icon">
                    ✦
                </span>

                <div>

                    <strong>
                        Professional Care
                    </strong>

                    <p>
                        Relax while our experts
                        handle the details.
                    </p>

                </div>

            </div>


        </div>


    </section>



    <!-- =================================================
         RIGHT SIDE
    ================================================= -->

    <section class="booking-form-area">


        <div class="form-card">


            <!-- FORM HEADER -->

            <div class="form-header">


                <div>

                    <span>
                        ✦ BOOK YOUR VISIT
                    </span>


                    <h2>
                        Book an appointment
                    </h2>


                    <p>
                        Fill in your details and
                        choose your preferred time.
                    </p>

                </div>


                <div class="form-number">
                    01
                </div>


            </div>



            <!-- FORM -->

            <form
                action="../templates/booking-submit.php"
                method="POST"
                id="bookingForm"
                class="booking-form"
            >


                <!-- NAME -->

                <div class="field">


                    <label for="booking-name">

                        Your Name

                        <span>
                            *
                        </span>

                    </label>


                    <div class="input-wrap">

                        <span class="input-icon">
                            ♡
                        </span>


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



                <!-- PHONE -->

                <div class="field">


                    <label for="booking-phone">

                        Phone Number

                        <span>
                            *
                        </span>

                    </label>


                    <div class="input-wrap">

                        <span class="input-icon">
                            ☎
                        </span>


                        <input
                            type="tel"
                            id="booking-phone"
                            name="phone"
                            value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>"
                            placeholder="10 digit phone number"
                            maxlength="10"
                            required
                        >

                    </div>


                </div>



                <!-- SERVICE -->

                <div class="field">


                    <label for="service_id">

                        Choose Service

                        <span>
                            *
                        </span>

                    </label>


                    <div class="input-wrap select-wrap">

                        <span class="input-icon">
                            ✂
                        </span>


                        <select
                            name="service_id"
                            id="service_id"
                            required
                        >

                            <option value="">
                                Select a service
                            </option>


                            <?php if ($bookingServices): ?>


                                <?php while (
                                    $service =
                                    $bookingServices->fetch_assoc()
                                ): ?>


                                    <option
                                        value="<?= (int)$service['id'] ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $service['name']
                                        ) ?>

                                    </option>


                                <?php endwhile; ?>


                            <?php endif; ?>


                        </select>


                    </div>


                </div>



                <!-- DATE + TIME -->

                <div class="form-row">


                    <!-- DATE -->

                    <div class="field">


                        <label for="booking-date">

                            Date

                            <span>
                                *
                            </span>

                        </label>


                        <div class="input-wrap">

                            <span class="input-icon">
                                ▣
                            </span>


                            <input
                                type="date"
                                id="booking-date"
                                name="date"
                                required
                            >

                        </div>


                    </div>



                    <!-- TIME -->

                    <div class="field">


                        <label for="booking-time">

                            Time

                            <span>
                                *
                            </span>

                        </label>


                        <div class="input-wrap">

                            <span class="input-icon">
                                ◷
                            </span>


                            <input
                                type="time"
                                id="booking-time"
                                name="time"
                                required
                            >

                        </div>


                    </div>


                </div>



                <!-- QUICK TIME -->

                <div class="quick-times">


                    <span class="quick-label">
                        Popular times
                    </span>


                    <div class="time-buttons">


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



                <!-- NOTES -->

                <div class="field">


                    <label for="booking-notes">

                        Special Request

                        <small>
                            Optional
                        </small>

                    </label>


                    <textarea
                        id="booking-notes"
                        name="notes"
                        rows="4"
                        placeholder="Tell us anything we should know..."
                    ></textarea>


                </div>



                <!-- SUMMARY -->

                <div class="booking-summary">


                    <div class="summary-heading">

                        <span>
                            YOUR APPOINTMENT
                        </span>

                        <span>
                            ✦
                        </span>

                    </div>


                    <div class="summary-row">

                        <span>
                            Service
                        </span>

                        <strong id="summaryService">
                            Not selected
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Date
                        </span>

                        <strong id="summaryDate">
                            Not selected
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Time
                        </span>

                        <strong id="summaryTime">
                            Not selected
                        </strong>

                    </div>


                </div>



                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="submit-btn"
                >


                    <span>
                        Book Appointment
                    </span>


                    <strong>
                        →
                    </strong>


                </button>



                <p class="form-note">

                    🔒 Your information is safe with us.
                    We will contact you to confirm your appointment.

                </p>


            </form>


        </div>


    </section>


</main>


<?php include ('../templates/footer.php'); ?>