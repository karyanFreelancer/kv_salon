<?php

session_start();

require "../config/connection.php";


/* =========================================================
   LOGIN CHECK
========================================================= */

if (
    !isset($_SESSION['user']) ||
    $_SESSION['user']['role'] !== 'customer'
) {

    header("Location: ../auth/login.php");
    exit;

}


/* =========================================================
   CUSTOMER ID
========================================================= */

$uid = (int) $_SESSION['user']['id'];


/* =========================================================
   HELPER
========================================================= */

if (!function_exists('e')) {

    function e($value)
    {
        return htmlspecialchars(
            $value ?? '',
            ENT_QUOTES,
            'UTF-8'
        );
    }

}


/* =========================================================
   USER DATA
========================================================= */

$userQuery = $conn->query("
    SELECT *
    FROM users
    WHERE id = $uid
    LIMIT 1
");

$u = $userQuery
    ? $userQuery->fetch_assoc()
    : null;


if (!$u) {

    session_destroy();

    header("Location: ../auth/login.php");
    exit;

}


/* =========================================================
   APPOINTMENTS
========================================================= */

$a = $conn->query("
    SELECT *
    FROM appointments
    WHERE user_id = $uid
    ORDER BY appointment_date DESC, appointment_time DESC
");


/* =========================================================
   APPOINTMENT STATS
========================================================= */

$totalAppointments = 0;
$pendingAppointments = 0;
$confirmedAppointments = 0;
$completedAppointments = 0;

$appointments = [];


if ($a) {

    while ($row = $a->fetch_assoc()) {

        $appointments[] = $row;

        $totalAppointments++;

        $status = strtolower(
            trim($row['status'] ?? '')
        );


        if ($status === 'pending') {
            $pendingAppointments++;
        }

        if ($status === 'confirmed') {
            $confirmedAppointments++;
        }

        if ($status === 'completed') {
            $completedAppointments++;
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

    <title>
        My Account — KV SALON
    </title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


  <?php include('../templates/meta_tag.php'); ?>

</head>


<body class="kv-dashboard">


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <?php include "../templates/navbar.php"; ?>


    <!-- =====================================================
         DASHBOARD HERO
    ====================================================== -->

    <main class="dashboard-page">


        <section class="dashboard-hero">

            <div>

                <p class="dashboard-eyebrow">
                    CUSTOMER PORTAL
                </p>

                <h1>
                    Hello,
                    <span>
                        <?= e($u['name']) ?>
                    </span>
                </h1>

                <p class="dashboard-subtitle">
                    Welcome back to KV Salon.
                    Manage your profile and appointments
                    from one beautiful place.
                </p>

            </div>


            <a
                href="../kv_web/booking-form.php"
                class="dashboard-book-btn"
            >

                <span>
                    Book Appointment
                </span>

                <span>
                    →
                </span>

            </a>

        </section>


        <!-- =================================================
             STATS
        ================================================== -->

        <section class="dashboard-stats">


            <div class="stat-card">

                <div class="stat-icon">
                    ✦
                </div>

                <div>

                    <span>
                        Total Appointments
                    </span>

                    <strong>
                        <?= $totalAppointments ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ◷
                </div>

                <div>

                    <span>
                        Pending
                    </span>

                    <strong>
                        <?= $pendingAppointments ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ✓
                </div>

                <div>

                    <span>
                        Confirmed
                    </span>

                    <strong>
                        <?= $confirmedAppointments ?>
                    </strong>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ♡
                </div>

                <div>

                    <span>
                        Completed
                    </span>

                    <strong>
                        <?= $completedAppointments ?>
                    </strong>

                </div>

            </div>


        </section>


        <!-- =================================================
             DASHBOARD CONTENT
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 PROFILE
            ================================================== -->

            <aside class="profile-card">


                <div class="profile-top">

                    <div class="profile-avatar">

                        <?= strtoupper(
                            substr(
                                $u['name'] ?? 'U',
                                0,
                                1
                            )
                        ) ?>

                    </div>


                    <div>

                        <span class="profile-label">
                            MY PROFILE
                        </span>

                        <h2>
                            <?= e($u['name']) ?>
                        </h2>

                    </div>

                </div>


                <div class="profile-details">


                    <div class="profile-detail">

                        <span class="detail-icon">
                            @
                        </span>

                        <div>

                            <small>
                                Email
                            </small>

                            <p>
                                <?= e($u['email']) ?>
                            </p>

                        </div>

                    </div>


                    <div class="profile-detail">

                        <span class="detail-icon">
                            ☎
                        </span>

                        <div>

                            <small>
                                Phone
                            </small>

                            <p>
                                <?= e($u['phone'] ?: 'Not added') ?>
                            </p>

                        </div>

                    </div>


                </div>


                <a
                    href="profile.php"
                    class="profile-edit-btn"
                >

                    Edit Profile

                    <span>
                        →
                    </span>

                </a>


                <a
                    href="../auth/logout.php"
                    class="profile-logout"
                >

                    Logout

                </a>


            </aside>


            <!-- =================================================
                 APPOINTMENTS
            ================================================== -->

            <section class="appointments-panel">


                <div class="panel-heading">

                    <div>

                        <span>
                            YOUR VISITS
                        </span>

                        <h2>
                            My Appointments
                        </h2>

                    </div>


                    <a
                        href="../kv_web/booking-form.php"
                        class="small-book-btn"
                    >

                        + New Booking

                    </a>

                </div>


                <?php if (!empty($appointments)): ?>


                    <div class="appointment-list">


                        <?php foreach (
                            $appointments as $appointment
                        ): ?>


                            <?php

                            $status = strtolower(
                                trim(
                                    $appointment['status'] ?? 'pending'
                                )
                            );

                            ?>


                            <article class="appointment-card">


                                <div class="appointment-date">


                                    <span>
                                        <?= date(
                                            'M',
                                            strtotime(
                                                $appointment['appointment_date']
                                            )
                                        ) ?>
                                    </span>


                                    <strong>
                                        <?= date(
                                            'd',
                                            strtotime(
                                                $appointment['appointment_date']
                                            )
                                        ) ?>
                                    </strong>


                                    <small>
                                        <?= date(
                                            'Y',
                                            strtotime(
                                                $appointment['appointment_date']
                                            )
                                        ) ?>
                                    </small>


                                </div>


                                <div class="appointment-info">


                                    <span class="appointment-label">
                                        SERVICE
                                    </span>


                                    <h3>
                                        <?= e(
                                            $appointment['service_name'] ?? 'Salon Service'
                                        ) ?>
                                    </h3>


                                    <div class="appointment-meta">

                                        <span>
                                            ◷
                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $appointment['appointment_time']
                                                )
                                            ) ?>
                                        </span>

                                        <span>
                                            •
                                        </span>

                                        <span>
                                            KV SALON
                                        </span>

                                    </div>

                                </div>


                                <div class="appointment-status">

                                    <span
                                        class="
                                            status-badge
                                            status-<?= e($status) ?>
                                        "
                                    >

                                        <i></i>

                                        <?= ucfirst(e($status)) ?>

                                    </span>

                                </div>


                            </article>


                        <?php endforeach; ?>


                    </div>


                <?php else: ?>


                    <!-- =================================================
                         EMPTY STATE
                    ================================================== -->

                    <div class="empty-appointments">


                        <div class="empty-icon">
                            ✂
                        </div>


                        <h3>
                            No appointments yet
                        </h3>


                        <p>
                            Your next beautiful salon
                            experience is just one booking away.
                        </p>


                        <a
                            href="../kv_web/booking-form.php"
                            class="dashboard-book-btn"
                        >

                            Book Your First Appointment

                            <span>
                                →
                            </span>

                        </a>


                    </div>


                <?php endif; ?>


            </section>


        </section>


    </main>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <?php include "../templates/footer.php"; ?>


</body>

</html>