<?php
session_start();
require "../session.php";
require "../functions.php";

if ($role !== 'Admin') {
  header("location:../login.php");
}

// Pagination
$jmlHalamanPerData = 3;
$jumlahData = count(query("SELECT sewa.id_sewa,user.nama_lengkap,sewa.tanggal_pesan,sewa.jam_mulai,sewa.lama_sewa,sewa.total,bayar.bukti,bayar.konfirmasi
FROM sewa
JOIN user ON sewa.id_user = user.id_user
JOIN bayar ON sewa.id_sewa = bayar.id_sewa"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$pesan = query("SELECT sewa.id_sewa,user.nama_lengkap,sewa.tanggal_pesan,sewa.jam_mulai,sewa.lama_sewa,sewa.total,bayar.bukti,bayar.konfirmasi
FROM sewa
JOIN user ON sewa.id_user = user.id_user
JOIN bayar ON sewa.id_sewa = bayar.id_sewa 
ORDER BY sewa.jam_mulai ASC
LIMIT $awalData, $jmlHalamanPerData");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <style>
    /* Tambahkan efek hover pada tombol "Home" */
    .btn-home:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
      /* Ganti warna teks saat hover */
    }

    .btn-member:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
    }

    .btn-lapangan:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
    }

    .btn-pesan:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
    }

    .btn-admin:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
    }

    .btn-logout:hover {
      background-color: #6A5ACD;
      /* Ganti warna background saat hover */
      color: #6A5ACD;
    }

    .btn-download {
      background-color: #6A5ACD !important;
    }

    .btn-download:hover {
      background-color: #BAACFF !important;
    }

    .table-inti {
      background-color: #6A5ACD;
      /* Ganti warna latar belakang */
      color: #FFFFFF;
    }
  </style>

  <title>Data Pesanan</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="sidebar col-2 bg-secondary">
        <!-- Sidebar -->
        <h5 style="color: #FFFFFF;" class="mt-5 judul text-center"><?= $_SESSION["username"]; ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent"><a class="btn btn-home" style="color: #FFFFFF"
              href="home.php">Home</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-member" style="color: #FFFFFF"
              href="member.php">Data Member</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-lapangan" style="color: #FFFFFF"
              href="lapangan.php">Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-pesan" style="color: #FFFFFF"
              href="pesan.php">Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a class="btn btn-admin" style="color: #FFFFFF"
              href="admin.php">Data Admin</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a class="btn btn-logout" style="color: #FFFFFF" href="../logout.php"
          class="mt-5 btn btn-inti text-dark">Logout</a>
      </div>
      <div class="col-10 p-5 mt-5">
        <!-- Konten -->
        <h3 style="color: #6A5ACD;" class="judul">Data Pesanan</h3>
        <hr>
        <a href="export.php" class="btn btn-download mt-5" style="color: #FFFFFF">Download</a>
        <table class="table table-hover mt-3">
          <thead class="table-inti">
            <tr>
              <th scope="col">No</th>
              <th scope="col">NamaCust</th>
              <th scope="col">TglPesan</th>
              <th scope="col">TglMain</th>
              <th scope="col">Lama</th>
              <th scope="col">Total</th>
              <th scope="col">Bukti</th>
              <th scope="col">Konfir</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="text">
            <?php $i = 1; ?>
            <?php foreach ($pesan as $row): ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $row["nama_lengkap"]; ?></td>
                <td><?= $row["tanggal_pesan"]; ?></td>
                <td><?= $row["jam_mulai"]; ?></td>
                <td><?= $row["lama_sewa"]; ?></td>
                <td><?= $row["total"]; ?></td>
                <td><img src="../img/<?= $row["bukti"]; ?>" width="100" height="100"></td>
                <td><?= $row["konfirmasi"]; ?></td>
                <td>
                  <?php
                  $id_sewa = $row["id_sewa"];
                  if ($row["konfirmasi"] == "Terkonfirmasi") {
                    // tampilkan tombol Bayar dan Hapus
                    echo '';
                  } else {
                    // tampilkan tombol Detail
                    echo ' <button type="button" class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#konfirmasiModal' . $id_sewa . '">
                    Konfir
                  </button>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal' . $id_sewa . '">
                    Hapus
                  </button>
                  ';
                  }
                  ?>
                </td>
              </tr>
              <!-- Modal Konfirmasi -->
              <div class="modal fade" id="konfirmasiModal<?= $row["id_sewa"]; ?>" tabindex="-1"
                aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pesanan <?= $row["nama_lengkap"]; ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin mengkonfirmasi pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/konfirmasiPesan.php?id=<?= $row["id_sewa"]; ?>"
                        class="btn btn-primary">Konfirmasi</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->

              <!-- Modal Hapus -->
              <div class="modal fade" id="hapusModal<?= $row["id_sewa"]; ?>" tabindex="-1"
                aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusModalLabel">Hapus Pesanan <?= $row["nama_lengkap"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin menghapus pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/hapusPesan.php?id=<?= $row["id_sewa"]; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->
            <?php endforeach; ?>
          </tbody>
        </table>

        <ul class="pagination">
          <?php if ($halamanAktif > 1): ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Previous</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $jmlHalaman; $i++): ?>
            <?php if ($i == $halamanAktif): ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else: ?>
              <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $jmlHalaman): ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>