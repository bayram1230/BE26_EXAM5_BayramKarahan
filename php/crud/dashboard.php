<?php
require_once "../functions/user_restriction.php";
require_once "../functions/db_connect.php";
require_once "../functions/get_profile.php";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <!-- Navbar start-->
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <a class="navbar-brand">PetHero</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="create.php">Senior</a></li>
                        <li class="nav-item"><a class="nav-link" href="../register-login/register.php">Sign up</a></li>
                    </ul>
                    <!-- Avatar + Dropdown -->
                    <div class="dropdown text-end d-flex align-items-center">
                        <a href="<?= getProfileLink() ?>" class="me-1">
                            <img src="<?= BASE_URL ?>img/<?= htmlspecialchars(getProfilePicture($conn)) ?>" style="width:40px" class="rounded-circle">
                        </a>
                        <button class="btn dropdown-toggle p-0 text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;background:transparent;"></button>
                        <ul class="dropdown-menu dropdown-menu-end text-dark">
                            <li><a class="dropdown-item text-dark" href="../register-login/login.php">Login</a></li>
                            <li><a class="dropdown-item text-dark" href="../register-login/logout.php">Logout</a></li>
                        </ul>
                    </div>
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
        <!-- Main content end-->
        <!-- Footer Start -->
        <footer class="bg-success mt-5">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
            <div class="newsletter mb-4">
                <form class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                    <label for="newsletter-email" class="form-label text-white mb-0">Sign up for our newsletter</label>
                    <input type="email" id="newsletter-email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-outline-light">Subscribe</button>
                </form>
            </div>
            <div class="copyright">© 2025 Copyright: Bayram Karahan</div>
        </footer>
        <!-- Footer End -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
