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

    $data2 = query("SELECT nama_ruang FROM data_ruangan WHERE NOT EXISTS (SELECT 1 FROM data_jadwal WHERE data_ruangan.nama_ruang = data_jadwal.nama_ruang)");

    $showSucces = true;
    $showDanger = true;
    $showSubmit;

    if (isset($_POST["submit"])) {
        $showSubmit = 0; // Inisialisasi $showSubmit dengan nilai 0
    
        if (isset($_POST['nama_pengaju'], $_POST['nama_ruang'], $_POST['email'], $_POST['kegiatan'], $_POST['phone'], $_POST['waktu'], $_POST['nim_nip'], $_POST['tgl_awal'], $_POST['tgl_akhir'], $_POST['gender'], $_POST['statusUser'])) {
            // Cek apakah semua input yang diperlukan diisi
            $id = $id; // Ganti dengan nilai id yang sesuai
            $result = tambah($_POST, $id);
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
            }
        }
    
        if ($showSubmit == 0) {
            $showSubmit = 0; // Jika gagal, tetapkan $showSubmit menjadi 0
        }
    }
    // if(isset($_POST["submit"])){
    //     // var_dump($_POST);
    //     // echo "<br>";
    //     // var_dump($FILE);
    //     // die;

    //     if(tambah($_POST, $id) < $id){
    //         $showSubmit = 1;

    //         echo "
    //         <script>
    //             var xhr = new XMLHttpRequest();
    //             xhr.open('POST', 'user-notifikasi.php', true);
    //             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //             xhr.send('status=TERKIRIM');
    //         </script>
    //         ";
    //         // //Mengirimkan parameter status='TERKIRIM'
    //         // $params = $_GET; // Mendapatkan parameter yang ada dalam URL saat ini
    //         // $params['status'] = 'TERKIRIM'; // Menambahkan parameter 'status' dengan nilai 'TERKIRIM'

    //         // $newUrl = $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
    //         // header("Location: $newUrl");
    //         // exit();

    //     }else{
    //         $showSubmit = 0;
    //     }
    // }
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
            <h5 class=bg-title>Formulir Peminjaman Ruang</h5>

            <!--Alert Notifikasi Submit Form-->
            <div class="alert alert-danger alert-dismissible mt-4" id="myAlertFail">
                Formulir peminjaman ruang gagal dikirim. Silakan periksa kembali data isian Anda!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="alert alert-success alert-dismissible mt-4" id="myAlertSuccess">
                Formulir peminjaman ruang berhasil dikirim.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <form class="row needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
            <div class="col">
                <div class="col mb-3">
                    <label for="nama_pengaju" class="form-label">Nama Pengaju</label>
                    <input type="text" name="nama_pengaju" id="nama_pengaju" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="nama_ruang" class="form-label">No. Telepon</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="nim_nip" class="form-label">NIM / NIP</label>
                    <input type="text" name="nim_nip" id="nim_nip" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="lakiLaki" type="radio" name="gender" value="Laki-laki" required>
                        <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="perempuan" type="radio" name="gender" value="Perempuan" required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="col mb-3">
                    <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                </div>
                
            </div>
            <div class="col">
                <div class="col mb-3">
                    <label for="phone" class="form-label">Nama Ruang</label>
                    <select class="form-select form-select-md" aria-label=".form-select-lg example" id="nama_ruang" name="nama_ruang">
                        <option selected></option>
                        <?php foreach ($data2 as $row) : ?>
                            <option value="<?php echo $row['nama_ruang']; ?>"><?php echo $row['nama_ruang']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="waktu" class="form-label">Waktu Peminjaman</label>
                    <input type="time" name="waktu" id="waktu" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label for="kegiatan" class="form-label">Kegiatan</label>
                    <input type="text" name="kegiatan" id="kegiatan" class="form-control" required>
                </div>
                <div class="col mb-3">
                    <label class="form-label d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="mahasiswa" type="radio" name="statusUser" value="Mahasiswa" required>
                        <label class="form-check-label" for="mahasiswa">Mahasiswa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="dosen" type="radio" name="statusUser" value="Dosen" required>
                        <label class="form-check-label" for="dosen">Dosen</label>
                    </div>
                </div>
                <div class="col mb-3">
                    <label for="sik" class="form-label">Upload SIK</label><br>
                    <input id="sik" type="file" accept="application/pdf" name="sik">
                </div>
                <div class="col mb-3">
                    <label for="ktm" class="form-label">Upload KTM</label><br>
                    <input id="ktm" type="file" accept="application/pdf" name="ktm">
                </div>
                <!-- <div class="col-md-10">
                    <label for="ktm" class="form-label">Upload KTM</label><br>
                    <p style="font-size:14px">Format Nama File : Nama Lengkap_KTM.pdf</p>
                    <button class="button-action" style="background-color: rgb(201,239,255);"> <a class="nav-link" href="https://drive.google.com/drive/folders/1lBqem1sdjz5VNBS_nGEdAkhV9VdluxFU?usp=share_link">KTM</a></button>
                    <br><br>
                    <label for="sik" class="form-label">Upload SIK</label><br>
                    <p style="font-size:14px">Format Nama File : Nama Lengkap_SIK.pdf</p>
                    <button class="button-action" style="background-color: rgb(201,239,255);"> <a class="nav-link" href="https://drive.google.com/drive/folders/12OdZkHodvOrIGJlkAoR934yThD1w9ksT?usp=share_link">SIK</a></button>                                                         -->
                <!-- </div>  -->
                <button class="btn btn-dark col mb-3 mt-4" type="submit" name="submit">Submit</button>
            </div>
        </form>
        </div>
    </section>
    
    <script>
    $(document).ready(function() {
        <?php if ($showSubmit == 1) { ?>
            $(".alert-success").show();
        <?php } elseif ($showSubmit == 0) { ?>
            $(".alert-danger").show();
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