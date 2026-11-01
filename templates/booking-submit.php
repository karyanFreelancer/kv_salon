<?php

session_start();

/*
|--------------------------------------------------------------------------
| DATABASE
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../config/connection.php';


/*
|--------------------------------------------------------------------------
| ONLY POST REQUEST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: ../kv_web/booking.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/

$name  = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$sid   = (int) ($_POST['service_id'] ?? 0);
$date  = trim($_POST['date'] ?? '');
$time  = trim($_POST['time'] ?? '');
$notes = trim($_POST['notes'] ?? '');


/*
|--------------------------------------------------------------------------
| VALIDATION
|--------------------------------------------------------------------------
*/

if (
    $name === '' ||
    $phone === '' ||
    $sid <= 0 ||
    $date === '' ||
    $time === ''
) {

    header(
        "Location: ../kv_web/booking.php?booking_error=required"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| PHONE VALIDATION
|--------------------------------------------------------------------------
*/

if (!preg_match('/^[0-9]{10}$/', $phone)) {

    header(
        "Location: ../kv_web/booking.php?booking_error=phone"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| DATE VALIDATION
|--------------------------------------------------------------------------
*/

$today = date('Y-m-d');

if ($date < $today) {

    header(
        "Location: ../kv_web/booking.php?booking_error=date"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| SERVICE
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT id, name
    FROM services
    WHERE id = ?
    AND active = 1
    LIMIT 1
");


if (!$stmt) {

    header(
        "Location: ../kv_web/booking.php?booking_error=server"
    );

    exit;
}


$stmt->bind_param(
    "i",
    $sid
);

$stmt->execute();


$service =
    $stmt
        ->get_result()
        ->fetch_assoc();


$stmt->close();


/*
|--------------------------------------------------------------------------
| SERVICE NOT FOUND
|--------------------------------------------------------------------------
*/

if (!$service) {

    header(
        "Location: ../kv_web/booking.php?booking_error=service"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| USER ID
|--------------------------------------------------------------------------
*/

$userId = null;


if (
    isset($_SESSION['user']) &&
    isset($_SESSION['user']['id'])
) {

    $userId =
        (int) $_SESSION['user']['id'];

}


/*
|--------------------------------------------------------------------------
| INSERT APPOINTMENT
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    INSERT INTO appointments
    (
        user_id,
        name,
        phone,
        service_id,
        service_name,
        appointment_date,
        appointment_time,
        notes,
        status
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        'Pending'
    )
");


if (!$stmt) {

    header(
        "Location: ../kv_web/booking.php?booking_error=server"
    );

    exit;
}


$stmt->bind_param(
    "ississss",
    $userId,
    $name,
    $phone,
    $sid,
    $service['name'],
    $date,
    $time,
    $notes
);


$success =
    $stmt->execute();


$stmt->close();


/*
|--------------------------------------------------------------------------
| SUCCESS
|--------------------------------------------------------------------------
*/

if ($success) {

    header(
        "Location: ../kv_web/booking.php?booking_success=1"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| ERROR
|--------------------------------------------------------------------------
*/

header(
    "Location: ../kv_web/booking.php?booking_error=1"
);

exit;