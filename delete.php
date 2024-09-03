<?php
require("conn.php");
$id = $_GET["id"];

$query = "DELETE FROM catatan WHERE id = '$id'";
$hapus = mysqli_query($conn, $query);
if ($hapus) {
  header("Location: index.php");
}