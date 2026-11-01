<?php
session_start();

require "../config/connection.php";

if (
    !isset($_SESSION['user']) ||
    $_SESSION['user']['role'] !== 'admin'
) {
    header("Location:../auth/login.php");
    exit;
}

function countRows($c, $where = '1')
{
    $result = $c->query(
        "SELECT COUNT(*) c FROM appointments WHERE $where"
    );

    return $result->fetch_assoc()['c'];
}

$total     = countRows($conn);
$pending   = countRows($conn, "status='Pending'");
$confirmed = countRows($conn, "status='Confirmed'");
$completed = countRows($conn, "status='Completed'");

$customers = $conn->query(
    "SELECT COUNT(*) c
     FROM users
     WHERE role='customer'"
)->fetch_assoc()['c'];

$apps = $conn->query(
    "SELECT
        a.*,
        u.email
     FROM appointments a
     LEFT JOIN users u
        ON u.id = a.user_id
     ORDER BY a.created_at DESC"
);
?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width,initial-scale=1"
    >

    <title>Velora — Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

</head>

<body class="admin">

<div class="topbar">

    <div class="topbar-left">
        <div class="mobile-menu">
            ☰
        </div>

        <div>
            <span class="topbar-small">GOOD DAY</span>
            <strong>Welcome back, Admin</strong>
        </div>
    </div>

    <div class="topbar-right">

        <div class="notification">
            ♡
            <span><?= $pending ?></span>
        </div>

        <div class="admin-profile">
            <div class="admin-avatar">
                A
            </div>

            <div class="admin-profile-text">
                <strong>Administrator</strong>
                <small>Salon Manager</small>
            </div>
        </div>

    </div>

</div>

<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside>

    <div class="brand">
        VELORA.
    </div>

    <a
        class="active"
        href="dashboard.php"
    >
        Dashboard
    </a>

    <a href="services.php">
        Services
    </a>

    <a href="customers.php">
        Customers
    </a>

    <a href="messages.php">
        Messages
    </a>

    <a href="../kv_web/index.php">
        Website
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</aside>


<!-- =====================================================
     MAIN
===================================================== -->

<main>

    <div class="dashboard-intro">

        <div>

            <p class="eyebrow">
                CONTROL CENTER
            </p>

            <h1>
                Dashboard
            </h1>

        </div>

        <div class="intro-right">

            Welcome back.
            Manage appointments, customers,
            services and messages from one
            beautiful workspace.

        </div>

    </div>


    <!-- =================================================
         STATS
    ================================================== -->

    <section class="stats-grid">

        <div class="stat-card">

            <div class="stat-label">
                Total Appointments
            </div>

            <div class="stat-number">
                <?= $total ?>
            </div>

            <div class="stat-decoration"></div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Pending
            </div>

            <div class="stat-number">
                <?= $pending ?>
            </div>

            <div class="stat-decoration"></div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Confirmed
            </div>

            <div class="stat-number">
                <?= $confirmed ?>
            </div>

            <div class="stat-decoration"></div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Customers
            </div>

            <div class="stat-number">
                <?= $customers ?>
            </div>

            <div class="stat-decoration"></div>

        </div>

    </section>


    <!-- =================================================
         APPOINTMENTS
    ================================================== -->

    <section class="panel appointment-panel">

        <div class="panel-head">

            <div>

                <h3>
                    Latest Appointments
                </h3>

                <div class="panel-subtitle">
                    Live data from your booking system
                </div>

            </div>

            <div class="panel-subtitle">
                <?= $completed ?> completed
            </div>

        </div>


        <div class="appointment-table-wrap">

            <table class="appointment-table">

                <thead>

                    <tr>

                        <th>
                            Customer
                        </th>

                        <th>
                            Service
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Time
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Update
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if ($apps && $apps->num_rows): ?>

                    <?php while ($x = $apps->fetch_assoc()): ?>

                        <?php

                        $statusClass = match ($x['status']) {
                            'Pending'   => 'status-pending',
                            'Confirmed' => 'status-confirmed',
                            'Completed' => 'status-completed',
                            'Cancelled' => 'status-cancelled',
                            default     => 'status-pending'
                        };

                        ?>

                        <tr>

                            <td>

                                <div class="customer-name">
                                    <?= e($x['name']) ?>
                                </div>

                                <div class="customer-contact">

                                    <?= e($x['email']) ?>

                                    <br>

                                    <?= e($x['phone']) ?>

                                </div>

                            </td>


                            <td>

                                <div class="service-name">
                                    <?= e($x['service_name']) ?>
                                </div>

                            </td>


                            <td>

                                <div class="date-text">
                                    <?= e($x['appointment_date']) ?>
                                </div>

                            </td>


                            <td>

                                <div class="time-text">
                                    <?= substr($x['appointment_time'], 0, 5) ?>
                                </div>

                            </td>


                            <td>

                                <span
                                    class="status-badge <?= $statusClass ?>"
                                >

                                    <?= e($x['status']) ?>

                                </span>

                            </td>


                            <td>

                                <form
                                    action="status.php"
                                    method="post"
                                    class="status-form"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $x['id'] ?>"
                                    >

                                    <select
                                        name="status"
                                    >

                                        <?php

                                        foreach (
                                            [
                                                'Pending',
                                                'Confirmed',
                                                'Completed',
                                                'Cancelled'
                                            ] as $st
                                        ):

                                        ?>

                                            <option
                                                <?= $x['status'] === $st
                                                    ? 'selected'
                                                    : '' ?>
                                            >

                                                <?= $st ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                    <button type="submit">
                                        Save
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    ✦
                                </div>

                                No appointments yet.

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </section>


    <!-- =================================================
         LOWER CARDS
    ================================================== -->

    <section class="dashboard-lower">

        <div class="info-card pink">

            <h3>
                ✦ Keep it personal
            </h3>

            <p>
                Every appointment is an opportunity
                to make your customer feel special.
                Keep your salon experience simple,
                friendly and memorable.
            </p>

        </div>


        <div class="info-card yellow">

            <h3>
                ✂ Your workspace
            </h3>

            <p>
                Manage your services, customers,
                messages and bookings from the
                administration panel.
            </p>

        </div>

    </section>

    <div class="dashboard-signature">

    <span>made with</span>

    <strong>♡</strong>

    <em>for beautiful experiences.</em>

</div>

</main>

</body>

</html>