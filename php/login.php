<?php
session_start();

require_once "function.php";

if(isset($_GET["restricted"])){
    $pageMessage = "You dont have access to this page";
}

require_once "db_connect.php";

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
                header("Location: dashboard.php");
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
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Add pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Sign up</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Navbar end -->
           <h1 class="text-center mt-5">Login</h1>
           <p class="text text-danger"><?= $pageMessage ?? "" ?></p>
           <form method="post" autocomplete="off" enctype="multipart/form-data">               
               <div class="mb-3">
                   <label for="email" class="form-label">Email address</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
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
     
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   </body>
</html>
<?= exit ?>