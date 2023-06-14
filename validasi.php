<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'functions.php';


?>
<!DOCTYPE html>
<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
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

        .navbar-divider {
            height: 65px;
            border-right : 1px solid black;
            margin-left: 10px;
            margin-right: 10px;
        }

        .navbar-title h1 {
            font-weight: bolder;
            font-size: 24px;
            margin-top: 4px;
        }

        .sidenavbar{
            margin-top: 30px;
            margin-left: 20px;
        }

        #logo{
            width: 150px;
            height: 70px;
        }

      </style>
      
      <title> PinjamRuang FATISDA </title>
    </head>
    <body>
        <nav>
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col-auto col-md-4 col-lg-3 min-vh-100 d-flex flex-column justify-content-between" style="background-color: rgb(201,239,255); border-radius: 50px;">
                        <div class="p-2" style="background-color: rgb(201,239,255); border-radius: 50px;">
                            <div class="sidenavbar d-flex">
                                <div class="navbar-brand logo">
                                    <a><img src="logouns.png" alt="Logo" id="logo"></a>
                                </div>
                                <div class="navbar-divider"></div>
                                <div class="navbar-title"><h1>PinjamRuang<br>Fatisda</h1></div>    
                            </div>
                            <ul class="nav nav-pills flex-column mt-4">
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="admin-home.php" class="nav-link text-white">
                                        <i class="fa-solid fa-house-chimney fa-xl" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="data-user.php" class="nav-link text-white">
                                        <i class="fa-solid fa-user fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Data User</span>
                                    </a>
                                </li>
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="data-pengajuan-ruangan.php" class="nav-link text-white">
                                        <i class="fa-solid fa-box-archive fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Data Pengajuan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="data-ruangan.php" class="nav-link text-white">
                                        <i class="fa-solid fa-door-open fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Data Ruangan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="data-jadwal-ruang.php" class="nav-link text-white">
                                        <i class="fa-solid fa-calendar fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Jadwal Ruangan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="admin-laporan-pinjam.html" class="nav-link text-white">
                                        <i class="fa-solid fa-file fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2">Laporan Peminjaman Ruangan</span>
                                    </a>
                                </li>
                                <hr style="text-align:left; margin-left:20px; margin-right:20px">
                                <li class="nav-item py-2 py-sm-0 px-2">
                                    <a href="login.html" class="nav-link text-white">
                                        <i class="fa-solid fa-arrow-right-from-bracket fa-lg" style="color: #000000;"></i>
                                        <span class="fs-4 d-none d-sm-inline px-2" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

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


      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </body>
</html>