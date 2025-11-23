<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    // Wenn kein Admin → zurück zum Login (oder userprofile.php, je nach Wunsch)
    header("Location: login.php?restricted=true");
    exit;
}
if(isset($_SESSION['user'])){
    header("Location: userprofile.php");
    exit;
}

require_once "db_connect.php";

$sql = "SELECT * FROM users WHERE id = $_SESSION[admin]";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$picture = !empty($row['picture']) ? $row['picture'] : 'avatar.png';
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Admin Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
