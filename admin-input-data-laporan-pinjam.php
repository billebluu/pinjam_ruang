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

    if(isset($_POST["submit"])){
        //
        if(inputLaporan($_POST) > 0){
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalSuccessAddData'));
                modal.show();
                setTimeout(function() {
                    window.location.href = 'admin-data-laporan-pinjam.php?id=$id';
                }, 2000);
            });
            </script>";
        }else{
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalFailAddData'));
                modal.show();
            });
            </script>";
        }
    }
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
        .data-text{
            margin-top: 80px;
            margin-left: 40px;
            margin-bottom: 50px;
        }

        .konten {
            margin-left: 93px;
        }

        .card {
            background-color: #c9efff;
        }

        .button-search{
       font-family: 'Montserrat',sans-serif; 
       font-size: 90%; 
       color: rgb(0, 0, 0);
       border-radius: 23px; 
       padding: 7px 25px;
       background-color: rgb(201,239,255); 
       border-color: rgb(201,239,255);
        }
        .button-action{
       font-family: 'Montserrat',sans-serif; 
       font-size: 90%; 
       color: rgb(0, 0, 0);
       border-radius: 23px; 
       padding: 7px 25px;
       background-color: rgb(201,239,255); 
       border-color: rgb(201,239,255);
       margin-left: 480px;
        }
        .button-data{
            border-radius: 25px;
            background-color: rgb(0, 0, 0);
            border-color: black;
            color: white;
            font-family: 'Montserrat',sans-serif;
            font-size: 90%;
            padding: 8px 35px;
        }
        .button-container {
      display: flex;
      flex-direction: row;
    }

    .button-container button {
      margin-right: 10px;
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
                            <h5 class="admin-text"><strong>Admin</strong></h5>
                                <div class="data-text">
                                    <h1><strong>DLaporan Peminjaman Ruang</strong></h1>
                                    <br>
                                    <div class="col-auto min-vh-100 d-flex flex-column justify-content-between">
                                        <section>
                                            <div class="container-profile" align="left">
                                                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                                                <div class="col-md-5">
                                                        <label for="nama_pengaju" class="form-label">Nama Pengaju</label>
                                                        <input type="text" class="form-control" name="nama_pengaju"  id="nama_pengaju" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="nama_ruang" class="form-label">Ruang</label>
                                                        <input type="text" class="form-control" id="nama_ruang"  name="nama_ruang" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email"  name="email" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                                        <input type="text" class="form-control" id="kegiatan"  name="kegiatan" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="phone" class="form-label">No. Telephone</label>
                                                        <input type="text" class="form-control" id="phone"  name="phone" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="waktu" class="form-label">Waktu</label>
                                                        <input type="time" class="form-control" id="waktu"  name="waktu" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="nim_nip" class="form-label">NIM/NIP</label>
                                                        <input type="text" class="form-control" id="nim_nip"  name="nim_nip" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="tgl_awal" class="form-label">Tanggal Awal Peminjaman</label>
                                                        <input type="date" class="form-control" id="tgl_awal"  name="tgl_awal" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="tgl_akhir" class="form-label">Tanggal Akhir Peminjaman</label>
                                                        <input type="date" class="form-control" id="tgl_akhir"  name="tgl_akhir" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="peralatan" class="form-label">Peralatan</label>
                                                        <input type="textarea" class="form-control" id="peralatan"  name="peralatan" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="berkas" class="form-label">Berkas</label>
                                                        <input type="file" class="form-control" id="berkas"  name="berkas" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <br><br>
                                                        <!-- type="submit" name="submit" -->
                                                        <button type="submit" name="submit" class="button-data">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                          </section>
                                        </div>
                                </div>
                        </div></div></div></div></div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Sukses Add Data -->
        <div class="modal fade" id="modalSuccessAddData" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" data-bs-dismiss="modal">
                <div class="modal-content p-4 d-flex flex-row" style="background-color:#c9efff; border-radius:30px; align-items: center; justify-items: center;">
                    <div class="position-relative" style="padding:50px; background-color: #71d4ff; border-radius: 30px;">
                        <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-check fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                    </div>
                    <div class="flex-column">
                        <div>
                            <h1 class="mx-4 fs-5 text-center" style="font-weight: bolder;" id="staticBackdropLabel">Data Laporan Peminjaman Baru Berhasil Ditambahkan!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Gagal Add Data -->
        <div class="modal fade" id="modalFailAddData" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" data-bs-dismiss="modal">
                <div class="modal-content p-4 d-flex flex-row" style="background-color:#c9efff; border-radius:30px; align-items: center; justify-items: center;">
                    <div class="position-relative" style="padding:50px; background-color: #71d4ff; border-radius: 30px;">
                        <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-xmark fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                    </div>
                    <div class="flex-column">
                        <div>
                            <h1 class="mx-4 fs-5 text-center" style="font-weight: bolder;" id="staticBackdropLabel">Data Laporan Peminjaman Baru Gagal Ditambahkan!</h1>
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