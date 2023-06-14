<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(hapusJadwal($id) > 0){
        echo "<script>
        window.location.href = 'admin-data-jadwal-ruang.php?id=$id';
        </script>";
    }
?>