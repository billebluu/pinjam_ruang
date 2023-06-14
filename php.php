<?php
    $conn = mysqli_connect("localhost", "root", "", "db_pinjamruang");

    function query($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function registrasi($data){
        global $conn;

        $nama = $data["nama"];
        $statusUser = $data["statusUser"];
        $gender = $data["gender"];
        $phone = $data["phone"];
        $nim_nip = $data["nim_nip"];
        $email = stripslashes($data["email"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);

        //cek email dah ada ato blm
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('EMAIL SUDAH TERDAFTAR!!');
                </script>";
            return false;
        }

        //encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user ke database
        mysqli_query($conn, "INSERT INTO user VALUES('','$email',
        '$password','$nama','$statusUser','$phone','$gender','$nim_nip')");
        
        return mysqli_affected_rows($conn);



    }

    function searchAnggota($keyword)
    {
        $query = "SELECT * FROM data_pinjamruang WHERE
        nama_ruang LIKE '%$keyword%' AND
        tanggal LIKE '%$keyword%' 
        ";

        return query($query);
    }


?>



<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

$id = $_SESSION["id"];

//query data user berdasarkan id
$user = query("SELECT * FROM user WHERE id='$id'")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil - PinjamRuang FATISDA</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/ico" href="logo2.png">
  <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
</head>

<style>
    *{
      background-color: white;
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
      background-repeat: no-repeat;
      background-size: 50% auto;
      background-position: top;
    }
    .content {
      height: 0vh;
      background-color: rgb(253, 253, 253);
      text-align: center;
      padding: 20px;
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
    .btn{
      border-radius: 25px;
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 90%;
      padding: 8px 35px;
      background-color: black;
      color: #ffffff;
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
    .home-login{
       font-family: 'Montserrat',sans-serif; 
       font-size: 100%; 
       color: white;
       border-radius: 15px; 
       margin: 5px;
       align-items: center;
       padding: 20px 30px;
       background-color: rgb(0, 0, 0); 
       border-color: rgb(6, 6, 6);
    }
    .container-button{
        text-align: center;
        align-items: center;
        margin: 10px;
        font-family: 'Montserrat',sans-serif; 

    }
    .container-profile{
        margin-left: 120px;
        font-family: 'Montserrat',sans-serif; 
        font-size: 90%; 
    }
</style>

<body>
  <div class="content">
    <div class="container">
      <header>
      <nav class="navbar navbar-expand-lg bg-body">
          <div class="container-fluid">
            <div class="navbar-brand logo">
              <a><img src="logouns.png" alt="Logo" id="logo" width: 150px; height: 70px;></a>
            </div>
            <div class="navbar-divider"></div>
            <div class="navbar-title"><h1>PinjamRuang<br>Fatisda</h1></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item custom-nav-item">
                  <a class="nav-link active" aria-current="page" href="user-home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sobat UNS</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="user-profile.php">Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="user-logout.php">Logout</a></li>
                  </ul>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <br><br><br>
      <div class="container-profile" align="left">
        <h3 align="left"><b>Profil Anda</b></h3><br>
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $user["id"]; ?>">
          <div class="col-md-5">
            <label for="email" class="form-label">Email*</label>
            <input type="text" class="form-control" name="email" value="<?= $user["email"]; ?>" id="email" disabled>
          </div>
          <div class="col-md-5">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone" value="<?= $user["phone"]; ?>" name="phone" disabled>
          </div>
          <div class="col-md-5">
            <label for="nama" class="form-label">Nama*</label>
            <input type="text" class="form-control" id="nama" value="<?= $user["nama"]; ?>" name="nama" disabled>
          </div>
          <div class="col-md-5">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" value="<?= $user["status"]; ?>" name="status" disabled>
          </div>
          <div class="col-md-5">
            <label for="gender" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" id="gender" value="<?= $user["gender"]; ?>" name="gender" disabled>
          </div>
          <div class="col-md-5">
            <label for="nim_nip" class="form-label">NIM/NIP</label>
            <input type="text" class="form-control" id="nim_nip" value="<?= $user["nim_nip"]; ?>" name="nim_nip" disabled>
          </div>
        </form>
        <div class="col-12">
          <br><br>
          <button type="button" class="user-profile">
            <a class="nav-link" href="user-profile.html" style="color: #ffffff; background-color: black;">Simpan</a>
          </button>
        </div>
      </div>

      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>














<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'functions.php';
    $id = $_GET["id"];

    //query data barang berdasarkan id
    $user = query("SELECT * FROM user WHERE id=$id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - PinjamRuang FATISDA</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
</head>
<style>
    *{
      background-color: white;
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
      background-repeat: no-repeat;
      background-size: 50% auto;
      background-position: top;
    }
    .content {
      height: 0vh;
      background-color: rgb(253, 253, 253);
      text-align: center;
      padding: 20px;
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
    .btn{
      border-radius: 25px;
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 90%;
      padding: 8px 35px;
      background-color: black;
      color: #ffffff;
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
    .home-login{
       font-family: 'Montserrat',sans-serif; 
       font-size: 100%; 
       color: white;
       border-radius: 15px; 
       margin: 5px;
       align-items: center;
       padding: 20px 30px;
       background-color: rgb(0, 0, 0); 
       border-color: rgb(6, 6, 6);
    }
    .container-button{
        text-align: center;
        align-items: center;
        margin: 10px;
        font-family: 'Montserrat',sans-serif; 

    }
    .container-profile{
        margin-left: 120px;
        font-family: 'Montserrat',sans-serif; 
        font-size: 90%; 
    }
</style>
<body>
    <div class="content">
    <div class="container">
    <header>
        <nav class="navbar navbar-expand-lg bg-body">
          <div class="container-fluid">
            <div class="navbar-brand logo">
              <a><img src="logouns.png" alt="Logo" id="logo"></a>
            </div>
            <div class="navbar-divider"></div>
            <div class="navbar-title"><h1>PinjamRuang<br>Fatisda</h1></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item custom-nav-item">
                  <a class="nav-link active" aria-current="page" href="user-home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sobat UNS</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="user-profile.php">Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="user-logout.php">Logout</a></li>
                  </ul>
              </ul>
            </div>
          </div>
        </nav>
      </header>
        <br><br><br>
            <div class="container-profile" align="left">
                <h3 align="left"><b>Profil Anda</b></h3><br>
                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                  <div class="col-md-5">
                    <label for="email" class="form-label">Email*</label>
                    <input type="text" class="form-control" name="email" value="<?= $user["email"]; ?>" id="email" disabled>
                  </div>
                <div class="col-md-5">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" value="<?= $user["phone"]; ?>" name="phone" disabled>
                </div>
                <div class="col-md-5">
                    <label for="nama" class="form-label">Nama*</label>
                    <input type="text" class="form-control" id="nama" value="<?= $user["nama"]; ?>" name="nama" disabled>
                </div>
                <div class="col-md-5">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" value="<?= $user["status"]; ?>" name="status" disabled>
                </div>
                <div class="col-md-5">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="gender" value="<?= $user["gender"]; ?>" name="gender" disabled>
                </div>
                <div class="col-md-5">
                    <label for="nim_nip" class="form-label">NIM/NIP</label>
                    <input type="text" class="form-control" id="nim_nip" value="<?= $user["nim_nip"]; ?>" name="nim_nip" disabled>
                </div>
                </form>
                <div class="col-12">
                    <br><br>
                    <!-- type="submit" name="submit" -->
                    <button type="button" class="user-profile"><a class="nav-link" href="user-profile.html" style="color: #ffffff; background-color: black;">Simpan</a></button>
                </div>
            </div>
       
                
      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>  
</body>
</html>



<div class="container-profile" align="left">
                <h3 align="left"><b>Profil Anda</b></h3><br>
                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-5">
                        <label for="email" class="form-label">Email*</label>
                        <input type="text" class="form-control" name="email"  id="email" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone"  name="phone" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="nama" class="form-label">Nama*</label>
                        <input type="text" class="form-control" id="nama"  name="nama" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status"  name="status" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="gender"  name="gender" disabled>
                    </div>
                    <div class="col-md-5">
                        <label for="nim_nip" class="form-label">NIM/NIP</label>
                        <input type="text" class="form-control" id="nim_nip"  name="nim_nip" disabled>
                    </div>
                </form>
                <div class="col-12">
                    <br><br>
                    <!-- type="submit" name="submit" -->
                    <button type="button" class="user-profile"><a class="nav-link" href="edit-profile.html" style="color: #ffffff; background-color: black;">Edit</a></button>
                </div>
            </div>


            <?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'functions.php';

?>


userprofile


<?php 
require 'functions.php';
$id = $_GET["id"];

//query data mahasiswa berdasar id
$user = query("SELECT * FROM user WHERE id = $id")[0];

if (isset($_POST['submit'])) {
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'profil.php'
			</script>
		";
	} else {
		echo "<script>
				alert('data gagal diubah');
				document.location.href = 'profil.php'
			</script>
		";
	}
}

var_dump($user);

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
            <div class="navbar-title"><h1>PinjamRuang<br>Fatisda</h1></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item custom-nav-item">
                  <a class="nav-link active" aria-current="page" href="user-home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle custom-nav-item" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sobat UNS</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="user-profile.php">Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="user-logout.php">Logout</a></li>
                  </ul>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <br>
      <section>
      <div class="container-profile" align="left">
                <h3 align="left" style="background-color: white;"><b>Profil Anda</b></h3><br>
                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                    <div class="col-md-5">
                        <label for="email" class="form-label">Email*</label>
                        <input type="text" class="form-control" name="email"  id="email" disabled value="<?= $user["email"]; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone"  name="phone" disabled value="<?= $user["phone"]; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="nama" class="form-label">Nama*</label>
                        <input type="text" class="form-control" id="nama"  name="nama" disabled value="<?= $user["nama"]; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="statusUser" class="form-label">Status</label>
                        <input type="text" class="form-control" id="statusUser"  name="statusUser" disabled value="<?= $user["statusUser"]; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="gender"  name="gender" disabled value="<?= $user["gender"]; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="nim_nip" class="form-label">NIM/NIP</label>
                        <input type="text" class="form-control" id="nim_nip"  name="nim_nip" disabled value="<?= $user["nim_nip"]; ?>">
                    </div>
                </form>
                <div class="col-12">
                    <br><br>
                    <!-- type="submit" name="submit" -->
                    <button type="button" class="user-profile"><a class="nav-link" href="edit-profile.php" style="color: #ffffff; background-color: black;">Edit</a></button>
                </div>
            </div>
      </section>

      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    </body>
</html>