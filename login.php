

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinjamRuang FATISDA</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
      <link rel="icon" type="image/ico" href="logo2.png">
      <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
</head>
<style>
    body {
      background-image: url('bg-login.png');
      background-repeat: no-repeat;
      background-size: 100;
    }
    .admin-login{
      border-radius: 23px;
      background-color: white;
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 120%;
      padding: 10px 18px;
    }
    .user-login{
      border-radius: 23px;
      background-color: rgb(0, 0, 0);
      border-color: black;
      font-family: 'Montserrat',sans-serif;
      font-size: 120%;
      padding: 10px 25px;
    }
    .container {
      width: 150%;
      max-width: 1300px;
      margin: 0 auto;
      padding: 10px 5px;
    }
    @media screen and (max-width: 600px) {
      .container {
        padding: 10px;
      }
    }
</style>
<body>
    <div class="container">
    <table cellpadding="10" cellspacing="0">
        <tr>
           <td></td> 
        </tr>
        <tr>
            <td><h1><image src="logo.png" width="65%" ></h1></td>
        </tr>
        <tr>
            <td></td> 
         </tr>
        <tr>
          
            <td><h1><image src="welcome.png" width="100%" ></h1></td>
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
                <image src="gate.png" width="80%" ></image>
            </td>
        </tr>
        <tr>
            <td>
                <button class="admin-login"><a class="nav-link" href="admin-login.php" style="color: rgb(0, 0, 0);"><b>Admin Login</b></a></button>
                <button class="user-login"><a class="nav-link" href="user-login.php" style="color: rgb(255, 255, 255);"><b>User Login</b></a></button>
            </td>
        </tr>
    </table>
    </div>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>  
</body>
</html>