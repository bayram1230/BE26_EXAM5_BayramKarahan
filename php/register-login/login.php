<?php
session_start();
// overwrite any existing session (admin or user)
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

require_once "../functions/function.php";
require_once "../functions/db_connect.php";
require_once "../functions/get_profile.php";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["user_password"];
    $error = false;
    if (empty($email)) {
        $error = true;
        $emailError = "The email is required";
    }
    if (empty($password)) {
        $error = true;
        $passwordError = "The password is required";
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "SELECT * FROM users 
                WHERE email = '$email' 
                  AND user_password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['user_type'] == "admin") {
                header("Location: ../crud/dashboard.php");
                $_SESSION['admin'] = $row['id'];
                exit;
            } elseif ($row['user_type'] == "user") {
                header("Location: userprofile.php");
                $_SESSION['user'] = $row['id'];
                exit;
            }
        } else {
            $pageMessage = "Your email or password is incorrect";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
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
                        <li class="nav-item"><a class="nav-link" href="../crud/create.php">Senior</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="<?= getProfileLink() ?>" class="me-2">
                                <img src="<?= BASE_URL ?>img/<?= htmlspecialchars(getProfilePicture($conn)) ?>" style="width:40px" class="rounded-circle">
                            </a>
                            <a class="nav-link dropdown-toggle p-0"
                               href="#"
                               id="profileDropdown"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-end text-dark" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item text-dark" href="login.php">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar end-->
        <h1 class="text-center mt-5">Login</h1>
        <p class="text text-danger"><?= $pageMessage ?? "" ?></p>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                <p class="text text-danger"><?= $emailError ?? "" ?></p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="user_password" name="user_password">
                <p class="text text-danger"><?= $passwordError ?? "" ?></p>
            </div>
            <button name="login" type="submit" class="btn btn-success">login</button>
        </form>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?= exit ?>
