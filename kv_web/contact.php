<?php
session_start();
require __DIR__ . '../../config/connection.php';
// function e($value)
// {
//     return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
// }

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $phone === '' || $message === '') {
        $error = 'Please fill all required fields.';
    } elseif (!preg_match('/^[0-9+\-\s]{7,20}$/', $phone)) {
        $error = 'Please enter a valid phone number.';
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {

        /*
         * If you have a contact_messages table,
         * this will save the enquiry.
         *
         * Expected columns:
         * id, name, phone, email, subject, message, created_at
         */

        try {

            $stmt = $conn->prepare("
                INSERT INTO contact_messages
                (name, phone, email, subject, message, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())
            ");

            $stmt->bind_param(
                "sssss",
                $name,
                $phone,
                $email,
                $subject,
                $message
            );

            $stmt->execute();

            $success = 'Thank you! Your message has been sent successfully.';

        } catch (Throwable $e) {

            /*
             * If contact_messages table does not exist,
             * do not expose database error to visitor.
             */
            $error = 'Unable to send your message right now. Please call us directly.';
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

    <title>Contact | KV SALON</title>

    <meta
        name="description"
        content="Contact KV SALON for appointments, hair styling, haircut and beauty services."
    >

   <?php include ('../templates/meta_tag.php'); ?>


    <style>

        /* =====================================================
           CONTACT PAGE
        ===================================================== */

        .contact-page {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 5% 10%,
                    rgba(255, 211, 222, .55),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 95% 35%,
                    rgba(207, 195, 255, .45),
                    transparent 25%
                ),
                #fffaf5;
        }


        /* =====================================================
           FLOATING DECORATIONS
        ===================================================== */

        .contact-decoration {
            position: absolute;
            pointer-events: none;
            z-index: 0;
            font-size: 45px;
            animation: contactFloat 5s ease-in-out infinite;
        }

        .contact-decoration.c1 {
            top: 170px;
            left: 4%;
        }

        .contact-decoration.c2 {
            top: 480px;
            right: 4%;
            animation-delay: 1s;
        }

        .contact-decoration.c3 {
            top: 900px;
            left: 3%;
            animation-delay: 2s;
        }

        .contact-decoration.c4 {
            top: 1300px;
            right: 5%;
            animation-delay: 1.5s;
        }

        @keyframes contactFloat {

            0%,100% {
                transform:
                    translateY(0)
                    rotate(-8deg);
            }

            50% {
                transform:
                    translateY(-18px)
                    rotate(8deg);
            }

        }


        /* =====================================================
           HERO
        ===================================================== */

        .contact-hero {
            position: relative;
            z-index: 1;
            padding: 125px 0 75px;
            text-align: center;
        }

        .contact-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;

            background: #ffe08a;
            border: 3px solid #211d26;
            border-radius: 50px;

            box-shadow: 5px 5px 0 #211d26;

            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .contact-title {
            margin-top: 27px;

            font-size: clamp(
                50px,
                8vw,
                90px
            );

            line-height: .9;
            letter-spacing: -5px;

            font-weight: 950;
            color: #211d26;
        }

        .contact-title span {
            color: #ff6690;
            display: inline-block;
            transform: rotate(-2deg);
        }

        .contact-subtitle {
            max-width: 680px;
            margin: 28px auto 0;

            color: #655d67;
            font-size: 18px;
            line-height: 1.7;
        }


        /* =====================================================
           CONTACT INFO
        ===================================================== */

        .contact-section {
            position: relative;
            z-index: 2;
            padding: 30px 0 100px;
        }

        .contact-info-card {
            height: 100%;
            padding: 30px;

            border: 4px solid #211d26;
            border-radius: 30px;

            background: #fff;

            box-shadow: 8px 8px 0 #211d26;

            transition: .3s ease;
        }

        .contact-info-card:hover {
            transform: translateY(-7px) rotate(-1deg);
            box-shadow: 12px 12px 0 #211d26;
        }

        .contact-info-title {
            font-size: 32px;
            font-weight: 950;
            letter-spacing: -1px;
        }

        .contact-info-title span {
            color: #ff6690;
        }

        .contact-info-text {
            color: #706872;
            line-height: 1.7;
            margin: 15px 0 30px;
        }


        /* =====================================================
           INFO ITEMS
        ===================================================== */

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;

            padding: 17px 0;

            border-bottom: 2px dashed #ddd4dc;
        }

        .contact-item:last-child {
            border-bottom: 0;
        }

        .contact-item-icon {
            flex: 0 0 50px;

            width: 50px;
            height: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 3px solid #211d26;
            border-radius: 16px;

            background: #ffd8e2;

            font-size: 23px;

            box-shadow: 3px 3px 0 #211d26;
        }

        .contact-item:nth-child(2) .contact-item-icon {
            background: #ffe08a;
        }

        .contact-item:nth-child(3) .contact-item-icon {
            background: #cbbaff;
        }

        .contact-item:nth-child(4) .contact-item-icon {
            background: #bdeeff;
        }

        .contact-item strong {
            display: block;
            color: #211d26;
            font-size: 15px;
            font-weight: 900;
        }

        .contact-item a,
        .contact-item p {
            display: block;
            margin: 4px 0 0;

            color: #706872;
            text-decoration: none;

            line-height: 1.5;
        }

        .contact-item a:hover {
            color: #ff6690;
        }


        /* =====================================================
           SOCIAL
        ===================================================== */

        .contact-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
        }

        .contact-social {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 3px solid #211d26;
            border-radius: 50%;

            background: #fff;
            color: #211d26;

            text-decoration: none;
            font-weight: 900;

            box-shadow: 3px 3px 0 #211d26;

            transition: .25s ease;
        }

        .contact-social:hover {
            transform:
                translateY(-5px)
                rotate(-7deg);

            background: #ffe08a;
            color: #211d26;
        }


        /* =====================================================
           CONTACT FORM
        ===================================================== */

        .contact-form-card {
            padding: 32px;

            border: 4px solid #211d26;
            border-radius: 30px;

            background: #fff;

            box-shadow: 8px 8px 0 #211d26;
        }

        .contact-form-title {
            font-size: 34px;
            font-weight: 950;
            letter-spacing: -1px;
        }

        .contact-form-title span {
            color: #7b61ff;
        }

        .contact-form-subtitle {
            color: #756d76;
            margin-bottom: 28px;
        }

        .contact-label {
            display: block;
            margin-bottom: 7px;

            color: #211d26;

            font-size: 13px;
            font-weight: 900;
        }

        .contact-input,
        .contact-textarea,
        .contact-select {
            width: 100%;

            padding: 14px 16px;

            border: 3px solid #211d26;
            border-radius: 15px;

            outline: none;

            background: #fffafc;
            color: #211d26;

            font-weight: 600;

            transition: .2s ease;
        }

        .contact-input:focus,
        .contact-textarea:focus,
        .contact-select:focus {
            background: #fff;
            border-color: #ff6690;

            box-shadow:
                4px 4px 0 #ffb6c8;
        }

        .contact-textarea {
            min-height: 145px;
            resize: vertical;
        }

        .contact-submit {
            width: 100%;

            border: 3px solid #211d26;
            border-radius: 16px;

            padding: 15px 20px;

            background: #ff6690;
            color: #fff;

            font-weight: 950;

            box-shadow: 6px 6px 0 #211d26;

            transition: .25s ease;
        }

        .contact-submit:hover {
            transform:
                translate(-3px,-3px);

            box-shadow:
                9px 9px 0 #211d26;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .contact-alert {
            border: 3px solid #211d26;
            border-radius: 15px;

            padding: 13px 16px;

            margin-bottom: 20px;

            font-weight: 800;
        }

        .contact-success {
            background: #c8f7d6;
        }

        .contact-error {
            background: #ffd0d9;
        }


        /* =====================================================
           MAP
        ===================================================== */

        .location-section {
            position: relative;
            z-index: 2;
            padding: 10px 0 100px;
        }

        .location-card {
            overflow: hidden;

            border: 4px solid #211d26;
            border-radius: 32px;

            background: #fff;

            box-shadow: 9px 9px 0 #211d26;
        }

        .location-content {
            padding: 38px;
        }

        .location-content h2 {
            font-size: 42px;
            font-weight: 950;
            letter-spacing: -2px;
        }

        .location-content h2 span {
            color: #ff6690;
        }

        .location-content p {
            color: #716a73;
            line-height: 1.7;
        }

        .location-map {
            min-height: 390px;

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;

            background:
                linear-gradient(
                    135deg,
                    #cbbaff,
                    #ffe08a
                );
        }

        .map-road {
            position: absolute;

            width: 130%;
            height: 80px;

            background: rgba(255,255,255,.75);

            transform: rotate(-18deg);
        }

        .map-road.two {
            transform: rotate(24deg);
            height: 60px;
        }

        .map-pin {
            position: relative;
            z-index: 2;

            width: 85px;
            height: 85px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 4px solid #211d26;
            border-radius: 50% 50% 50% 5px;

            background: #ff6690;

            color: #fff;

            font-size: 35px;

            box-shadow: 8px 8px 0 #211d26;

            transform: rotate(-45deg);
        }

        .map-pin span {
            transform: rotate(45deg);
        }


        /* =====================================================
           HOURS
        ===================================================== */

        .hours-section {
            padding: 20px 0 100px;
        }

        .hours-card {
            padding: 35px;

            border: 4px solid #211d26;
            border-radius: 30px;

            background: #ffe08a;

            box-shadow: 8px 8px 0 #211d26;
        }

        .hours-card h2 {
            font-size: 38px;
            font-weight: 950;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;

            padding: 14px 0;

            border-bottom: 2px dashed #211d26;

            font-weight: 800;
        }

        .hours-row:last-child {
            border-bottom: 0;
        }


        /* =====================================================
           FAQ
        ===================================================== */

        .faq-section {
            padding: 10px 0 100px;
        }

        .faq-title {
            text-align: center;

            font-size: clamp(
                40px,
                6vw,
                60px
            );

            font-weight: 950;
            letter-spacing: -3px;

            margin-bottom: 45px;
        }

        .faq-title span {
            color: #7b61ff;
        }

        .faq-item {
            overflow: hidden;

            margin-bottom: 15px;

            border: 3px solid #211d26;
            border-radius: 18px;

            background: #fff;

            box-shadow: 5px 5px 0 #211d26;
        }

        .faq-button {
            width: 100%;

            padding: 19px 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border: 0;

            background: transparent;

            color: #211d26;

            text-align: left;

            font-weight: 900;
            font-size: 17px;
        }

        .faq-button span:last-child {
            font-size: 25px;
            transition: .3s ease;
        }

        .faq-button:not(.collapsed) span:last-child {
            transform: rotate(45deg);
        }

        .faq-answer {
            padding: 0 22px 20px;

            color: #706872;
            line-height: 1.7;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .contact-cta {
            position: relative;
            overflow: hidden;

            margin: 20px 0 100px;
            padding: 65px 30px;

            border: 4px solid #211d26;
            border-radius: 35px;

            background: #cbbaff;

            text-align: center;

            box-shadow: 10px 10px 0 #211d26;
        }

        .contact-cta::before {
            content: "✂";

            position: absolute;
            left: 5%;
            top: 20%;

            font-size: 80px;
            opacity: .22;

            transform: rotate(-25deg);
        }

        .contact-cta::after {
            content: "♥";

            position: absolute;
            right: 6%;
            bottom: 15%;

            font-size: 80px;
            opacity: .22;

            transform: rotate(18deg);
        }

        .contact-cta h2 {
            position: relative;
            z-index: 2;

            font-size: clamp(
                38px,
                6vw,
                65px
            );

            font-weight: 950;
            letter-spacing: -3px;
        }

        .contact-cta p {
            position: relative;
            z-index: 2;

            max-width: 650px;

            margin: 15px auto 28px;

            color: #514b58;
            line-height: 1.7;
        }

        .contact-cta-btn {
            position: relative;
            z-index: 2;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 15px 25px;

            border: 3px solid #211d26;
            border-radius: 17px;

            background: #ff6690;
            color: #fff;

            text-decoration: none;

            font-weight: 950;

            box-shadow: 6px 6px 0 #211d26;

            transition: .25s ease;
        }

        .contact-cta-btn:hover {
            color: #fff;

            transform:
                translate(-3px,-3px);

            box-shadow:
                9px 9px 0 #211d26;
        }


        /* =====================================================
           FIXED BOOK
        ===================================================== */

        .contact-fixed-book {
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

            animation: contactBookFloat 2.2s ease-in-out infinite;
        }

        .contact-fixed-book:hover {
            color: #fff;
        }

        @keyframes contactBookFloat {

            0%,100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 767px) {

            .contact-hero {
                padding:
                    105px
                    15px
                    60px;
            }

            .contact-title {
                letter-spacing: -3px;
            }

            .contact-subtitle {
                font-size: 16px;
            }

            .contact-info-card,
            .contact-form-card {
                padding: 24px;
            }

            .location-content {
                padding: 27px;
            }

            .location-content h2 {
                font-size: 34px;
            }

            .location-map {
                min-height: 280px;
            }

            .hours-card {
                padding: 25px;
            }

            .hours-card h2 {
                font-size: 32px;
            }

            .contact-fixed-book {
                right: 14px;
                bottom: 15px;

                padding:
                    11px
                    16px;

                font-size: 13px;
            }

        }

    </style>

</head>


<body>

<div class="contact-page">


    <!-- =====================================================
         DECORATIONS
    ====================================================== -->

    <div class="contact-decoration c1">✂️</div>
    <div class="contact-decoration c2">✨</div>
    <div class="contact-decoration c3">🪮</div>
    <div class="contact-decoration c4">♥</div>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <?php include ('../templates/navbar.php'); ?>


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="contact-hero">

        <div class="container">

            <div class="contact-kicker">
                💌 KV SALON • LET'S TALK
            </div>


            <h1 class="contact-title">

                Let's
                <span>
                    Talk
                </span>

                <br>

                About Your Style

            </h1>


            <p class="contact-subtitle">

                Have a question, want to book an appointment,
                or simply want some hairstyle advice?
                Our team would love to hear from you.

            </p>

        </div>

    </section>


    <!-- =====================================================
         CONTACT MAIN
    ====================================================== -->

    <section class="contact-section">

        <div class="container">

            <div class="row g-4">


                <!-- CONTACT INFORMATION -->

                <div class="col-lg-5">

                    <div class="contact-info-card">

                        <h2 class="contact-info-title">
                            Come say
                            <span>hello!</span>
                        </h2>

                        <p class="contact-info-text">

                            Drop us a message or visit KV SALON.
                            We're always happy to help you find
                            the right style.

                        </p>


                        <!-- LOCATION -->

                        <div class="contact-item">

                            <div class="contact-item-icon">
                                📍
                            </div>

                            <div>

                                <strong>
                                    Visit Us
                                </strong>

                                <p>
                                    Bihar Sharif,
                                    Khadakpar, Bihar
                                </p>

                            </div>

                        </div>


                        <!-- PHONE -->

                        <div class="contact-item">

                            <div class="contact-item-icon">
                                📞
                            </div>

                            <div>

                                <strong>
                                    Call Us
                                </strong>

                                <a href="tel:+910000000000">
                                    +91 00000 00000
                                </a>

                            </div>

                        </div>


                        <!-- EMAIL -->

                        <div class="contact-item">

                            <div class="contact-item-icon">
                                ✉️
                            </div>

                            <div>

                                <strong>
                                    Email
                                </strong>

                                <a href="mailto:hello@kvsalon.com">
                                    hello@kvsalon.com
                                </a>

                            </div>

                        </div>


                        <!-- HOURS -->

                        <div class="contact-item">

                            <div class="contact-item-icon">
                                🕐
                            </div>

                            <div>

                                <strong>
                                    Opening Hours
                                </strong>

                                <p>
                                    Mon – Sun
                                    <br>
                                    9:00 AM – 8:00 PM
                                </p>

                            </div>

                        </div>


                        <!-- SOCIAL -->

                        <div class="contact-socials">

                            <a
                                href="#"
                                class="contact-social"
                                aria-label="Instagram"
                            >
                                ◎
                            </a>

                            <a
                                href="#"
                                class="contact-social"
                                aria-label="Facebook"
                            >
                                f
                            </a>

                            <a
                                href="#"
                                class="contact-social"
                                aria-label="YouTube"
                            >
                                ▶
                            </a>

                            <a
                                href="#"
                                class="contact-social"
                                aria-label="WhatsApp"
                            >
                                ☎
                            </a>

                        </div>

                    </div>

                </div>


                <!-- FORM -->

                <div class="col-lg-7">

                    <div class="contact-form-card">

                        <h2 class="contact-form-title">
                            Send us a
                            <span>message</span>
                        </h2>

                        <p class="contact-form-subtitle">
                            Fill in the details and we'll get
                            back to you soon.
                        </p>


                        <?php if ($success): ?>

                            <div class="contact-alert contact-success">
                                ✓ <?= e($success) ?>
                            </div>

                        <?php endif; ?>


                        <?php if ($error): ?>

                            <div class="contact-alert contact-error">
                                ⚠ <?= e($error) ?>
                            </div>

                        <?php endif; ?>


                        <form
                            method="POST"
                            action="contact.php"
                        >

                            <div class="row g-3">


                                <!-- NAME -->

                                <div class="col-md-6">

                                    <label class="contact-label">
                                        Your Name *
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="contact-input"
                                        placeholder="Enter your name"
                                        required
                                        maxlength="100"
                                        value="<?= e($_POST['name'] ?? '') ?>"
                                    >

                                </div>


                                <!-- PHONE -->

                                <div class="col-md-6">

                                    <label class="contact-label">
                                        Phone Number *
                                    </label>

                                    <input
                                        type="tel"
                                        name="phone"
                                        class="contact-input"
                                        placeholder="+91 XXXXX XXXXX"
                                        required
                                        maxlength="20"
                                        value="<?= e($_POST['phone'] ?? '') ?>"
                                    >

                                </div>


                                <!-- EMAIL -->

                                <div class="col-md-6">

                                    <label class="contact-label">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="contact-input"
                                        placeholder="you@example.com"
                                        value="<?= e($_POST['email'] ?? '') ?>"
                                    >

                                </div>


                                <!-- SUBJECT -->

                                <div class="col-md-6">

                                    <label class="contact-label">
                                        Subject
                                    </label>

                                    <select
                                        name="subject"
                                        class="contact-select"
                                    >

                                        <option value="">
                                            Choose a topic
                                        </option>

                                        <option value="Appointment">
                                            Appointment
                                        </option>

                                        <option value="Hair Service">
                                            Hair Service
                                        </option>

                                        <option value="Beauty Service">
                                            Beauty Service
                                        </option>

                                        <option value="Price">
                                            Price / Pricing
                                        </option>

                                        <option value="Other">
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <!-- MESSAGE -->

                                <div class="col-12">

                                    <label class="contact-label">
                                        Message *
                                    </label>

                                    <textarea
                                        name="message"
                                        class="contact-textarea"
                                        placeholder="Tell us how we can help..."
                                        required
                                        maxlength="2000"
                                    ><?= e($_POST['message'] ?? '') ?></textarea>

                                </div>


                                <!-- SUBMIT -->

                                <div class="col-12">

                                    <button
                                        type="submit"
                                        class="contact-submit"
                                    >
                                        Send Message ✨
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         LOCATION
    ====================================================== -->

    <section class="location-section">

        <div class="container">

            <div class="location-card">

                <div class="row g-0 align-items-stretch">

                    <div class="col-lg-5">

                        <div class="location-content">

                            <div class="contact-kicker">
                                📍 FIND KV SALON
                            </div>

                            <h2 class="mt-4">
                                Your new
                                <span>
                                    happy place.
                                </span>
                            </h2>

                            <p class="mt-3">

                                Visit us for a relaxing salon
                                experience, professional styling
                                and a little bit of KV magic.

                            </p>

                            <p class="mt-4">

                                <strong>
                                    Bihar Sharif, Khadakpar
                                </strong>
                                <br>
                                Bihar, India

                            </p>

                            <a
                                href="https://www.google.com/maps/search/?api=1&query=Bihar+Sharif+Khadakpar"
                                target="_blank"
                                class="gallery-main-btn mt-3"
                            >
                                Open Maps 📍
                            </a>

                        </div>

                    </div>


                    <div class="col-lg-7">

                        <div class="location-map">

                            <div class="map-road"></div>
                            <div class="map-road two"></div>

                            <div class="map-pin">

                                <span>
                                    ✂
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         HOURS
    ====================================================== -->

    <section class="hours-section">

        <div class="container">

            <div class="row g-4 align-items-center">

                <div class="col-lg-6">

                    <div class="hours-card">

                        <h2>
                            ⏰ Opening Hours
                        </h2>

                        <div class="hours-row">
                            <span>Monday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Tuesday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Wednesday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Thursday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Friday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Saturday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                        <div class="hours-row">
                            <span>Sunday</span>
                            <span>9:00 AM – 8:00 PM</span>
                        </div>

                    </div>

                </div>


                <div class="col-lg-6">

                    <div class="contact-info-card">

                        <div class="contact-kicker">
                            ✨ QUICK HELP
                        </div>

                        <h2 class="contact-info-title mt-4">

                            Need an
                            <span>appointment?</span>

                        </h2>

                        <p class="contact-info-text">

                            Skip the message and book your
                            preferred service directly.

                        </p>

                        <a
                            href="booking-form.php"
                            class="gallery-main-btn"
                        >
                            Book Appointment ✂
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FAQ
    ====================================================== -->

    <section class="faq-section">

        <div class="container">

            <h2 class="faq-title">
                Frequently Asked
                <span>Questions</span>
            </h2>


            <div
                class="accordion"
                id="contactFaq"
            >


                <!-- FAQ 1 -->

                <div class="faq-item">

                    <button
                        class="faq-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faqOne"
                    >

                        <span>
                            Do I need an appointment?
                        </span>

                        <span>
                            +
                        </span>

                    </button>

                    <div
                        id="faqOne"
                        class="collapse"
                        data-bs-parent="#contactFaq"
                    >

                        <div class="faq-answer">

                            Appointments are recommended,
                            especially during busy hours.
                            Walk-ins may also be accepted
                            depending on availability.

                        </div>

                    </div>

                </div>


                <!-- FAQ 2 -->

                <div class="faq-item">

                    <button
                        class="faq-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faqTwo"
                    >

                        <span>
                            Can I ask about service prices?
                        </span>

                        <span>
                            +
                        </span>

                    </button>

                    <div
                        id="faqTwo"
                        class="collapse"
                        data-bs-parent="#contactFaq"
                    >

                        <div class="faq-answer">

                            Yes. You can check our Services
                            page or contact our team for the
                            latest pricing.

                        </div>

                    </div>

                </div>


                <!-- FAQ 3 -->

                <div class="faq-item">

                    <button
                        class="faq-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faqThree"
                    >

                        <span>
                            Can I choose my preferred stylist?
                        </span>

                        <span>
                            +
                        </span>

                    </button>

                    <div
                        id="faqThree"
                        class="collapse"
                        data-bs-parent="#contactFaq"
                    >

                        <div class="faq-answer">

                            Yes, you can mention your preferred
                            stylist while booking or contact us
                            before your appointment.

                        </div>

                    </div>

                </div>


                <!-- FAQ 4 -->

                <div class="faq-item">

                    <button
                        class="faq-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faqFour"
                    >

                        <span>
                            How can I reschedule my appointment?
                        </span>

                        <span>
                            +
                        </span>

                    </button>

                    <div
                        id="faqFour"
                        class="collapse"
                        data-bs-parent="#contactFaq"
                    >

                        <div class="faq-answer">

                            Simply call or message KV SALON
                            and our team will help you with
                            the available slots.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="container">

        <div class="contact-cta">

            <h2>
                Your next look
                <br>
                is waiting. ✨
            </h2>

            <p>

                Ready for a fresh haircut, beautiful styling
                or a little self-care?

            </p>

            <a
                href="booking-form.php"
                class="contact-cta-btn"
            >
                Book Your Appointment ✂
            </a>

        </div>

    </section>


   
<?php include ('../templates/footer.php'); ?>

<script>

document.addEventListener("DOMContentLoaded", () => {


    /* =====================================================
       HERO ANIMATION
    ===================================================== */

    gsap.from(
        ".contact-kicker",
        {
            opacity: 0,
            y: 25,
            duration: .7,
            ease: "power3.out"
        }
    );


    gsap.from(
        ".contact-title",
        {
            opacity: 0,
            y: 45,
            scale: .96,
            duration: .9,
            delay: .1,
            ease: "back.out(1.4)"
        }
    );


    gsap.from(
        ".contact-subtitle",
        {
            opacity: 0,
            y: 25,
            duration: .7,
            delay: .3,
            ease: "power3.out"
        }
    );


    /* =====================================================
       CARDS
    ===================================================== */

    gsap.from(
        ".contact-info-card, .contact-form-card",
        {
            opacity: 0,
            y: 50,
            duration: .8,
            stagger: .15,
            ease: "power3.out"
        }
    );


    /* =====================================================
       FLOATING DECORATIONS
    ===================================================== */

    gsap.to(
        ".contact-decoration",
        {
            y: -15,
            rotation: 8,
            duration: 2.5,
            stagger: .4,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        }
    );


    /* =====================================================
       SUBMIT BUTTON
    ===================================================== */

    const form = document.querySelector(
        ".contact-form-card form"
    );

    const submitButton = document.querySelector(
        ".contact-submit"
    );

    if (form && submitButton) {

        form.addEventListener(
            "submit",
            () => {

                submitButton.innerHTML =
                    "Sending... ✨";

                submitButton.style.pointerEvents =
                    "none";

            }
        );

    }

});

</script>

</body>
</html>