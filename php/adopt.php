<?php
session_start();
require_once "functions/db_connect.php";
require_once "functions/guest_restriction.php";
require_once "functions/get_profile.php";

// User must be logged in (not admin)
if (!isset($_SESSION['user'])) {
    header("Location: ../register-login/login.php");
    exit;
}

$user_id = $_SESSION['user'];
$pet_id = $_GET['pet_id'];

// Check if already adopted
$checkSql = "SELECT * FROM pet_adoption WHERE user_id = $user_id AND pet_id = $pet_id";
$checkResult = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($checkResult) > 0) {
    echo "<div class='alert alert-warning'>You already adopted this pet.</div>";
    header("refresh: 2; url=../../index.php");
    exit;
}

// Insert adoption
$insertSql = "INSERT INTO pet_adoption (user_id, pet_id) VALUES ($user_id, $pet_id)";
if (mysqli_query($conn, $insertSql)) {
    echo "<div class='alert alert-success'>Pet adopted successfully! ❤️</div>";
} else {
    echo "<div class='alert alert-danger'>Something went wrong...</div>";
}

// update pet status
mysqli_query($conn, "UPDATE pets SET status = 'Adopted' WHERE id = $pet_id");

header("refresh: 2; url=../../index.php");
exit;
