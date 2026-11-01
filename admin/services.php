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


/* =====================================================
   ADD SERVICE
===================================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');

    $category = trim(
        $_POST['category'] ?? ''
    );

    $price = (float)(
        $_POST['price'] ?? 0
    );

    $duration = (int)(
        $_POST['duration'] ?? 60
    );

    $description = trim(
        $_POST['description'] ?? ''
    );


    $stmt = $conn->prepare("
        INSERT INTO services
        (
            name,
            category,
            price,
            duration,
            description
        )
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssdis",
        $name,
        $category,
        $price,
        $duration,
        $description
    );

    $stmt->execute();

    $stmt->close();

    header("Location:services.php");
    exit;
}


$ss = $conn->query("
    SELECT *
    FROM services
    ORDER BY id DESC
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

<title>Services — Velora</title>

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

    <a class="active" href="services.php">
        Services
    </a>

    <a href="customers.php">
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
        MANAGEMENT
    </p>

    <h1>
        Services
    </h1>


    <div class="services-layout">


        <!-- =============================================
             ADD SERVICE
        ============================================== -->

        <div class="panel add-service">

            <h3>
                Add new service
            </h3>


            <form
                method="post"
                autocomplete="off"
            >

                <div class="form-group">

                    <label>
                        Service name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="e.g. Hair Styling"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        placeholder="Hair / Skin / Nails"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        placeholder="999"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Duration
                    </label>

                    <input
                        type="number"
                        name="duration"
                        value="60"
                        min="1"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        placeholder="Describe this service..."
                    ></textarea>

                </div>


                <button
                    class="primary-button"
                    type="submit"
                >
                    + Add Service
                </button>

            </form>

        </div>


        <!-- =============================================
             SERVICES
        ============================================== -->

        <div>

            <div class="panel">

                <div class="panel-head">

                    <div>

                        <h3>
                            All services
                        </h3>

                        <div class="panel-subtitle">
                            Manage your salon offerings
                        </div>

                    </div>

                </div>


                <div class="service-grid">

                    <?php if ($ss && $ss->num_rows): ?>

                        <?php while ($s = $ss->fetch_assoc()): ?>

                            <div class="service-card">

                                <span class="service-category">
                                    <?= e(
                                        $s['category']
                                        ?: 'Beauty'
                                    ) ?>
                                </span>


                                <h3>
                                    <?= e($s['name']) ?>
                                </h3>


                                <p>
                                    <?= e(
                                        $s['description']
                                        ?: 'Professional salon service.'
                                    ) ?>
                                </p>


                                <div class="service-bottom">

                                    <div class="service-price">
                                        ₹<?= number_format(
                                            $s['price']
                                        ) ?>
                                    </div>

                                    <div class="service-duration">
                                        <?= $s['duration'] ?> min
                                    </div>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <div class="empty-state">

                            <div class="empty-icon">
                                ✦
                            </div>

                            No services added yet.

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</main>

</body>

</html>