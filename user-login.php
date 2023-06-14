<?php
session_start();


if(isset($_SESSION["login"])){
  header("Location: user-home.php");
  exit;
}

require 'functions.php';
$loginFailed = false;

if (isset($_POST["login"])){
  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email'");

  //cek email
  if(mysqli_num_rows($result) === 1){
    //cek passsword
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password,$row["password"])){
      //set session
      $_SESSION["login"] = true;
      header("Location: user-home.php?id=" . $row['id']);
      exit;
    }
  }
  $loginFailed = true;


}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - PinjamRuang FATISDA</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
</head>
<style>
    body {
        margin: 0;
      padding: 0;
      background-image: url('half-bg-login.png');
      background-repeat: no-repeat;
      background-size: 50% auto;
      background-position: top right;
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
    .container {
      width: 150%;
      max-width: 1400px;
      margin: 0 auto;
      padding: 10px 5px;
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
    .button-login{
       font-family: 'Montserrat',sans-serif; 
       font-size: 90%; 
       color: white;
       border-radius: 23px; 
       padding: 7px 25px;
       background-color: rgb(8,172,236); 
       border-color: rgb(8,172,236);
    }
    h1{
       font-family: 'Montserrat',sans-serif; 
       font-size: 250%; 
       color: rgb(0, 0, 0);  
       font-weight: bolder;
    }
</style>
<body>
  
      
    <div class="container">
    <table cellpadding="10" cellspacing="0">
        <tr>
           <td></td> 
        </tr>
        <tr>
            <td><h1><image src="logo.png" width="80%" ></h1></td>
            <td><h1></h1></td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>        
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
            <td>
                <h1><b>Login dengan SSO UNS</b></h1>
                <br>
                <!-- Alert Gagal Login -->
                <?php if ($loginFailed == true) : ?>
                    <div class="alert alert-danger alert-dismissible mt-4" id="myAlertFail">
                        Tidak dapat log in, periksa email dan password Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form action="user-login.php" method="POST" style="background-color: rgb(201,239,255);">
                    <div class="col">
                      <div class="col mb-3">
                        <label for="email" class="form-label"></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                      </div>
                      <div class="col mb-3">
                        <label for="password" class="form-label"></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                      </div>
                      
                      </div>
                    </div>
                    <div class="mb-3">
                        <br>
                        <!-- <a class="nav-link" href="user-home.html"></a> -->
                        <button class="button-login" name="login" type="submit"><b>Log in</b></button>
                      </div>
                    </form>
            </td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
            
        </td>
        </tr>
        <tr>
            
            <td>
                
            </td>
        </tr>
    </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    
</body>
</html>
