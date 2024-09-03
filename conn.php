<?php
$host = "0.0.0.0:3306";
$user = "root";
$pass = "root";
$db = "ZryPG";

$conn = mysqli_connect($host, $user, $pass, $db);
if (mysqli_error($conn)) {
  die("gagal connect");
}