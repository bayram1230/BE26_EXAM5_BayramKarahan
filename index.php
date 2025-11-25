<?php
require_once "php/functions/db_connect.php";
require_once "php/functions/get_profile.php";

$picture = getProfilePicture($conn);
$layout = "";

$sql = "SELECT * FROM pets"; //Pets older than 8
if (isset($_GET['senior']) && $_GET['senior'] == 1) {
    $sql = "SELECT * FROM pets WHERE age >= 8";
}

$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!empty($search)) {
        $layout .= "<h2 class='my-3'>Search results for: " . htmlspecialchars($search) . "</h2>";
    }
    foreach ($rows as $row) {
        $layout .= "
            <div class='card max-width350 card-index m-2'>
                <img src='img/{$row['picture']}' 
                     class='min-height198 card-img-top card-img card-img320' 
                     alt='" . htmlspecialchars($row['name']) . "'>
                <div class='card-body'>
                    <h4 class='card-title pt-4'>" . htmlspecialchars($row['name']) . "</h4>
                    <div class='text-button d-flex flex-column align-items-center'>
                         <p class='card-text'> 
                             Status: " . 
                             ($row['status'] === 'Adopted'
                             ? "<span class='text-danger fw-bold'>Adopted</span>" 
                             : "<span class='text-success fw-bold'>Available</span>") . "
                         </p>
                         <a href='php/crud/details.php?id={$row['id']}'class='btn btn-success pub-link mt-1'>
                            More Details
                         </a>" . ($row['status'] === 'Available'
                                  ? "<a href='php/adopt.php?pet_id={$row['id']}' class='btn btn-warning pub-link mt-2'>Take me home</a>"
                                  : "<button class='btn btn-secondary mt-2' disabled>Already adopted</button>") . "
                    </div>
                </div>
            </div>
        ";
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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <!-- Success adopt alert -->
        <?php if (isset($_GET['adopted'])): ?>
           <div class="alert alert-success text-center mt-3">
                You have successfully adopted this pet! 
           </div>
        <?php endif; ?>
       <!-- Success adopt alert -->
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <a class="navbar-brand text-white">PetHero</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="index.php?senior=1">Senior</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="php/register-login/register.php">Sign up</a></li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown d-flex align-items-center">
                            <!-- Profilbild = klickbarer Link -->
                            <a href="<?= getProfileLink() ?>" class="me-2">
                                <img src="img/<?= htmlspecialchars($picture) ?>" 
                                     style="width:40px"
                                     class="rounded-circle">
                            </a>
                            <!-- Pfeil = Dropdown -->
                            <a class="nav-link dropdown-toggle p-0"
                               href="#"
                               id="profileDropdown"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-end text-light"
                                aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item text-dark" href="php/register-login/login.php">Login</a></li>
                                <li><a class="dropdown-item text-dark" href="php/register-login/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
<!-- Navbar End -->
         <!-- Main Content Start -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 padding25">
            <?= $layout ?>
        </div>
        <!-- Main Content End -->
         <!-- Footer Start -->
        <footer class="bg-success mt-4 py-4">
            <div class="social-icons text-center mb-3">
                <a href="#"><i class="fab fa-facebook-f text-white"></i></a>
                <a href="#"><i class="fab fa-twitter text-white"></i></a>
                <a href="#"><i class="fab fa-google text-white"></i></a>
                <a href="#"><i class="fab fa-instagram text-white"></i></a>
                <a href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                <a href="#"><i class="fab fa-github text-white"></i></a>
            </div>
            <div class="newsletter text-center mb-4">
                <form class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                    <label for="newsletter-email" class="form-label text-white mb-0">Sign up for our newsletter</label>
                    <input type="email" id="newsletter-email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-outline-light">Subscribe</button>
                </form>
            </div>
            <div class="text-center text-white">© 2025 Copyright: Bayram Karahan</div>
        </footer>
        <!-- Footer End -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
