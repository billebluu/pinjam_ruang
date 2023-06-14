<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(hapusUser($id) > 0){
        echo "<script>
        window.location.href = 'admin-data-user.php?id=$id';
        </script>";
    }
?>