<?php
require_once "../functions/user_restriction.php";
require_once "../functions/db_connect.php";
require_once "../functions/file_upload.php";

$id = $_GET['id'];
$sql = "SELECT * FROM `pets` WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_pet'])){
    $name = $_POST['name'];                                                // $_POST['create_media'] -> This line is a condition that checks whether the form for creating a media object has been submitted. The entire code block within this if statement will only execute if the form was submitted via POST and the create_media parameter is present in the $_POST array.
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $vaccine = $_POST['vaccine'];
    $size = $_POST['size'];
    $neutered = $_POST['neutered'];
    $short_description = $_POST['short_description'];
    $picture = fileUploadPet($_FILES['picture']);

    if($_FILES['picture']['error'] == 4){
        $updateSql = "UPDATE `pets` SET `breed`='$breed',`gender`='$gender',`age`='$age',`vaccine`='$vaccine',`size`='$size',`name`='$name',`neutered`='$neutered',`short_description`='$short_description' WHERE id = $id";
    }else{
        if($row['picture'] != 'pet.jpg'){
            unlink("img/{$row['picture']}");
        }
        $updateSql = "UPDATE `pets` SET `breed`='$breed',`gender`='$gender',`age`='$age',`vaccine`='$vaccine',`size`='$size',`name`='$name',`neutered`='$neutered',`picture`= '$picture[0]',`short_description`='$short_description' WHERE id = $id";
    }
    $result1 = mysqli_query($conn, $updateSql);
    if($result1){
        echo "<div class='alert alert-success'>
                   Pet updated successfully !
              </div>";       
    }else{
        echo "<div class='alert alert-danger'>
                   Something went wrong !
              </div>";
    }
    header("refresh: 3; url=../../index.php");
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
          <a class="nav-link" href="create.php">Add media</a>
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
        <div class="row">
            <div class="col col-md-6 mx-auto">
                <h3 class="mt-5">Update pet</h3>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $row['name']?>">
                </div>
                <div class="mb-3">
                    <label for="breed">Breed:</label>
                    <input type="text" class="form-control" id="breed" name="breed" value="<?= $row['breed']?>">
                </div>
                <div class="mb-3">
                    <label for="gender">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="<?= $row['gender']?>">
                </div>
                <div class="mb-3">
                    <label for="age">Age:</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?= $row['age']?>">
                </div>
                <div class="mb-3">
                    <label for="vaccine">Vaccine:</label>
                    <input type="text" class="form-control" id="vaccine" name="vaccine" value="<?= $row['vaccine']?>">
                </div>
                <div class="mb-3">
                    <label for="size">Size:</label>
                    <input type="text" class="form-control" id="size" name="size" value="<?= $row['size']?>">
                </div>
                <div class="mb-3">
                    <label for="neutered">Neutered:</label>
                    <input type="text" class="form-control" id="neutered" name="neutered" value="<?= $row['neutered']?>">
                </div>
                <div class="mb-3">
                    <label for="short_description">Short description</label>
                    <input type="text" class="form-control" id="short_description" name="short_description" value="<?= $row['short_description']?>">
                </div>
                <div class="mb-3">
                    <label for="picture">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture" value="<?= $row['picture']?>">
                </div>
                <input type="submit" class="btn btn-success" name="update_pet" value="submit">
            </form>
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
</body>
</html>