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


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location:dashboard.php");
    exit;
}


$id = (int)($_POST['id'] ?? 0);

$allowed = [
    'Pending',
    'Confirmed',
    'Completed',
    'Cancelled'
];

$status = $_POST['status'] ?? '';


if (
    $id <= 0 ||
    !in_array($status, $allowed, true)
) {
    header("Location:dashboard.php");
    exit;
}


$stmt = $conn->prepare("
    UPDATE appointments
    SET status = ?
    WHERE id = ?
");

$stmt->bind_param(
    "si",
    $status,
    $id
);

$stmt->execute();

$stmt->close();


header("Location:dashboard.php");
exit;