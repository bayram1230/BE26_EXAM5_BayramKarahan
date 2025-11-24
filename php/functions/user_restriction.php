<?php
session_start();

// No admin/user? -> back to login
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: ../register-login/login.php?restricted=true");
    exit;
}

// Gets the name of the currently running PHP file (e.g., "dashboard.php") 
$currentFile = basename($_SERVER['PHP_SELF']);  // This allows us to check which page is being accessed and apply the correct access rules

// Cut access for user to CRUD-pages
if (isset($_SESSION['user']) && $currentFile !== "userprofile.php" && $currentFile !== "update_profile.php") {
    // User versucht eine Admin-Datei zu öffnen
    header("Location: ../register-login/userprofile.php?forbidden=admin");
    exit;
}

// Cut access for admin to userpage
if (isset($_SESSION['admin']) && $currentFile === "userprofile.php") {
    header("Location: ../crud/dashboard.php?forbidden=user");
    exit;
}
