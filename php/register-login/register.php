<?php
require_once "../functions/db_connect.php";
require_once "../functions/file_upload.php";
require_once "../functions/function.php";
require_once "../functions/get_profile.php";

$error = false;  // by default, a varialbe $error is false, means there is no error in our form
$fname = $lname = $email = $date_of_birth = $phone = $address = "";
$fnameError = $lnameError = $emailError = $dateError = $passError = $phoneError = $addressError = "";

if(isset($_POST["sign-up"])){
    $fname = cleanInputs($_POST["fname"]);
    $lname = cleanInputs($_POST["lname"]);
    $email = cleanInputs($_POST["email"]);
    $password = cleanInputs($_POST["password"]);
    $date_of_birth = cleanInputs($_POST["date_of_birth"]);
    $phone = cleanInputs($_POST["phone"]);
    $address = cleanInputs($_POST["address"]);
    $picture = fileUpload($_FILES["picture"]);

    // validation for the first name
    if(empty($fname)){
        $error = true;
        $fnameError = "Please, enter your first name";
    }elseif(strlen($fname) < 3){
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    }elseif(!preg_match("/^[a-zA-Z\s]+$/", $fname)){
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    }

    // validation for the last name
    if(empty($lname)){
        $error = true;
        $lnameError = "Please, enter your last name";
    }elseif(strlen($lname) < 3){
        $error = true;
        $lnameError = "Last name must have at least 3 characters.";
    }elseif(!preg_match("/^[a-zA-Z\s]+$/", $lname)){
        $error = true;
        $lnameError = "Last name must contain only letters and spaces.";
    }

    // validation for the date of birth
    if(empty($date_of_birth)){
        $error = true;
        $dateError = "date of birth can't be empty!";
    }

    // validation for email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "Please enter a valid email address";
    }else{
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) != 0){
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }

    // validation for phone
    if(empty($phone)){
        $error = true;
        $phoneError = "Phone number is required.";
    }elseif(!preg_match('/^[0-9+\s-]+$/', $phone)){
        $error = true;
        $phoneError = "Phone must contain only numbers, spaces, + or -.";
    }

    // validation for address
    if(empty($address)){
        $error = true;
        $addressError = "Address is required.";
    }

    // validation for password
    if(empty($password)){
        $error = true;
        $passError = "Password can't be empty!";
    }elseif(strlen($password) < 6){
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    if(!$error){
        $password = hash("sha256", $password);
        $sql = "INSERT INTO users (first_name, last_name, user_password, email, date_of_birth, phone, address, picture) 
                VALUES ('$fname','$lname', '$password', '$email', '$date_of_birth', '$phone', '$address', '$picture[0]')";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<div class='alert alert-success'><p>New account has been created, $picture[1]</p></div>";
        }else{
            echo "<div class='alert alert-danger'><p>Something went wrong, please try again later ...</p></div>";
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
                                <li><a class="dropdown-item text-dark" href="../login-register/login.php">Login</a></li>
                                <li><a class="dropdown-item text-dark" href="../login-register/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar end-->
        <!-- Main Content Start -->
        <h1 class="text-center mt-5">Sign Up</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="fname" class="form-label">First name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= $fname ?>">
                <span class="text-danger"><?= $fnameError ?></span>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?= $lname ?>">
                <span class="text-danger"><?= $lnameError ?></span>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                <span class="text-danger"><?= $dateError ?></span>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone ?>">
                <span class="text-danger"><?= $phoneError ?></span>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
                <span class="text-danger"><?= $addressError ?></span>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?= $passError ?></span>
            </div>
            <button name="sign-up" type="submit" class="btn btn-success">Create account</button>
            <span>you have an account already? <a href="login.php">sign in here</a></span>
        </form>
    <!-- Main content End -->
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
