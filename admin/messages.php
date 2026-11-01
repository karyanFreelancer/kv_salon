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

$ms = $conn->query("
    SELECT *
    FROM contact_messages
    ORDER BY created_at DESC
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

<title>Messages — Velora</title>

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

    <a href="customers.php">
        Customers
    </a>

    <a class="active" href="messages.php">
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
        INBOX
    </p>

    <h1>
        Messages
    </h1>


    <div class="message-list">

        <?php if ($ms && $ms->num_rows): ?>

            <?php while ($m = $ms->fetch_assoc()): ?>

                <?php

                $initial =
                    strtoupper(
                        substr(
                            $m['name'] ?: 'M',
                            0,
                            1
                        )
                    );

                ?>

                <div class="message-card">

                    <div class="message-avatar">
                        <?= e($initial) ?>
                    </div>


                    <div>

                        <div class="message-name">
                            <?= e($m['name']) ?>
                        </div>

                        <div class="message-contact">

                            <?= e($m['email']) ?>

                            <?php if (!empty($m['phone'])): ?>

                                · <?= e($m['phone']) ?>

                            <?php endif; ?>

                        </div>

                        <div class="message-text">
                            <?= e($m['message']) ?>
                        </div>

                    </div>


                    <div class="message-status">
                        <?= e($m['status']) ?>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="panel">

                <div class="empty-state">

                    <div class="empty-icon">
                        ✉
                    </div>

                    No messages yet.

                </div>

            </div>

        <?php endif; ?>

    </div>

</main>

</body>

</html>