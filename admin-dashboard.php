<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'functions.php';
$id = $_GET["id"];
//query data mahasiswa berdasar id
$data = "SELECT * FROM admin WHERE id = $id";
$user = query($data);

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
            height: 63px;
            border-right : 1px solid black;
            margin-left: 10px;
            margin-right: 12px;
        }

        .navbar-title h1 {
            font-weight: bolder;
            font-size: 20px;
            padding-top: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .nav-link {
            display: flex;
            align-items: center;
        }


        #logo{
            width: 130px;
            height: 61px;
            align-items: center;
        }

        .fa-house-chimney{
            margin-right: 0.38cm;
        }

        .fa-users{
            margin-right: 0.44cm;
        }
        
        .fa-box-archive{
            margin-right: 0.56cm;
        }

        .fa-door-open{
            margin-right: 0.5cm;
        }
        .fa-calendar{
            margin-right: 0.65cm;
        }

        .fa-file{
            margin-right: 0.65cm;
        }

        .fa-arrow-right-from-bracket{
            margin-right: 0.5cm;
        }

        .logo {
            padding: 10px;
            margin-left: 10px;
            margin-bottom: 50px;
        }

        hr {
            margin-top: 125px;
        }

        .admin-text{
            text-align: right;
        }
        .dashboard-text{
            margin-top: 100px;
            margin-left: 100px;
            margin-bottom: 50px;
        }

        .konten {
            margin-left: 93px;
        }

        .card {
            background-color: #c9efff;
        }

        
      </style>
      
      <title> PinjamRuang FATISDA </title>
    </head>
    <body>

        <div class="row">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-lg-3 p-3 min-vh-100 d-flex flex-column justify-content-between" style="position: fixed; background-color: #c9efff; border-radius: 0 50px 50px 0;">
                        <div class="p-2" style="background-color: #c9efff; border-radius: 0 50px 50px 0;">
                            <div class=" logo nav nav-pills flex-row mt-4">
                                <div class="nav-item py-2 py-sm-0">
                                    <a><img src="logouns.png" alt="Logo" id="logo"></a>
                                </div>
                                <div class="navbar-divider"></div>
                                <div class="navbar-title"><h1>PinjamRuang<br>FATISDA</h1></div>
                            </div>
                            <ul class="samping nav nav-pills flex-column mt-5">
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-dashboard.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-house-chimney fa-xl" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-data-user.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-users fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Data User</span>
                                    </a>
                                </li>
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-data-pengajuan.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-box-archive fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Data Pengajuan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-data-ruang.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-door-open fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Data Ruangan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-data-jadwal-ruang.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-calendar fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Jadwal Ruangan</span>
                                    </a>
                                </li>
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a href="admin-data-laporan-pinjam.php?id=<?= $id; ?>" class="nav-link text-white">
                                        <i class="fa-solid fa-file fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Laporan Peminjaman Ruangan</span>
                                    </a>
                                </li>
                                <hr style="text-align:left; margin-left:20px; margin-right:20px; margin-top:10px;">
                                <li class="nav-item py-1 py-sm-0 px-2">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalLogout" class="nav-link text-white" class="nav-link text-white">
                                        <i class="fa-solid fa-arrow-right-from-bracket fa-lg" style="color: #000000;"></i>
                                        <span class="fs-5 d-none d-sm-inline">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto col-sm-9 p-5 min-vh-100 d-flex flex-column justify-content-between" style="margin-left:320px; border-radius: 0 50px 50px 0;">
                        <div>
                            <h5 class="admin-text">Admin</h5>
                                <div class="dashboard-text">
                                    <h1><strong>Dashboard</strong></h1>
                                </div>
                                <div class="konten row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                      <div class="card" style="border-radius: 40px; width: 90%;">
                                        <div class="card-body d-flex">
                                            <div class="position-relative" style="padding:60px; background-color: #71d4ff; border-radius: 30px;">
                                                <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-check fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                                            </div>
                                            <a href="admin-data-pengajuan.php?id=<?= $id; ?>" class="position-absolute top-50 start-50 translate-middle card-desc text-center mx-5 mt-2" style="text-decoration: none;">
                                                <h3><strong>Validasi</strong></h3>
                                                <!-- <h1><strong>3</strong></h1> -->
                                            </a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="card" style="border-radius: 40px; width: 90%;">
                                            <div class="card-body d-flex">
                                              <div class="position-relative" style="padding:60px; background-color: #71d4ff; border-radius: 30px;">
                                                <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-calendar fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                                            </div>
                                              <a href="admin-data-jadwal-ruang.php?id=<?= $id; ?>" class="position-absolute top-50 start-50 translate-middle card-desc text-center mx-5 mt-2" style="text-decoration: none;">
                                                <h3><strong>Jadwal Ruangan</strong></h3>
                                              </a>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-sm-6 mt-3 mb-3 mb-sm-0">
                                        <div class="card" style="border-radius: 40px; width: 90%;">
                                          <div class="card-body d-flex">
                                              <div class="position-relative" style="padding:60px; background-color: #71d4ff; border-radius: 30px;">
                                                  <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-door-open fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                                              </div>
                                              <a href="admin-data-ruang.php?id=<?= $id; ?>" class="position-absolute top-50 start-50 translate-middle card-desc text-center mx-5 mt-2" style="text-decoration: none;">
                                                  <h3><strong>Data Ruangan</strong></h3>
                                              </a>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6 mt-3 mb-3 mb-sm-0">
                                          <div class="card" style="border-radius: 40px; width: 90%;">
                                              <div class="card-body d-flex">
                                                <div class="position-relative" style="padding:60px; background-color: #71d4ff; border-radius: 30px;">
                                                  <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-users fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                                              </div>
                                                <a href="admin-data-user.php?id=<?= $id; ?>" class="position-absolute top-50 start-50 translate-middle card-desc text-center mx-5 mt-2" style="text-decoration: none;">
                                                  <h3><strong>Data User</strong></h3>
                                                </a>
                                              </div>
                                            </div>
                                      </div>
                                      <div class="col-sm-6 mt-3 mb-3 mb-sm-0">
                                          <div class="card" style="border-radius: 40px; width: 90%;">
                                              <div class="card-body d-flex">
                                                <div class="position-relative" style="padding:60px; background-color: #71d4ff; border-radius: 30px;">
                                                  <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-file fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                                              </div>
                                                <a href="admin-data-laporan-pinjam.php?id=<?= $id; ?>" class="position-absolute top-50 start-50 translate-middle card-desc text-center mx-5 mt-2" style="text-decoration: none;">
                                                  <h3><strong>Laporan Peminjaman Ruangan</strong></h3>
                                                </a>
                                              </div>
                                            </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal Logout -->
        <div class="modal custom-modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-5" style="background-color:#c9efff; border-radius:40px; align-items: center; justify-items: center;">
                    <h1 class="modal-title fs-5" style="font-weight: bolder;" id="staticBackdropLabel">Apakah Anda yakin untuk logout?</h1>
                    <div class="mt-4">
                        <button type="button" class="btn mx-2" style="padding-right:40px; padding-left:40px; border-radius:40px; background-color: white; border-color: #71d4ff; color:black" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn mx-2" style="padding-right:40px; padding-left:40px; border-radius:40px; background-color: #71d4ff; color:black"><a href="admin-logout.php?id=<?= $id; ?>" class="nav-link">Logout</a></button>
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