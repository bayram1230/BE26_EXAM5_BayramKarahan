<?php

   require_once "db_connect.php";
   require_once "file_upload_user.php";
   require_once "function.php";

   $error = false;  // by default, a varialbe $error is false, means there is no error in our form

   $fname = $lname = $email = $date_of_birth = ""; // define variables and set them to empty string
   $fnameError = $lnameError = $emailError = $dateError = $passError = ""; // define variables that will hold error messages later, for now empty string

   if(isset($_POST["sign-up"])){
       $fname = cleanInputs($_POST["fname"]);
       $lname = cleanInputs($_POST["lname"]);
       $email = cleanInputs($_POST["email"]);
       $password = cleanInputs($_POST["password"]);
       $date_of_birth = cleanInputs($_POST["date_of_birth"]);
       $picture = fileUpload($_FILES["picture"]);

       // simple validation for the "first name"
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

       // simple validation for the "last name"
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

       // simple validation for the "date of birth"
       if(empty($date_of_birth)){
           $error = true;
           $dateError = "date of birth can't be empty!";
       }

      
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // if the provided text is not a format of an email, error will be true
           $error = true;
           $emailError = "Please enter a valid email address";
       }else {
           // if email is already exists in the database, error will be true
           $query = "SELECT email FROM users WHERE email='$email'";
           $result = mysqli_query($conn, $query);
           if(mysqli_num_rows($result) != 0){
               $error = true;
               $emailError = "Provided Email is already in use";
           }
       }

       // simple validation for the "password"
       if (empty($password)) {
           $error = true;
           $passError = "Password can't be empty!";
       } elseif (strlen($password) < 6) {
           $error = true;
           $passError = "Password must have at least 6 characters.";
       }

       if(!$error){ // if there is no error with any input, data will be inserted to the database
           // hashing the password before inserting it to the database
           $password = hash("sha256", $password);

           $sql = "INSERT INTO users (first_name, last_name, user_password, email, date_of_birth, picture) VALUES ('$fname','$lname', '$password', '$email', '$date_of_birth', '$picture[0]')";

           $result = mysqli_query($conn, $sql);

           if($result){
               echo "<div class='alert alert-success'>
               <p>New account has been created, $picture[1]</p>
           </div>";
           }else {
               echo "<div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
           </div>";
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
           <h1 class="text-center mt-5">Sign Up</h1>
           <form method="post" autocomplete="off" enctype="multipart/form-data">
               <div class="mb-3 mt-3">
                   <label for="fname" class="form-label">First name</label>
                   <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $fname ?>">
                   <span class="text-danger"><?= $fnameError ?></span>
               </div>
               <div class="mb-3">
                   <label for="lname" class="form-label">Last name</label>
                   <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>">
                   <span class="text-danger"><?= $lnameError ?></span>
               </div>
               <div class="mb-3">
                   <label for="date" class="form-label">Date of birth</label>
                   <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                   <span class="text-danger"><?= $dateError ?></span>
               </div>
               <div class="mb-3">
                   <label for="picture" class="form-label">Profile picture</label>
                   <input type="file" class="form-control" id="picture" name="picture">
               </div>
               <div class="mb-3">
                   <label for="email" class="form-label">Email address</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
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