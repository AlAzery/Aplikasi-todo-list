<?php
require_once("conn.php");
date_default_timezone_set('Asia/Jakarta');
//alert notifikasi
$textKosong = false;
$success = false;
$failed = false;

//menampilkan data

$catatanall = mysqli_query($conn, "SELECT * FROM catatan");

$rows = [];
while($row = mysqli_fetch_assoc($catatanall)){
  $rows[] = $row;
}


if (isset($_POST["simpan"])) {
  //ambil catatan
  $catatan = mysqli_real_escape_string($conn, htmlspecialchars($_POST["catatan"]));
  $hari = date("l");
  $jam = date("H:i:s");
  $hari_indonesia = array(
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu',
    'Sunday'    => 'Minggu'
    );
  $tanggal = $hari_indonesia[$hari]. " ".$jam;
  //cek catatan ada isi apa tidak
  if (!$catatan == null) {
    //insert kedatabase
    $query = "INSERT INTO catatan VALUES (null, '$catatan', '$tanggal')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
      header("Location: index.php");
    }else{
      $failed = true;
      // echo("<script>alert('gagal');</script>");
    }
  }else{
    $textKosong = true;
    // echo("<script>alert('Text Kosong');</script>");
  }
  
  
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Todo-List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="bootstrap.css" type="text/css" media="all" />
</head>
<body>
  <header class="bg-body-tertiary">
    <div class="container-fluid d-flex justify-content-center">
      <h1 class="navbar-brand mb-0">Todo-List</h1>
    </div>
  </header>
  <main class="container mt-5">
    <?php if ($textKosong): ?>
      <div class="alert alert-warning" role="alert">
        Mohon masukan teks!
      </div>
    <?php endif; ?>
    <?php if ($failed): ?>
      <div class="alert alert-danger" role="alert">
        Gagal.
      </div>
    <?php endif; ?>
    <form action="" method="post" accept-charset="utf-8">
      <div class="form-group">
        <textarea name="catatan" class="form-control" placeholder="Masukan Catatan..." rows="2" cols="30"></textarea>
      </div>
      <div class="mt-3">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </form>
    <div class="mt-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Catatan</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php $i= 0;?>
          <?php foreach ($rows as $row): ?>
          <?php $i++;?>
            <tr>
              <th scope="row"><?= $i;?></th>
              <td><?= $row["teks"]?></td>
              <td><?= $row["tanggal"]?></td>
              <td><a href="delete.php?id=<?= $row['id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>