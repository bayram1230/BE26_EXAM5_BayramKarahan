<?php
session_start();

// Only admins may access CRUD pages
if (!isset($_SESSION['admin'])) {

    // If logged-in user tries CRUD → alert + redirect to userprofile
    if (isset($_SESSION['user'])) {
        echo "<script>
                alert('You are not authorized to access the admin area!');
                window.location.href = '../register-login/userprofile.php';
              </script>";
        exit;
    }

    // If guest → alert + redirect to login
    echo "<script>
            alert('Please log in as admin to access this page.');
            window.location.href = '../register-login/login.php';
          </script>";
    exit;
}
