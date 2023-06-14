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
   $user2 = query("SELECT * FROM user WHERE id=$id")[0];
   $showAlert = 0;

// tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek data ada yang diubah atau tidak
    if (ubahUser($_POST) > 0) {
        $showAlert = 1;
    } else {
        $showAlert = 2;
    }
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
            background-color: white;
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
        
        .notifSuccessDatetime{
            padding-top: 20px;
            padding-left: 60px;
            width: 20%;
            background-color: #dff0d8;
        }

        .notifSuccessMessage{
            padding-top: 20px;
            padding-left: 20px;
            background-color: #dff0d8;
        }

        .notifFailDatetime{
            padding-top: 20px;
            padding-left: 60px;
            width: 20%;
            background-color: #f8d7da;
        }

        .notifFailMessage{
            padding-top: 20px;
            padding-left: 20px;
            background-color: #f8d7da;
        }

        .notifSubmitDatetime{
            padding-top: 20px;
            padding-left: 60px;
            width: 20%;
            background-color: #f2f2f2;
        }

        .notifSubmitMessage{
            padding-top: 20px;
            padding-left: 20px;
            background-color: #f2f2f2;

        }

        .customLinkSuccess{
            text-decoration: underline;
            background-color: #dff0d8;
            color:#000000;
        }

        .success{
            background-color: #dff0d8;
        }

        .fail{
            background-color: #f8d7da;
        }

        .submit{
            background-color: #f2f2f2;
        }

        .hidden{
            display: none;
        }
        .user-profile{
            border-radius: 25px;
            background-color: rgb(0, 0, 0);
            border-color: black;
            color: white;
            font-family: 'Montserrat',sans-serif;
            font-size: 90%;
            padding: 8px 35px;
        }
        .container-profile{
            margin-left: 120px;
            font-family: 'Montserrat',sans-serif; 
            font-size: 90%; 
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
      <br>

      
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
      <div class="container-profile">
                <h3 style="background-color: white;"><b>Profil Anda</b></h3><br>
                <!-- Alert Gagal Login -->
                <?php if ($showAlert == 1) : ?>
                    <div class="alert alert-success alert-dismissible" style="margin-right:220px;" id="myAlertSuccess">
                        Data berhasil diperbarui.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php echo "<script>
                        setTimeout(function() {
                        window.location.href = 'user-profile.php?id=$id';
                    }, 2000);
                    </script>"; ?>
                <?php elseif($showAlert == 2) : ?>
                    <div class="alert alert-danger alert-dismissible" style="margin-right:220px;" id="myAlertFail">
                        Data tidak dapat diperbarui. Periksa kembali data isian Anda!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form class="row" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                    <div class="col-md-5">
                        <label for="email" class="form-label">Email*</label>
                        <input type="text" class="form-control mb-3" name="email"  id="email" value="<?php echo $user2['email'] ?>" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control mb-3" id="phone" name="phone" value="<?php echo $user2['phone'] ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="nama" class="form-label">Nama*</label>
                        <input type="text" class="form-control mb-3" id="nama"  name="nama" value="<?php echo $user2['nama'] ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="statusUser" class="form-label">Status</label>
                        <input type="text" class="form-control mb-3" id="statusUser"  name="statusUser" value="<?php echo $user2['statusUser'] ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control mb-3" id="gender"  name="gender" value="<?php echo $user2['gender'] ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="nim_nip" class="form-label">NIM/NIP</label>
                        <input type="text" class="form-control mb-3" id="nim_nip"  name="nim_nip" value="<?php echo $user2['nim_nip'] ?>" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="submit" class="user-profile mt-4">Simpan</button>
                    </div>
                </form>
                
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