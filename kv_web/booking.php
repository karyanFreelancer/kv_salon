<?php

session_start();

require __DIR__ . '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php#booking");
    exit;
}

$name  = $conn->real_escape_string($_POST['name'] ?? '');
$phone = $conn->real_escape_string($_POST['phone'] ?? '');
$sid   = (int)($_POST['service_id'] ?? 0);
$date  = $conn->real_escape_string($_POST['date'] ?? '');
$time  = $conn->real_escape_string($_POST['time'] ?? '');
$notes = $conn->real_escape_string($_POST['notes'] ?? '');

$s = $conn->query("
    SELECT *
    FROM services
    WHERE id = $sid
    AND active = 1
")->fetch_assoc();

if (!$s) {
    die("Invalid service.");
}

$uid = isset($_SESSION['user'])
    ? (int)$_SESSION['user']['id']
    : 'NULL';

$serviceName = $conn->real_escape_string($s['name']);

$conn->query("
    INSERT INTO appointments
    (
        user_id,
        name,
        phone,
        service_id,
        service_name,
        appointment_date,
        appointment_time,
        notes
    )
    VALUES
    (
        $uid,
        '$name',
        '$phone',
        $sid,
        '$serviceName',
        '$date',
        '$time',
        '$notes'
    )
");

header("Location: index.php?success=1#booking");
exit;