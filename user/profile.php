<?php

session_start();

require "../config/connection.php";


/* =========================================================
   LOGIN CHECK
========================================================= */

if (!isset($_SESSION['user'])) {

    header("Location: ../auth/login.php");
    exit;

}


/* =========================================================
   USER ID
========================================================= */

$id = (int) $_SESSION['user']['id'];

$msg = "";
$err = "";


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
   UPDATE PROFILE
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');


    if ($name === '') {

        $err = "Please enter your name.";

    } else {

        $name  = $conn->real_escape_string($name);
        $phone = $conn->real_escape_string($phone);


        $update = $conn->query("
            UPDATE users
            SET
                name = '$name',
                phone = '$phone'
            WHERE id = $id
        ");


        if ($update) {

            /* Refresh session */

            $userQuery = $conn->query("
                SELECT *
                FROM users
                WHERE id = $id
                LIMIT 1
            ");

            if ($userQuery) {

                $_SESSION['user'] =
                    $userQuery->fetch_assoc();

            }


            $msg = "Your profile has been updated successfully.";

        } else {

            $err = "Unable to update your profile. Please try again.";

        }

    }

}


/* =========================================================
   GET USER
========================================================= */

$userQuery = $conn->query("
    SELECT *
    FROM users
    WHERE id = $id
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
        My Profile — KV SALON
    </title>


    <!-- FONT -->

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
 
    <?php include ('../templates/meta_tag.php'); ?>

</head>


<body class="kv-profile-page">


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <?php include "../templates/navbar.php"; ?>


    <!-- =====================================================
         PROFILE
    ====================================================== -->

    <main class="profile-page">


        <!-- BACK -->

        <a
            href="dashboard.php"
            class="profile-back"
        >

            <span>←</span>

            Back to Dashboard

        </a>


        <section class="profile-layout">


            <!-- =================================================
                 LEFT PROFILE CARD
            ================================================== -->

            <aside class="profile-intro">


                <div class="profile-big-avatar">

                    <?= strtoupper(
                        substr(
                            $u['name'] ?? 'U',
                            0,
                            1
                        )
                    ) ?>

                </div>


                <span class="profile-intro-label">
                    KV SALON MEMBER
                </span>


                <h1>
                    <?= e($u['name']) ?>
                </h1>


                <p>
                    Keep your personal details
                    updated for a smoother
                    salon experience.
                </p>


                <div class="profile-member">

                    <span>
                        MEMBER ID
                    </span>

                    <strong>
                        #<?= str_pad(
                            $u['id'],
                            4,
                            '0',
                            STR_PAD_LEFT
                        ) ?>
                    </strong>

                </div>


            </aside>


            <!-- =================================================
                 RIGHT FORM
            ================================================== -->

            <section class="profile-form-card">


                <div class="profile-form-heading">

                    <div>

                        <span>
                            PERSONAL DETAILS
                        </span>

                        <h2>
                            Your profile
                        </h2>

                    </div>


                    <div class="profile-heading-icon">
                        ✦
                    </div>

                </div>


                <!-- SUCCESS -->

                <?php if ($msg): ?>

                    <div class="profile-message success">

                        <span>✓</span>

                        <?= e($msg) ?>

                    </div>

                <?php endif; ?>


                <!-- ERROR -->

                <?php if ($err): ?>

                    <div class="profile-message error">

                        <span>!</span>

                        <?= e($err) ?>

                    </div>

                <?php endif; ?>


                <form
                    method="post"
                    class="profile-form"
                    id="profileForm"
                >


                    <!-- NAME -->

                    <div class="profile-field">

                        <label for="name">
                            Full Name
                        </label>

                        <div class="profile-input-wrap">

                            <span>
                                ◯
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<?= e($u['name']) ?>"
                                placeholder="Enter your name"
                                required
                            >

                        </div>

                    </div>


                    <!-- EMAIL -->

                    <div class="profile-field">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="profile-input-wrap disabled">

                            <span>
                                @
                            </span>

                            <input
                                type="email"
                                id="email"
                                value="<?= e($u['email']) ?>"
                                disabled
                            >

                            <small>
                                Verified
                            </small>

                        </div>

                        <p class="field-note">
                            Email address cannot be changed.
                        </p>

                    </div>


                    <!-- PHONE -->

                    <div class="profile-field">

                        <label for="phone">
                            Phone Number
                        </label>

                        <div class="profile-input-wrap">

                            <span>
                                ☎
                            </span>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                value="<?= e($u['phone']) ?>"
                                placeholder="Enter your phone number"
                                maxlength="10"
                                inputmode="numeric"
                            >

                        </div>

                    </div>


                    <!-- BUTTONS -->

                    <div class="profile-actions">


                        <a
                            href="dashboard.php"
                            class="profile-cancel"
                        >

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="profile-save"
                        >

                            <span>
                                Save Changes
                            </span>

                            <span>
                                →
                            </span>

                        </button>


                    </div>

                    <a href="dashboard.php" class="profile-back">
                      <span>←</span>
                       Back to Dashboard
                    </a>


                </form>


            </section>


        </section>


    </main>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <?php include "../templates/footer.php"; ?>


    <!-- =====================================================
         JS
    ====================================================== -->

    <script>

        const profileForm =
            document.getElementById("profileForm");

        if (profileForm) {

            profileForm.addEventListener(
                "submit",
                function () {

                    const button =
                        profileForm.querySelector(
                            ".profile-save"
                        );

                    if (button) {

                        button.classList.add("loading");

                        button.querySelector("span:first-child")
                            .textContent = "Saving...";

                    }

                }
            );

        }


        /* PHONE ONLY NUMBERS */

        const phone =
            document.getElementById("phone");

        if (phone) {

            phone.addEventListener(
                "input",
                function () {

                    this.value =
                        this.value
                            .replace(/\D/g, "")
                            .slice(0, 10);

                }
            );

        }

    </script>


</body>

</html>