<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db_connect.php";

/* Returns avatar of logged-in user/admin */
function getProfilePicture($conn) {

    $id = $_SESSION['admin'] ?? $_SESSION['user'] ?? null;

    if (!$id) return "avatar.png";

    $sql = "SELECT picture FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return !empty($row['picture']) ? $row['picture'] : "avatar.png";
}

define("BASE_URL", "http://localhost:3000/");

function getProfileLink() {
    if (isset($_SESSION['admin'])) 
        return BASE_URL . "php/crud/dashboard.php";

    if (isset($_SESSION['user']))  
        return BASE_URL . "php/register-login/userprofile.php";

    return BASE_URL . "php/register-login/login.php";
}