<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'functions.php';
$id = $_GET["id"];
//query data mahasiswa berdasar id
$data = "SELECT * FROM user WHERE id = $id";
$user = query($data)[0];

$data_jadwal = query('SELECT * FROM data_jadwal');

    //tombol search ditekan
    if(isset($_POST["search"])){
        $data_jadwal = searchJadwalUser($_POST["keyword1"],$_POST["keyword2"]);
    }

?>


<!DOCTYPE html>
<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="styling.css" rel="stylesheet" type="text/css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
      <title> PinjamRuang FATISDA </title>
    </head>
    <style>
    *{
        font-family: 'Montserrat', sans-serif;
        color: black;
    }
    .user-jadwal{
      border-radius: 25px;
      background-color: rgb(0, 0, 0);
      border-color: black;
      color: white;
      font-family: 'Montserrat',sans-serif;
      font-size: 90%;
      padding: 8px 40px;
    }
    .navbar-divider {
        height: 65px;
        border-right : 1px solid black;
        margin-right: 20px;
    }
    
    .navbar-title h1 {
        font-weight: bolder;
        font-size: 24px;
    }
    
    .navbar-nav, li{
        font-weight: bolder;
    }
    
    .custom-nav-item{
        padding-right: 50px;
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
    
    form{
        padding-top: 10px;
    }
    
    input[type="datetime-local"] {
        /* Atur warna latar belakang dan warna teks */
        background-color: #f2f2f2;
        color: #333;
    
        /* Atur padding dan margin */
        padding: 10px;
        margin-bottom: 10px;
    
        /* Atur ukuran font */
        font-size: 14px;
    
        /* Atur border dan border-radius */
        border: 1px solid #ccc;
        border-radius: 4px;
    
        /* Atur lebar elemen input */
        width: 50%;
    
        /* Atur tampilan saat elemen tidak aktif */
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    .btn{
        border-radius: 20px;
        padding-left: 30px;
        padding-right: 30px
    }
    
    #logo{
        width: 150px;
        height: 70px;
    }
    
    .bgtitle{
        font-weight: bolder;
        background-color: #c9efff;
        padding: 10px;
    }
    
    .input-group-text{
        align-items: center !;
    }
    
    .input-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }
    
    .input-container label {
        margin-right: 10px;
    }
    
    </style>
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
                  <a class="nav-link dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $user['nama'] ?></a>
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
        <div class="container-fluid">
          <h5 class=bgtitle>Jadwal Penggunaan Ruang</h5>
   
          <form action="" method="POST">
            <div class="row mb-3">
              <label for="nama_ruang" class="col-sm-2 col-form-label">Nama Ruang</label>
              <div class="col-sm-4">
                <input type="text" name="keyword1" size="20" autofocus autocomplete="off" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
              <div class="col-sm-4">
                <input type="date" name="keyword2" size="20" autofocus autocomplete="off" class="form-control">
              </div>
            </div>
            <button type="submit" name="search" class="user-jadwal"><a class="nav-link" style="color: #ffffff; background-color: black;">Cek</a></button>
          </form>
          <br>
          <table class="table table-hover" style="text-align: center;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Ruang</th>
                <th scope="col">Hari</th>
                <th scope="col">Waktu Awal</th>
                <th scope="col">Waktu Akhir</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Penyelenggara</th>
              </tr>
            </thead>
            <tbody class="table table-hover" style="text-align: center;">
              <tr>
              <?php $i = 1;?>
              <?php foreach ($data_jadwal as $row): ?>
              <td><?= $i; ?></td>
              <td><?= $row["nama_ruang"]; ?></td>
              <td><?= getHari($row["tanggal"]) ?></td>
              <td><?= date("H:i", strtotime($row["waktu_awal"])); ?></td>
              <td><?= date("H:i", strtotime($row["waktu_akhir"])); ?></td>
              <td><?= date("d-m-Y", strtotime($row["tanggal"])); ?></td>
              <td><?= $row["kegiatan"]; ?></td>
              <td><?= $row["penyelenggara"]; ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </table>
          
        </div>
      </section>

      <!-- JavaScript -->
      <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script>
        function skematik_jquery_js(){
            wp_enqueue_script('jquery');
        }

        function wpt_register_js() {
            wp_register_script(
                'jquery.bootstrap.min', 
                get_template_directory_uri() . '/js/bootstrap.min.js', 
                'jquery'
            );
            wp_enqueue_script('jquery.bootstrap.min');
        }

        /* Load Scripts */
        add_action( 'wp_enqueue_scripts', 'skematik_jquery_js' );
        add_action( 'wp_enqueue_scripts', 'wpt_register_js' );

        function wpt_register_css() {
            wp_register_style(
                'bootstrap.min', 
                get_template_directory_uri() . '/css/bootstrap.min.css'
            );
            wp_enqueue_style( 'bootstrap.min' );
        }
        add_action( 'wp_enqueue_scripts', 'wpt_register_css' );
      </script>
    </body>
</html>
