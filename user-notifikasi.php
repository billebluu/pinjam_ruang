<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

  //Mengoneksikan ke database
  require 'functions.php';
  $id = $_GET["id"];
  $data1 = "SELECT * FROM user WHERE id = $id";
  $user1 = query($data1)[0];

  $data = "SELECT * FROM data_pengajuan where id = $id ORDER BY id_ajuan DESC";
  $user = query($data);

  if (!empty($array) && isset($array[0])) {
    // Lakukan sesuatu dengan $array[0]
    // Mengambil data untuk disimpan ke dalam variabel
      $nama_pengaju = $user[0]["nama_pengaju"];
      $nim_nip = $user[0]["nim_nip"];
      $nama_ruang = $user[0]["nama_ruang"];
      $kegiatan = $user[0]['kegiatan'];
      $waktu = $user[0]["waktu"];
      $formattedWaktu = date("H.i", strtotime($waktu));
      $status = $user[0]["status"];
      $statusUser = $user[0]['statusUser'];

      // Format tanggal
      $tgl_awal = $user[0]["tgl_awal"];
      $hari = getHari($tgl_awal);
      $tgl = date("d", strtotime($tgl_awal));
      $bln = getBulan($tgl_awal);
      $thn = date("Y", strtotime($tgl_awal));
  } else {
      // Array kosong atau elemen dengan indeks 0 tidak ada
      echo "";
  }
?>

<!DOCTYPE html>
<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="styling.css" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <title> PinjamRuang FATISDA </title>
      <style>
        *{
            font-family: 'Montserrat', sans-serif;
            color: black;
            padding: 0;
            margin: 0;
        }

        body{
            min-height: 100vh;
        }

        header {
            /* Gaya CSS untuk header */
            margin-top: 10px;
            margin-bottom: 20px; /* Atur jarak bawah header */
            margin-left: 40px;
            margin-right: 40px;
        }
          
        section {
            /* Gaya CSS untuk section */
            margin-top: 20px; /* Atur jarak atas section */
            margin-left: 40px;
            margin-right: 40px;
            margin-bottom: 80px;
        }

        .notification {
            padding-left: 30px;
            padding-right: 30px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
            display: flex;
            flex-direction:row;
            align-items: center;
        }
        
        /* .notifAcceptedDatetime{
            padding-top: 20px;
            padding-left: 10px;
            width: 20%;
            background-color: #dff0d8;
        } */

        .notifAcceptedMessage{
            padding-top: 20px;
            background-color: #dff0d8;
        }

        /* .notifRejectedDatetime{
            padding-top: 20px;
            padding-left: 60px;
            width: 20%;
            background-color: #f8d7da;
        } */

        .notifRejectedMessage{
            padding-top: 20px;
            background-color: #f8d7da;
        }

        /* .notifSubmittedDatetime{
            padding-top: 20px;
            padding-left: 60px;
            width: 20%;
            background-color: #f2f2f2;
        } */

        .notifSubmittedMessage{
            padding-top: 20px;
            background-color: #f2f2f2;

        }

        .customLinkSuccess{
            text-decoration: underline;
            background-color: #dff0d8;
            color:#000000;
        }

        .accepted{
            background-color: #dff0d8;
        }

        .rejected{
            background-color: #f8d7da;
        }

        .submitted{
            background-color: #f2f2f2;
        }

        .notifHidden{
            display: none;
        }

        .fa-clock, .fa-check, .fa-xmark{
          margin-right: 30px;
        }

        .bg-table-color{
          background-color: #c9efff;
        }
      </style>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body">
          <div class="container-fluid">
            <div class="navbar-brand logo">
              <a><img src="logouns.png" alt="Logo" id="logo"></a>
            </div>
            <div class="navbar-divider"></div>
            <div class="navbar-title"><h1>PinjamRuang<br>FATISDA</h1></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item custom-nav-item">
                  <a class="nav-link active" aria-current="page" href="user-home.php?id=<?= $id; ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $user1['nama'] ?></a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="user-profile.php?id=<?= $id; ?>">Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</a></li>
                  </ul>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <!-- Awal Modal Logout -->
      <div class="modal custom-modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-5" style="background-color:#c9efff; border-radius:40px; align-items: center; justify-items: center;">
                    <h1 class="modal-title fs-5" style="font-weight: bolder;" id="staticBackdropLabel">Apakah Anda yakin untuk logout?</h1>
                    <div class="mt-4">
                        <button type="button" class="btn mx-2" style="padding-right:40px; padding-left:40px; border-radius:40px; background-color: white; border-color: #71d4ff; color:black" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn mx-2" style="padding-right:40px; padding-left:40px; border-radius:40px; background-color: #71d4ff; color:black"><a href="user-logout.php?id=<?= $id; ?>" class="nav-link">Logout</a></button>
                    </div>    
                </div>
            </div>
        </div>
        
      <section>
      <div class="container-fluid" id="notification">
        <h5 class="bg-title">Notifikasi</h5>
        <?php foreach ($user as $row): ?>
                  <div class="notification submitted" id="submittedNotification">
                    <i class="fa-regular fa-clock fa-2xl" style="color: #000000;"></i>
                    <p class="notifSubmittedMessage">Halo, <?= $row["nama_pengaju"]; ?>! Pengajuan peminjaman ruang <?= $row["nama_ruang"]; ?>
                    pada <?= getHari($row["tgl_awal"]); ?>, <?= date("d", strtotime($row["tgl_awal"])); ?> <?= getBulan($row["tgl_awal"]); ?> <?= date("Y", strtotime($row["tgl_awal"])); ?> pukul <?= date("H.i", strtotime($row["waktu"])); ?> WIB berhasil dikirim. Mohon menunggu proses validasi.</p>
                  </div> 
            <?php if ($row["status"] == 'DITERIMA'): ?>
                <div class="notification accepted" id="acceptedNotification">
                    <i class="fa-solid fa-check fa-2xl" style="color: #000000;"></i>
                    <p class="notifAcceptedMessage">
                        Halo, <?= $row["nama_pengaju"]; ?>! Pengajuan peminjaman ruang <?= $row["nama_ruang"]; ?>
                        pada <?= getHari($row["tgl_awal"]); ?>, <?= date("d", strtotime($row["tgl_awal"])); ?> <?= getBulan($row["tgl_awal"]); ?> <?= date("Y", strtotime($row["tgl_awal"])); ?> pukul <?= date("H.i", strtotime($row["waktu"])); ?> WIB disetujui.
                        Detail ajuan dapat dilihat di <a class="customLinkSuccess" type="button" data-bs-toggle="modal" data-bs-target="#modalDetail">sini</a>.
                    </p>
                </div>
                 <!-- Modal -->
                <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-5" style="background-color:#c9efff">
                      <?php
                        echo 
                          '<div class="container-fluid text-center bg-table-color" id="detailAjuan">
                            <h5 style="font-weight:bolder;">Data Ajuan</h5>
                            <div class="text-start" style="font-size:16px">
                              <table class="table bg-table-color">
                                <tr class="bg-table-color">
                                    <th scope="col">Nama Pengaju</th>
                                    <th scope="col"> : ' .$row["nama_pengaju"]. '</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">NIM/NIP</th>
                                    <th scope="col"> : ' .$row["nim_nip"]. '</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">Status</th>
                                    <th scope="col"> : ' .$row["statusUser"]. '</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">Nama Ruang</th>
                                    <th scope="col"> : ' .$row["nama_ruang"]. '</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">Tanggal</th>
                                    <th scope="col"> : ' . getHari($row["tgl_awal"]). ', ' .date("d", strtotime($row["tgl_awal"])). ' ' .getBulan($row["tgl_awal"]). ' ' .date("Y", strtotime($row["tgl_awal"])). '</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">Waktu</th>
                                    <th scope="col"> : ' .date("H.i", strtotime($row["waktu"])). ' WIB</th>
                                </tr>
                                <tr class="bg-table-color">
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col"> : ' .$row["kegiatan"]. '</th>
                                </tr>
                              </table>
                            </div>
                          </div>'
                      ?>
                    </div>
                  </div>
                </div>
            <?php elseif ($row["status"] == 'DITOLAK'): ?>
                <div class="notification rejected" id="rejectedNotification">
                    <i class="fa-solid fa-xmark fa-2xl" style="color: #000000;"></i>
                    <p class="notifRejectedMessage">
                        Halo, <?= $row["nama_pengaju"]; ?>! Pengajuan peminjaman ruang <?= $row["nama_ruang"]; ?>
                        pada <?= getHari($row["tgl_awal"]); ?>, <?= date("d", strtotime($row["tgl_awal"])); ?> <?= getBulan($row["tgl_awal"]); ?> <?= date("Y", strtotime($row["tgl_awal"])); ?> pukul <?= date("H.i", strtotime($row["waktu"])); ?> WIB tidak disetujui.
                    </p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
      <!-- Notif setelah submit formulir pengajuan -->
    </div>
      </section>

      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

      <script>
        // Mendapatkan nilai parameter 'status' dari URL
        // $status = $_POST['status'];

        // if (status === 'TERKIRIM') {
        //   showSubmittedNotification(); // Panggil fungsi notifikasi sukses
        // }

        // Ambil referensi notifikasi
        // Fungsi menampilkan notif
        // var submittedNotification = document.getElementById("submittedNotification");
        // function showSubmittedNotification() {
        //   submittedNotification.classList.remove("hidden");
        // }

        // // Fungsi untuk mendapatkan nilai parameter URL berdasarkan nama
        // function getParameterByName(name) {
        //   var url = window.location.href;
        //   name = name.replace(/[\[\]]/g, "\\$&");
        //   var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        //     results = regex.exec(url);
        //   if (!results) return null;
        //   if (!results[2]) return "";
        //   return decodeURIComponent(results[2].replace(/\+/g, " "));
        // }

        // // Baca nilai parameter URL dengan nama 'status'
        // var status = getParameterByName("status");

        // // Cek nilai parameter URL untuk menentukan tindakan selanjutnya
        // if (status === "submitted") {
        //   showSubmittedNotification(); // Panggil fungsi notifikasi sukses
        // }
      </script>

    </body>
</html>