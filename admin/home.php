<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
}

$lapangan = query("SELECT COUNT(id_lapangan) AS jml_lapangan FROM lapangan")[0];
$pesanan = query("SELECT COUNT(id_bayar) AS jml_sewa FROM bayar")[0];
$user = query("SELECT COUNT(id_user) AS jml_user FROM user")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <style>
    /* Tambahkan efek hover pada tombol "Home" */
    .btn-home:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD; /* Ganti warna teks saat hover */
    }
      .btn-member:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD;
    }
    .btn-lapangan:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD;
    }
    .btn-pesan:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD;
    }
    .btn-admin:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD;
    }
    .btn-logout:hover {
      background-color: #6A5ACD; /* Ganti warna background saat hover */
      color: #6A5ACD;
    }
  </style>
  <title>Home</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="sidebar col-2 bg-secondary">
        <!-- Sidebar -->
        <h5 style="color: #FFFFFF;" class="mt-5 judul text-center"><?= $_SESSION["username"]; ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent"><a class="btn btn-home" style="color: #FFFFFF" href="home.php">Home</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-member" style="color: #FFFFFF" href="member.php">Data Member</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-lapangan" style="color: #FFFFFF" href="lapangan.php">Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-pesan" style="color: #FFFFFF" href="pesan.php">Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-admin" style="color: #FFFFFF" href="admin.php">Data Admin</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a class="btn btn-logout" style="color: #FFFFFF" href="../logout.php" class="mt-5 btn btn-inti text-dark">Logout</a>
      </div>
      <div class="col-10 p-5 mt-5">
        <!-- Konten -->
        <h3 style="color: #6A5ACD;" class="judul">Home</h3>
        <hr>
        <div class="row row-cols-1 row-cols-md-4 g-3 justify-content-center my-5 gap-3">
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/bg2.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Lapangan</h5>
                <h2 class="card-text text-center"><?= $lapangan["jml_lapangan"]; ?></h2>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/bg2,2.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Pesanan</h5>
                <h2 class="card-text text-center"><?= $pesanan["jml_sewa"]; ?></h2>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/user.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Member</h5>
                <h2 class="card-text text-center"><?= $user["jml_user"]; ?></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="announcement">
          <h3 style="color: #6A5ACD;" class="judul">Berita Gokil</h3>
          <hr>
          <div class="text p-2 mb-2">
            <p>Perubahan Jadwal Olahraga <br> <br> Kepada seluruh member Futsal Booking. <br>
              Kami ingin memberitahukan bahwa terdapat perubahan jadwal olahraga di Futsal Booking. Mulai hari senin, 29 april 2024. Karena ada perbaikan lapangan. <br> <br>
              Mohon maaf atas ketidaknyamanan yang ditimbulkan dan terimakasih atas perhatiannya. <br> <br>
              Salam Olahraga <br>
              Futsal Booking
            </p>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>