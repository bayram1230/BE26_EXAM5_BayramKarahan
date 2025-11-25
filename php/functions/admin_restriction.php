<?php
session_start();

// Admins are NOT allowed on user pages
if (isset($_SESSION['admin'])) {
    echo "<script>
            alert('Admins are not allowed to access user pages!');
            window.location.href = '../crud/dashboard.php';
          </script>";
    exit;
}
