<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    // Wenn kein Admin → zurück zum Login (oder userprofile.php, je nach Wunsch)
    header("Location: ../register-login/login.php?restricted=true");
    exit;
}
if(isset($_SESSION['user'])){
    header("Location: ../register-login/userprofile.php");
    exit;
}
?>