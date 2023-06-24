<?php
    session_start();
    if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
    }

    require 'functions.php';
    $id = $_GET["id"];
    $data = "SELECT * FROM user WHERE id = $id";
    $user = query($data)[0];

    $data2 = query("SELECT * FROM data_ruangan");
    
    $showSucces = true;
    $showDanger = true;
    $showSubmit;

    $data_jadwal = query('SELECT * FROM data_jadwal');

    //tombol search ditekan
    if(isset($_POST["search"])){
        $result = cekKetersediaan($_POST["keyword1"],$_POST["keyword2"],$_POST["keyword3"],$_POST["keyword4"]);
        if ($result > 0) {
            $showSubmit = 1; // Jika berhasil, set $showSubmit menjadi 1
            // echo "
            // <script>
            //     var xhr = new XMLHttpRequest();
            //     xhr.open('POST', 'user-notifikasi.php', true);
            //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            //     xhr.send('status=TERKIRIM');
            // </script>
            // ";
        }else if($result == 0) {
            $showSubmit = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="icon" type="image/ico" href="logo2.png">

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

        .bg-title, h5{
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

        .alert-danger {
          display: none;
        }

        .alert-success {
          display: none;
        }
        .button-action{
       font-family: 'Montserrat',sans-serif; 
       font-size: 90%; 
       color: rgb(0, 0, 0);
       border-radius: 23px; 
       padding: 7px 25px;
       background-color: rgb(201,239,255); 
       border-color: rgb(201,239,255);
       /* margin-left: 5px; */
        }
    </style>

    <title>PinjamRuang Fatisda</title>
</head>
<body>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const showSubmit = <?php echo $showSubmit; ?>;
            const alertSubmitFail = document.querySelector('.alert-submit-fail');
            const alertUnavailableRoom = document.querySelector('.alert-unavailable-room');
            const alertSubmitSuccess = document.querySelector('.alert-submit-success');
            const buttonForm = document.querySelector('#buttonForm');

            if (showSubmit === 0) {
                alertSubmitFail.style.display = 'block';
            } else if (showSubmit === 1) {
                alertSubmitSuccess.style.display = 'block';
                buttonForm.style.display = 'block';
            } else if (showSubmit === 2) {
                alertUnavailableRoom.style.display = 'block';
            }
        });
    </script>
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
            <h5 class=bg-title>Cek Ketersediaan Ruang</h5>

            <!--Alert Notifikasi Submit Form-->
            <div class="alert alert-danger alert-submit-fail alert-dismissible mt-4" id="myAlertFail" <?php if ($showSubmit != 0) { echo 'style="display: none;"'; } ?>>
                Formulir peminjaman ruang gagal dikirim. Silakan periksa kembali data isian Anda!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- alert baru -->
            <div class="alert alert-danger alert-unavailable-room alert-dismissible mt-4" id="myAlertFail2" <?php if ($showSubmit != 2) { echo 'style="display: none;"'; } ?>>
                Ruang yang Anda pilih pada waktu tersebut sudah terisi. Silakan cek ruangan lain!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="alert alert-success alert-submit-success alert-dismissible mt-4" id="myAlertSuccess" <?php if ($showSubmit != 1) { echo 'style="display: none;"'; } ?>>
                Ruang yang Anda pilih pada waktu tersebut belum terisi. Silakan isi formulir peminjaman ruang!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            
            
            <form class="row needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
            <div class="col">
                <div class="col mb-3">
                    <label for="waktu_awal" class="form-label">Waktu Awal</label>
                    <input type="time" name="keyword3" id="waktu_awal" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="waktu_akhir" class="form-label">Waktu Akhir</label>
                    <input type="time" name="keyword4" id="waktu_akhir" class="form-control" required>
                </div>
                <button class="btn btn-dark col mb-3 mt-4" type="submit" name="search">Cek</button>
                <div class="button button-form" id="buttonForm" style="display: none;">
                <button class="btn btn-dark col mb-3 mt-4">
                    <a class="nav-link" href="user-pinjam-ruang.php?id=<?= $id; ?>">Isi Form Pinjam Ruang</a>
                </button>
            </div>
            </div>
            <div class="col">
                <div class="col mb-3">
                    <label for="phone" class="form-label">Nama Ruang</label>
                    <select class="form-select form-select-md" aria-label=".form-select-lg example" id="nama_ruang" name="keyword1">
                        <option selected></option>
                        <?php foreach ($data2 as $row) : ?>
                            <option value="<?php echo $row['nama_ruang']; ?>"><?php echo $row['nama_ruang']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="tanggal" class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="keyword2" id="tanggal" class="form-control" required>
                </div>
            </div>
        </form>
        </div>
    </section>
    
    <script>
    $(document).ready(function() {
        $(".alert").hide(); // Hide all alert elements
        $(".button-form").hide(); // Hide all alert elements

        <?php if ($showSubmit == 0) { ?>
            $(".alert-submit-fail").show(); // Show the alert-danger
        <?php } elseif ($showSubmit == 1) { ?>
            $(".alert-submit-success").show(); // Show the alert-success
            $(".button-form").show(); // Show the alert-success
        <?php } elseif ($showSubmit == 2) { ?>
            $(".alert-unavailable-room").show(); // Show the alert-unavailable-room
        <?php } ?>
    });
</script>


    <!-- <script>
        $(document).ready(function () {
           
        }

        )
    </script> -->
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