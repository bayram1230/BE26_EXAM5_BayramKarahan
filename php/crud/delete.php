<?php
require_once "../functions/user_restriction.php";
require_once "../functions/db_connect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM `pets` WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['picture'] != 'pet.jpg'){
            unlink("img/{$row['picture']}");
        }

        $deleteSql= "DELETE FROM `pets` WHERE id = $id";
        $result = mysqli_query($conn, $deleteSql);
        header("Location: ../../index.php");

?>