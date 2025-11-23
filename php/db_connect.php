<?php
//database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'be26_exam5_bayramkarahan_pethero';

// create connection
$conn = mysqli_connect($host, $user, $password, $database);

// check connection
if (!$conn) {
  die("Connection failed");
}
