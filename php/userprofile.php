<?php
session_start();
if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
    header("Location: login.php?restricted=true");
    exit;
}
if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit;
}

require_once "db_connect.php";

$sql = "SELECT * FROM users WHERE id = $_SESSION[user]";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$picture = !empty($row['picture']) ? $row['picture'] : 'avatar.png';
?>


<!doctype html>
<html lang="en">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>User profile - Welcome <?= $row['first_name']; ?></title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
       <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
         integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/style.css">
   </head>
<body>
    <h1>Welcome <?= $row['first_name']; ?><?= $row['last_name']; ?></h1>
    <img src="../img/<?= htmlspecialchars($picture) ?>" alt="profile picture">
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="update_profile.php">Update profile</a></li>
    </ul>
</body>
</html>