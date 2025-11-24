<?php
require_once "../functions/user_restriction.php";
require_once "../functions/db_connect.php";

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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
         integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer">
      <link rel="stylesheet" href="../../css/style.css">
   </head>
<body>
<div class="container">  
                  <!-- Navbar start-->
<nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
    <a class="navbar-brand">PetHero</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Add pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../register-login/register.php">Sign up</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Navbar end -->
      <!-- Main content-->
       <div class="account-wrapper">
      <h1>Welcome <?= $row['first_name'] . " " . $row['last_name'] ?></h1>
    <img src="../../img/<?= htmlspecialchars($picture) ?>" alt="profile picture" style="width:180px">
    <ul>
        <li><a href="crud.php">Pets management</a></li>
        <li><a href="../register-login/logout.php">Logout</a></li>
        <li><a href="../register-login/update_profile.php">Update profile</a></li>
    </ul>
</div>
    <!-- Main content end -->
                                        <!-- Footer Start -->
    <footer class="bg-success mt-5">
      <!-- Social Media Icons -->
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-google"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-github"></i></a>
      </div>
      <!-- Newsletter mit maximal Bootstrap -->
      <div class="newsletter mb-4">
        <form
          class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2"
        >
          <label for="newsletter-email" class="form-label text-white mb-0"
            >Sign up for our newsletter</label
          >
          <input
            type="email"
            id="newsletter-email"
            placeholder="Enter your email"
            class="form-control"
          />
          <button type="submit" class="btn btn-outline-light">Subscribe</button>
        </form>
      </div>
      <!-- Copyright -->
      <div class="copyright">© 2025 Copyright: Bayram Karahan</div>
    </footer>
    <!-- Footer End -->
</div>     
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
