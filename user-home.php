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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User - PinjamRuang FATISDA</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
</head>
<style>
    *{
      font-family: 'Montserrat', sans-serif;
      color: black;
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
    body {
      margin: 0;
      padding: 0;
      background-image: url('bg-home-user.png');
      background-repeat: no-repeat;
      background-size: 50% auto;
      background-position: top;
    }
    .content {
      height: 70vh;
      background-color: rgb(217,217,217);
      text-align: center;
      padding: 20px;
    }
    .admin-login{
      border-radius: 25px;
      background-color: white;
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 120%;
      padding: 10px 20px;
    }
    .user-login{
      border-radius: 25px;
      background-color: rgb(0, 0, 0);
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 120%;
      padding: 10px 20px;
    }
    .user-home{
      border-radius: 15px;
      background-color: rgb(0, 0, 0);
      border-color: black;
      color: white;
      font-family: 'Montserrat',sans-serif;
      font-size: 140%;
      padding: 20px 35px;
    }
    .container {
      width: 100%;
      max-width: 2000px;
      margin: 0 auto;
      padding: 10px 5px;
      font-family: 'Montserrat',sans-serif;
    }
    @media screen and (max-width: 600px) {
      .container {
        padding: 10px;
      }
    }
    form{
        border-radius: 10px;
        border-color: white;
        font-family: 'Montserrat',sans-serif;
        background-color: white;
    }
    .container-button{
        text-align: center;
        align-items: center;
        margin: 10px;
    }
</style>
<body>
    <div class="content" style="background-color: rgb(217,217,217);">
    <div class="container" style="background-color: rgb(217,217,217);">
      <header style="background-color: rgb(217,217,217);">
        <nav class="navbar navbar-expand-lg" style="background-color: rgb(217,217,217);">
          <div class="container-fluid" style="background-color: rgb(217,217,217);">
            <div class="navbar-brand logo" style="background-color: rgb(217,217,217);">
              <a style="background-color: rgb(217,217,217);"><img src="logouns.png" style="background-color: rgb(217,217,217);" width="150px" height="70px" alt="Logo" id="logo"></a>
            </div>
            <div class="navbar-divider" style="background-color: rgb(217,217,217);"></div>
            <div class="navbar-title" style="background-color: rgb(217,217,217);"><h1 style="background-color: rgb(217,217,217);">PinjamRuang<br>FATISDA</h1></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" style="background-color: rgb(217,217,217);" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon" style="background-color: rgb(217,217,217);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="background-color: rgb(217,217,217);">
              <ul class="navbar-nav" style="background-color: rgb(217,217,217);">
                <li class="nav-item custom-nav-item" style="background-color: rgb(217,217,217);">
                  <a class="nav-link active" aria-current="page" href="user-home.php?id=<?= $id; ?>" style="background-color: rgb(217,217,217);">Home</a>
                </li>
                <li class="nav-item dropdown" style="background-color: rgb(217,217,217);">
                  <a class="nav-link dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" style="background-color: rgb(217,217,217);" href="#" role="button" aria-expanded="false"><?= $user['nama'] ?></a>
                  <ul class="dropdown-menu" style="background-color: rgb(217,217,217);">
                    <li><a class="dropdown-item" style="background-color: rgb(217,217,217);" href="user-profile.php?id=<?= $id; ?>">Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" style="background-color: rgb(217,217,217);" type="button" data-bs-toggle="modal" data-bs-target="#modalLogout" class="nav-link text-white" class="nav-link text-white">Logout</a></li>
                  </ul>
              </ul>
            </div>
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
          </div>
        </nav>
      </header></div></div>
        <br><br>
            <div class="container-button">
              <button type="button" class="user-home"><a class="nav-link" href="user-jadwal-ruang.php?id=<?= $id; ?>" style="color: #ffffff; background-color: black;">Jadwal Ruang</a></button>
              <button type="button" class="user-home"><a class="nav-link" href="user-pinjam-ruang.php?id=<?= $id; ?>" style="color: #ffffff; background-color: black;">Pinjam Ruang</a></button>
              <button type="button" class="user-home"><a class="nav-link" href="user-notifikasi.php?id=<?= $id; ?>" style="color: #ffffff; background-color: black;">Notifikasi</a></button>
            </div>
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