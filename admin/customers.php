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

$us = $conn->query("
    SELECT
        u.*,
        COUNT(a.id) bookings
    FROM users u
    LEFT JOIN appointments a
        ON a.user_id = u.id
    WHERE u.role='customer'
    GROUP BY u.id
    ORDER BY u.created_at DESC
");

?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta
    name="viewport"
    content="width=device-width,initial-scale=1"
>

<title>Customers — Velora</title>

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
<aside>

    <div class="brand">
        VELORA.
    </div>

    <a href="dashboard.php">
        Dashboard
    </a>

    <a href="services.php">
        Services
    </a>

    <a class="active" href="customers.php">
        Customers
    </a>

    <a href="messages.php">
        Messages
    </a>

    <a href="../index.php">
        Website
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</aside>


<main>

    <p class="eyebrow">
        CUSTOMER SPACE
    </p>

    <h1>
        Customers
    </h1>


    <div class="customer-grid">

        <?php if ($us && $us->num_rows): ?>

            <?php while ($u = $us->fetch_assoc()): ?>

                <?php

                $initial =
                    strtoupper(
                        substr(
                            $u['name'] ?: 'C',
                            0,
                            1
                        )
                    );

                ?>

                <div class="customer-card">

                    <div class="customer-avatar">
                        <?= e($initial) ?>
                    </div>

                    <h3>
                        <?= e($u['name']) ?>
                    </h3>

                    <p>
                        <?= e($u['email']) ?>
                    </p>

                    <p>
                        <?= e($u['phone']) ?>
                    </p>

                    <span class="booking-count">
                        <?= $u['bookings'] ?>
                        <?= $u['bookings'] == 1
                            ? 'Booking'
                            : 'Bookings' ?>
                    </span>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="panel">
                No customers found.
            </div>

        <?php endif; ?>

    </div>

</main>

</body>

</html>