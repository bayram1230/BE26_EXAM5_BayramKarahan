<?php
session_start();
require_once __DIR__ . "/db_connect.php";

// 1) Check: is someone logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../register-login/login.php?error=login_required");
    exit;
}

// 2) Check: does pet_id exist
if (!isset($_GET['pet_id'])) {
    die("No pet selected.");
}

$pet_id = intval($_GET['pet_id']);
$user_id = $_SESSION['user'];

// 3) Insert adoption
$sql = "INSERT INTO pet_adoption (user_id, pet_id) VALUES ($user_id, $pet_id)";
mysqli_query($conn, $sql);

// 4) Update pet status
$sql2 = "UPDATE pets SET status='Adopted' WHERE id=$pet_id";
mysqli_query($conn, $sql2);

// 5) Redirect success
header("Location: ../../index.php?id=$pet_id&adopted=1");
exit;
