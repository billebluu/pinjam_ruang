<?php
    require 'functions.php';

    if(isset($_POST["register"])){
        //
        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('USER BERHASIL DITAMBAHKAN !');
                    window.location.href = 'input.php';
                  </script>";
        }else{
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Mahasiswa</title>
    <style>
        label{
            display:block;
        }
    </style>
</head>
<body>
    <h1>Halaman Input Mahasiswa</h1>
    <form action="" method="POST">
        <ul>
            
            <li>
                <label for="nama">nama :</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="statusUser">status :</label>
                <input type="text" name="statusUser" id="statusUser">
            </li>
            <li>
                <label for="gender">jenis kelamin :</label>
                <input type="text" name="gender" id="gender">
            </li>
            <li>
                <label for="phone">nomor telepon :</label>
                <input type="text" name="phone" id="phone">
            </li>
            <li>
                <label for="nim_nip">nim/nip :</label>
                <input type="text" name="nim_nip" id="nim_nip">
            </li>
            <li>
                <label for="email">email :</label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password">
            </li>
            <br>
            <li>
                <button type="submit" name="register">Input</button>
            </li>
        </ul>
    </form>
    
</body>
</html>