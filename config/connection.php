<?php
$host="localhost"; $user="root"; $pass=""; $db="velora_salon";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die("Database connection failed: ".$conn->connect_error);
$conn->set_charset("utf8mb4");
function e($v){return htmlspecialchars($v??'',ENT_QUOTES,'UTF-8');}
?>