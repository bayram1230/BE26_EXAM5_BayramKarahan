<?php
// require_once "php/functions/pet_user_restriction.php";
require_once 'php/functions/db_connect.php';

$layout = "";
// Base SQL query
$sql = "SELECT * FROM pets"; 
// Execute query
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!empty($search)) {
        $layout .= "<h2 class='my-3'>Search results for: " . htmlspecialchars($search) . "</h2>";
    }

    foreach ($rows as $row) {
        $layout .= "<div class='card max-width350 card-index m-2'>
                        <img src='img/{$row['picture']}' class='min-height198 card-img-top card-img card-img320' alt='" . htmlspecialchars($row['name']) . "'>
                        <div class='card-body'>
                            <h4 class='card-title pt-4'>" . htmlspecialchars($row['name']) . "</h4>
                            <p class='card-text'>Breed: " . htmlspecialchars($row['breed']) . "</p>
                            <p class='card-text'>Gender: " . htmlspecialchars($row['gender']) . " </p>
                            <p class='card-text'>Age: " . htmlspecialchars($row['age']) . "</p>
                            <div class='text-button d-flex flex-column'>
                                <a href='php/crud/details.php?id={$row['id']}' class='btn btn-success pub-link'>More Details</a>
                            </div>
                        </div>
                    </div>";
    }
} else {
    $layout = "<h3 class='my-3'>No media found</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
         integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer">
    <link rel="stylesheet" href="css/style.css">
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
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="php/crud/create.php">Senior</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="php/register-login/register.php">Sign up</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Navbar end -->
    <!-- Main content-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 padding25">
        <?= $layout ?>
    </div>
    <!-- Main Content End -->
                              <!-- Footer Start -->
    <footer class="bg-success">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>