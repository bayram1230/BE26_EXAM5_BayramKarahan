<?php
require_once '../functions/db_connect.php';  // Connect to database

$sql = "SELECT * FROM pets"; // Create variable, retrieve data and store  SQL data inside

$result = mysqli_query($conn, $sql);

$layout = ""; // Dont forget to insert the $layout variable in the body of html


if(mysqli_num_rows($result) > 0){ // mysqli_num_rows($result) → counts how many rows are in the result of your query
                                  // > 0 → checks if there is at least one row

    $row = mysqli_fetch_assoc($result); // fetching all rows (records) from the result of SQL query and storing them in the PHP variable

    $layout = "
    <div class='container'>
         <div class='card card-border'>
                <div class='row'>
                    
                     <div class='col-md-8'>
                         <div class='card-body details-body'>
                         <h4 class='card-title mb-5'>{$row['name']}</h4>
                         <p>{$row['short_description']}</p>
                         <hr class='line'>
                         <div class='table-wrap'>
                              <img src='../{$row['picture']}' class='card-img-top card-img2 card-img320 center border-none' alt='{$row['name']}'>
                              <table class='border-table'>
                                    <tr>
                                        <th>Breed:</th>
                                        <td>{$row['breed']}</td>
                                    </tr>                                
                                    <tr>
                                        <th>Gender:</th>
                                        <td>{$row['gender']}</td>
                                    </tr>
                                    <tr>
                                        <th>Age:</th>
                                        <td>{$row['age']}</td>
                                    </tr>
                              </table>
                              <table>
                                    <tr>
                                        <th>Vaccine:</th>
                                        <td>{$row['vaccine']}</td>
                                    </tr>
                                    <tr>
                                        <th>Size:</th>
                                        <td  class='pub-address'>{$row['size']}</td>
                                    </tr>
                                    <tr>
                                        <th>Neutered:</th>
                                        <td>{$row['neutered']}</td>
                                    </tr>
                              </table>
                              </div>
                         </div>
                    </div>
               </div>
         </div>
    </div>
    ";
  
   } else {

    $layout = "<h3>No data found</h3>";

   }
   
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam 4</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
          <a class="nav-link" href="create.php">Senior</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../register-login/register.php">Sign up</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Navbar end -->
              <!-- Main Content Start -->
    <?= $layout; ?>
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>